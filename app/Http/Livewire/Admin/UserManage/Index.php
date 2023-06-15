<?php

namespace App\Http\Livewire\Admin\UserManage;

use Gate;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false, $viewDetails = null;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $user_id = null, $first_name, $last_name, $email,$phone, $dob, $date_of_join,$my_referral_code,$referral_code,$referral_name; 

    public $guardian_name, $gender, $profession, $marital_status, $address, $state, $city, $pin_code, $nominee_name, $nominee_dob, $nominee_relation, $bank_name, $branch_name, $ifsc_code, $account_number, $pan_card_number ; 

    protected $listeners = [
        'update','cancel','updatePaginationLength','confirmedToggleAction','deleteConfirm','updateDateOfJoin','updateDob','updateNomineeDob'
    ];

    public function mount(){
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function updatePaginationLength($length){
        $this->paginationLength = $length;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sortBy($columnName)
    {
        $this->resetPage();

        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
    
    public function render()
    {
        $statusSearch = null;
        $searchValue = $this->search;
        if(Str::contains('active', strtolower($searchValue))){
            $statusSearch = 1;
        }else if(Str::contains('inactive', strtolower($searchValue))){
            $statusSearch = 0;
        }
        
        $allUser = User::query()->where(function ($query) use($searchValue,$statusSearch) {
            $query->where('name', 'like', '%'.$searchValue.'%')
            ->orWhere('is_active', $statusSearch)
            ->orWhereRaw("date_format(created_at, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%']);
        })
        ->whereHas('roles',function($query){
            $query->whereIn('id',[3]);
        })
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->paginationLength);

        return view('livewire.admin.user-manage.index',compact('allUser'));
    }

    public function create()
    {
        $this->resetPage('page');
        $this->resetInputFields();
        $this->resetValidation();
        $this->formMode = true;
        $this->initializePlugins();
    }

    private function resetInputFields(){
        $this->first_name = '';
        $this->last_name  = '';
        $this->email      = '';
        $this->phone      = '';
        $this->dob        = '';
        $this->date_of_join       = '';
        $this->referral_code      = '';
        $this->referral_name      = '';

        $this->guardian_name      = '';
        $this->gender             = '';
        $this->profession         = '';
        $this->marital_status     = '';
        $this->address            = '';
        $this->state              = '';
        $this->city               = '';
        $this->pin_code           = '';
        $this->nominee_name       = '';
        $this->nominee_dob        = '';
        $this->nominee_relation   = '';
        $this->bank_name          = '';
        $this->branch_name        = '';
        $this->ifsc_code          = '';
        $this->account_number     = '';
        $this->pan_card_number    = '';
    }

    public function store(){
        $validatedDate = $this->validate([
            'first_name'  => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
            'last_name'   => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
            'email'       => 'required|unique:users,email',
            'phone'         => 'required|digits:10',
            'dob'           => 'required',
            'guardian_name' => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
            'gender'        => 'required',
            'profession'    => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
            'marital_status' => 'required',

            'referral_code' => 'required|regex:/^\S*$/u|exists:users,my_referral_code',
            'referral_name' => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
            'date_of_join'  => 'required',
            'address'       => 'required',
            'state'         => 'required',
            'city'          => 'required',
            'pin_code'      => 'required|integer',
            'nominee_name'  => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
            'nominee_dob'   => 'required',
            'nominee_relation'  => 'required',
            'bank_name'         => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
            'branch_name'       => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
            'ifsc_code'         => 'required',
            'account_number'    => 'required|integer',
            'pan_card_number'   => 'required',
        ]);

        DB::beginTransaction();
        try {
           
            $referral_user_id = User::where('my_referral_code',$this->referral_code)->value('id');

            $userDetails = [];
            $userDetails['uuid']       = Str::uuid();
            $userDetails['first_name'] = $this->first_name;
            $userDetails['last_name']  = $this->last_name;
            $userDetails['name']       = $this->first_name.' '.$this->last_name;
            $userDetails['email']      = $this->email;
            $userDetails['phone']      = $this->phone;
            $userDetails['dob']          = Carbon::parse($this->dob)->format('Y-m-d');
            $userDetails['date_of_join'] = Carbon::parse($this->date_of_join)->format('Y-m-d');
            
            $userDetails['my_referral_code'] = generateRandomString(10);
            $userDetails['referral_code'] = $this->referral_code;
            $userDetails['referral_name'] = $this->referral_name;
            $userDetails['referral_user_id'] = $referral_user_id;
            
            $createdUser = User::create($userDetails);

            //Send email verification link
            $createdUser->sendEmailVerificationNotification();

            $createdUser->roles()->sync(3);

            $profileDetails = [];
            $profileDetails['guardian_name']      = $this->guardian_name;
            $profileDetails['gender']             = $this->gender;
            $profileDetails['profession']         = $this->profession;
            $profileDetails['marital_status']     = $this->marital_status;
            $profileDetails['address']            = $this->address;
            $profileDetails['state']            = $this->state;
            $profileDetails['city']             = $this->city;
            $profileDetails['pin_code']         = $this->pin_code;
            $profileDetails['nominee_name']     = $this->nominee_name;
            $profileDetails['nominee_dob']      = Carbon::parse($this->nominee_dob)->format('Y-m-d');
            $profileDetails['nominee_relation'] = $this->nominee_relation;
            $profileDetails['bank_name']        = $this->bank_name;
            $profileDetails['branch_name']      = $this->branch_name;
            $profileDetails['ifsc_code']        = $this->ifsc_code;
            $profileDetails['account_number']   = $this->account_number;
            $profileDetails['pan_card_number']  = $this->pan_card_number;

            //Start user levels
            $profileDetails['level_one_user_id']    = $createdUser->referrer;
            $profileDetails['level_two_user_id']    = $createdUser->level2Referrer;
            $profileDetails['level_three_user_id']  = $createdUser->level3Referrer;
            //End user levels

            $createdUser->profile()->create($profileDetails);

            DB::commit();
            
            $this->resetInputFields();

            $this->flash('success',trans('messages.add_success_message'));
        
            return redirect()->route('admin.user-manage');
        }catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));
        }
    }

    public function edit($id){
        $this->resetPage('page');
        dd('working..');

    }

    // public function update(){
    //     $validatedDate = $this->validate([
    //         'first_name'  => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
    //         'last_name'   => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
    //         'email'       => 'required|unique:users,email',
    //         'phone'         => 'required|digits:10',
    //         'dob'           => 'required',
    //         'guardian_name' => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
    //         'gender'        => 'required',
    //         'profession'    => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
    //         'marital_status' => 'required',

    //         'referral_code' => 'required|regex:/^\S*$/u|exists:users,my_referral_code',
    //         'referral_name' => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
    //         'date_of_join'  => 'required',
    //         'address'       => 'required',
    //         'state'         => 'required',
    //         'city'          => 'required',
    //         'pin_code'      => 'required|integer',
    //         'nominee_name'  => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
    //         'nominee_dob'   => 'required',
    //         'nominee_relation'  => 'required',
    //         'bank_name'         => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
    //         'branch_name'       => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
    //         'ifsc_code'         => 'required',
    //         'account_number'    => 'required|integer',
    //         'pan_card_number'   => 'required',
    //     ]);

    //     DB::beginTransaction();
    //     try {
           
    //         $referral_user_id = User::where('my_referral_code',$this->referral_code)->value('id');

    //         $userDetails = [];
    //         $userDetails['uuid']       = Str::uuid();
    //         $userDetails['first_name'] = $this->first_name;
    //         $userDetails['last_name']  = $this->last_name;
    //         $userDetails['name']       = $this->first_name.' '.$this->last_name;
    //         $userDetails['email']      = $this->email;
    //         $userDetails['phone']      = $this->phone;
    //         $userDetails['dob']          = Carbon::parse($this->dob)->format('Y-m-d');
    //         $userDetails['date_of_join'] = Carbon::parse($this->date_of_join)->format('Y-m-d');
            
    //         $userDetails['my_referral_code'] = generateRandomString(10);
    //         $userDetails['referral_code'] = $this->referral_code;
    //         $userDetails['referral_name'] = $this->referral_name;
    //         $userDetails['referral_user_id'] = $referral_user_id;
            
    //         $createdUser = User::create($userDetails);

    //         //Send email verification link
    //         $createdUser->sendEmailVerificationNotification();

    //         $createdUser->roles()->sync(3);

    //         $profileDetails = [];
    //         $profileDetails['guardian_name']      = $this->guardian_name;
    //         $profileDetails['gender']             = $this->gender;
    //         $profileDetails['profession']         = $this->profession;
    //         $profileDetails['marital_status']     = $this->marital_status;
    //         $profileDetails['address']            = $this->address;
    //         $profileDetails['state']            = $this->state;
    //         $profileDetails['city']             = $this->city;
    //         $profileDetails['pin_code']         = $this->pin_code;
    //         $profileDetails['nominee_name']     = $this->nominee_name;
    //         $profileDetails['nominee_dob']      = Carbon::parse($this->nominee_dob)->format('Y-m-d');
    //         $profileDetails['nominee_relation'] = $this->nominee_relation;
    //         $profileDetails['bank_name']        = $this->bank_name;
    //         $profileDetails['branch_name']      = $this->branch_name;
    //         $profileDetails['ifsc_code']        = $this->ifsc_code;
    //         $profileDetails['account_number']   = $this->account_number;
    //         $profileDetails['pan_card_number']  = $this->pan_card_number;

    //         //Start user levels
    //         $profileDetails['level_one_user_id']    = $createdUser->referrer;
    //         $profileDetails['level_two_user_id']    = $createdUser->level2Referrer;
    //         $profileDetails['level_three_user_id']  = $createdUser->level3Referrer;
    //         //End user levels

    //         $createdUser->profile()->create($profileDetails);

    //         DB::commit();
            
    //         $this->resetInputFields();

    //         $this->flash('success',trans('messages.add_success_message'));
        
    //         return redirect()->route('admin.user-manage');
    //     }catch (\Exception $e) {
    //         DB::rollBack();
    //         // dd($e->getMessage().'->'.$e->getLine());
    //         $this->alert('error',trans('messages.error_message'));
    //     }
    // }

    public function delete($id)
    {
        $this->confirm('Are you sure you want to delete it?', [
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes, change it!',
            'cancelButtonText' => 'No, cancel!',
            'onConfirmed' => 'deleteConfirm',
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['deleteId' => $id],
        ]);
    }

    public function deleteConfirm($event){
        $deleteId = $event['data']['inputAttributes']['deleteId'];
        $model = User::find($deleteId);
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function show($id){
        $this->resetPage('page');
        $this->user_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
    }

    public function cancel(){
        $this->formMode = false;
        $this->updateMode = false;
        $this->viewMode = false;
    }

    public function toggle($id){
        $this->confirm('Are you sure you want to change the status?', [
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes, change it!',
            'cancelButtonText' => 'No, cancel!',
            'onConfirmed' => 'confirmedToggleAction',
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['userId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $userId = $event['data']['inputAttributes']['userId'];
        $model = User::find($userId);
        $model->update(['is_active' => !$model->status]);
        $this->alert('success', trans('messages.change_status_success_message'));
    }

    public function changeStatus($statusVal){
        $this->status = (!$statusVal) ? 1 : 0;
    }

    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }

    public function updateDateOfJoin($date){
        $this->date_of_join = $date;
    }

    public function updateDob($date){
        $this->dob = $date;
    }

    public function updateNomineeDob($date){
        $this->nominee_dob = $date;
    }

    
}
