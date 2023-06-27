<?php

namespace App\Http\Livewire\Admin\Team;

use Gate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Livewire\Component;

class Index extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false, $viewDetails = null;

    public $sortColumnName = 'created_at', $sortDirection = 'asc', $paginationLength = 10;

    public $team_id=null , $status = 1;
 
    protected $listeners = ['cancel','initializePlugins','updatePaginationLength','confirmedToggleAction','deleteConfirm'];

    public $first_name, $last_name, $email, $phone, $password, $password_confirmation, $profile_image=null, $originalImage;

    public function mount(){
        abort_if(Gate::denies('team_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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

        
        $allTeam = User::query()->where(function ($query) use($searchValue,$statusSearch) {
            $query->where('name', 'like', '%'.$searchValue.'%')
            ->orWhere('is_active', $statusSearch)
            ->orWhereRelation('roles','title','like',  $searchValue . '%')
            ->orWhereRaw("date_format(created_at, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%']);
        })
        ->whereHas('roles',function($query){
            $query->whereIn('id',[4,5]);
        })
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->paginationLength);

        return view('livewire.admin.team.index',compact('allTeam'));
    }

    public function create()
    {
        $this->resetPage();
        $this->resetInputFields();
        $this->formMode = true;
        $this->initializePlugins();
    }

    public function store(){
        $validatedData = $this->validate([
            'profile_image'      => 'required|image|max:'.config('constants.profile_image_size'),
            'first_name' => ['required', 'string','regex:/^[^\d\s]+(\s{0,1}[^\d\s]+)*$/', 'max:255'],
            'last_name'  => ['required', 'string','regex:/^[^\d\s]+(\s{0,1}[^\d\s]+)*$/', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', Rule::unique((new User)->getTable(), 'email')->whereNull('deleted_at')],
            'phone'      => ['required','digits:10'],
            'password'   => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required','min:8','same:password'], 
            'status'        => 'required',
        ]);


        DB::beginTransaction();
        try {

            $insertUserDetail = [
                'uuid'       => Str::uuid(),
                'first_name' => $this->first_name,
                'last_name'  => $this->last_name,
                'name'       => $this->first_name .' '.$this->last_name,
                'email'      => $this->email,
                'phone'      => $this->phone,
                'password'   => Hash::make($this->password),
                'date_of_join' => Carbon::now()->format('Y-m-d'),
                'password_set_at'   => Carbon::now(),
                'email_verified_at' => Carbon::now(),
                'is_active'         => $this->status,
            ];

            $teamCreated = User::create($insertUserDetail);
            if($teamCreated){ 

                //Upload profile image
                uploadImage($teamCreated, $this->profile_image, 'user/profile-images',"profile", 'original', 'save', null);

                // Assign user Role
                $teamCreated->roles()->sync([5]);
                
                // Profile records 
                $profileData = [
                    'user_id'        => $teamCreated->id,
                ];

                $teamCreated->profile()->create($profileData);

                // Kyc records 
                $kycRecords = [
                    'user_id'        => $teamCreated->id,
                    'created_at'     => date('Y-m-d H:i:s'),
                    'updated_at'     => date('Y-m-d H:i:s'),
                ];
                $teamCreated->kycDetail()->create($kycRecords);

                DB::commit();

                $this->resetInputFields();

                $this->flash('success',trans('messages.add_success_message'));
        
                return redirect()->route('admin.team');

            }else{
                
                $this->resetInputFields();
    
                // Set Flash Message
                $this->alert('error', trans('panel.message.error'));
            }

        }catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));
        }

    }

    
    public function edit($id)
    {
        $this->resetPage();
        $team = User::findOrFail($id);

        $this->team_id = $id;
        $this->first_name  = $team->first_name;
        $this->last_name   = $team->last_name;
        $this->email       = $team->email;
        $this->phone       = $team->phone;
       
        $this->originalImage = $team->profile_image_url;

        $this->formMode = true;
        $this->updateMode = true;
        $this->initializePlugins();
    }

    public function update(){
        $validatedArray = [
            'first_name' => ['required', 'string','regex:/^[^\d\s]+(\s{0,1}[^\d\s]+)*$/', 'max:255'],
            'last_name'  => ['required', 'string','regex:/^[^\d\s]+(\s{0,1}[^\d\s]+)*$/', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', Rule::unique((new User)->getTable(), 'email')->ignore($this->team_id)->whereNull('deleted_at')],
            'phone'      => ['required','digits:10'],
            'status'     => 'required',
        ];

        if($this->profile_image){
            $validatedArray['profile_image'] = 'required|image|max:'.config('constants.profile_image_size');
        }

        $validatedData = $this->validate($validatedArray);

        DB::beginTransaction();
        try {

            $updateUserDetail = [
                'first_name' => $this->first_name,
                'last_name'  => $this->last_name,
                'name'       => $this->first_name .' '.$this->last_name,
                // 'email'      => $this->email,
                'phone'      => $this->phone,
                'is_active'         => $this->status,
            ];

            $teamUpdated = User::find($this->team_id);
            if($teamUpdated){ 

                //Upload profile image
                $uploadId = null;
                if($this->profile_image){
                    $uploadId = ($teamUpdated->profileImage) ? $teamUpdated->profileImage->id : null;
                    if($uploadId){
                        uploadImage($teamUpdated, $this->profile_image, 'user/profile-images',"profile", 'original', 'update', $uploadId);
                    }else{
                        uploadImage($teamUpdated, $this->profile_image, 'user/profile-images',"profile", 'original', 'save', null);
                    }
                 
                }
                // Assign user Role
                // $teamUpdated->roles()->sync([4]);
                
                // Profile records 
                // $profileData = [
                //     'user_id'        => $teamUpdated->id,
                // ];

                // $teamUpdated->profile()->update($profileData);

                // Kyc records 
                // $kycRecords = [
                //     'user_id'        => $teamUpdated->id,
                //     'created_at'     => date('Y-m-d H:i:s'),
                //     'updated_at'     => date('Y-m-d H:i:s'),
                // ];
                // $teamUpdated->kycDetail()->udpate($kycRecords);

                $teamUpdated->update($updateUserDetail);

                DB::commit();

                $this->resetInputFields();

                $this->flash('success',trans('messages.edit_success_message'));
        
                return redirect()->route('admin.team');

            }else{
                
                $this->resetInputFields();
    
                // Set Flash Message
                $this->alert('error', trans('panel.message.error'));
            }

        }catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));
        }

    }

    public function show($id){
        $this->resetPage();
        $this->team_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
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
        $uploadImageId = $model->profileImage->id;
        deleteFile($uploadImageId);
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
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
            'inputAttributes' => ['teamId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $teamId = $event['data']['inputAttributes']['teamId'];
        $model = User::find($teamId);
        $model->update(['is_active' => !$model->is_active]);
        $this->alert('success', trans('messages.change_status_success_message'));
    }

    public function changeStatus($statusVal){
        $this->status = (!$statusVal) ? 1 : 0;
    }

    
    public function checkEmail()
    {
        $validated = $this->validate([
            'email'    => ['required','email'],
        ]);

        $user = User::where('email', $this->email)->whereNull('deleted_at')->first();
        if ($user) {
            // if(is_null($user->email_verified_at)){
            //     $this->showResetBtn = true;
            // }
            $this->addError('email', trans('panel.message.email_already_taken'));
        }else{
            $this->resetErrorBag('email');
        }
    }
    
    private function resetInputFields(){
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->profile_image = '';

    }

    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }
}
