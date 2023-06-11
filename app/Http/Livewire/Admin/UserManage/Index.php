<?php

namespace App\Http\Livewire\Admin\UserManage;

use Gate;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\Response;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false, $viewDetails = null;

    public $user_id = null, $first_name, $last_name, $email,$phone, $dob, $date_of_join,$my_referral_code,$referral_code,$referral_name; 

    public $guardian_name, $gender, $profession, $marital_status, $address, $state, $city, $pin_code, $nominee_name, $nominee_dob, $nominee_relation, $bank_name, $branch_name, $ifsc_code, $account_number, $pan_card_number ; 

    protected $users = null;

    protected $listeners = [
        'confirmedToggleAction','deleteConfirm'
    ];

    public function mount(){
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function render()
    {
        $this->users = User::query()
        ->whereHas('roles',function($query){
            $query->whereIn('id',[3]);
        })
        ->where('name', 'like', '%'.$this->search.'%')
        ->orderBy('id','desc')
        ->paginate(10);

        $allUser = $this->users;
        return view('livewire.admin.user-manage.index',compact('allUser'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->formMode = true;
    }

    private function resetInputFields(){
        $this->first_name = '';
        $this->last_name  = '';
        $this->email      = '';
        $this->phone      = '';
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
            'first_name'  => 'required',
            'last_name'   => 'required',
            'email'       => 'required|unique:users,email',
            'phone'         => 'required|digits:10',
            'guardian_name' => 'required',
            'gender'        => 'required',
            'profession'    => 'required',
            'marital_status' => 'required',

            'referral_code' => 'required',
            'referral_name' => 'required',
            'date_of_join'  => 'required',
            'address'       => 'required',
            'state'         => 'required',
            'city'          => 'required',
            'pin_code'      => 'required',
            'nominee_name'  => 'required',
            'nominee_dob'  => 'required',
            'nominee_relation'  => 'required',
            'bank_name'         => 'required',
            'branch_name'       => 'required',
            'ifsc_code'         => 'required',
            'account_number'    => 'required',
            'pan_card_number'   => 'required',
        ]);

        
        $userDetails = [];
        $userDetails['first_name'] = $this->first_name;
        $userDetails['last_name']  = $this->last_name;
        $userDetails['name']       = $this->first_name.' '.$this->last_name;
        $userDetails['phone']      = $this->phone;
        $userDetails['dob']        = date('Y-m-d',strtostring($this->dob));


        $createdUser = User::create($userDetails);

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
        $profileDetails['nominee_dob']      = $this->nominee_dob;
        $profileDetails['nominee_relation'] = $this->nominee_relation;
        $profileDetails['bank_name']        = $this->bank_name;
        $profileDetails['branch_name']      = $this->branch_name;
        $profileDetails['ifsc_code']        = $this->ifsc_code;
        $profileDetails['account_number']   = $this->account_number;
        $profileDetails['pan_card_number']  = $this->pan_card_number;

        $this->authUser->profile()->update($profileDetails);

        $this->resetInputFields();

        $this->flash('success',trans('messages.add_success_message'));
      
        return redirect()->route('admin.user-manage');
    }

    public function edit($id){
        dd('working..');

    }

    public function update(){

    }

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
        dd('working..');
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
    
}
