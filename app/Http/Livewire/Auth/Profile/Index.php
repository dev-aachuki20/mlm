<?php

namespace App\Http\Livewire\Auth\Profile;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Livewire\BaseComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends BaseComponent
{
    use LivewireAlert,WithFileUploads;

    protected $layout = null;

    public $editMode =false, $showConfirmCancel = false;
    
    public $authUser, $profile_image = null;

    public $first_name, $last_name, $email, $dob, $phone,$my_referral_code,$referral_code,$referral_name; 

    public $guardian_name, $gender, $profession, $marital_status, $address, $state, $city, $pin_code, $nominee_name, $nominee_dob, $nominee_relation; 

    protected $listeners = [
        'updatedDob','updateNomineeDob','confirmUpdateProfileImage','cancelUpdateProfileImage','openEditSection','closedEditSection',
    ];

    public function mount(){
        $this->authUser = auth()->user();
    }

    public function updatedDob($date){
        $this->dob = Carbon::parse($date)->format('d-m-Y');
    }

    public function updateNomineeDob($date){
        $this->nominee_dob = Carbon::parse($date)->format('d-m-Y');
    }

    public function render()
    {
        return view('livewire.auth.profile.index');
    }

    public function validateProfileImage()
    {
        $this->showConfirmCancel = true;

        $this->validate([
            'profile_image' => 'image|max:1024', // Maximum file size of 1MB
        ]);
       
    }

    public function confirmUpdateProfileImage()
    {
        $this->showConfirmCancel = false;
        $this->validate([
            'profile_image' => 'image|max:1024', // Maximum file size of 1MB
        ]);
        $user = $this->authUser;

        $actionType = 'save';
        $uploadId = null;
        if($profileImageRecord = $user->profileImage){
            $uploadId = $profileImageRecord->id;
            $actionType = 'update';
        }
        $response = uploadImage($user, $this->profile_image, 'user/profile-images',"profile", 'original', $actionType, $uploadId);

        
        $this->reset(['profile_image']);

        $this->authUser->profile_image_url = $response->file_url;

        $this->render();
        if ($response) {
            // Emit an event with updated profile image URL
            $this->emit('profileImageUpdated', true);

            // Set Flash Message
            $this->alert('success', 'Profile image has been updated.');
        } else {

            $this->alert(trans('panel.alert-type.error'), trans('panel.message.error'));
        }
    }

    public function cancelUpdateProfileImage()
    {
        $this->showConfirmCancel = false;

        $this->reset(['profile_image']);
    }

    public function openEditSection(){
        $this->editMode = true;
      
        $this->first_name = $this->authUser->first_name;
        $this->last_name  = $this->authUser->last_name;
        $this->email      = $this->authUser->email;
        $this->phone      = $this->authUser->phone;
        $this->dob        = Carbon::parse($this->authUser->dob)->format('d-m-Y');
        $this->referral_code      = $this->authUser->referral_code;
        $this->referral_name      = $this->authUser->referral_name;

        $this->guardian_name      = $this->authUser->profile->guardian_name;
        $this->gender             = $this->authUser->profile->gender;
        $this->profession         = $this->authUser->profile->profession;
        $this->marital_status     = $this->authUser->profile->marital_status;
        $this->address            = $this->authUser->profile->address;
        $this->state              = $this->authUser->profile->state;
        $this->city               = $this->authUser->profile->city;
        $this->pin_code           = $this->authUser->profile->pin_code;
        $this->nominee_name       = $this->authUser->profile->nominee_name;
        $this->nominee_relation   = $this->authUser->profile->nominee_relation;
        $this->nominee_dob        = Carbon::parse($this->authUser->profile->nominee_dob)->format('d-m-Y');
    
        $this->initializePlugins();
    }

    public function closedEditSection(){
        $this->editMode = false;
        $this->resetFields();
    }

    public function updateProfile(){
    //    dd($this->all());
        $validatedDate = $this->validate([
            'first_name'  => 'required',
            'last_name'   => 'required',
            'phone'         => 'required|digits:10',
            'dob'           => 'required',
            'guardian_name' => '',
            'gender'        => 'required',
            'profession'    => '',
            'marital_status' => '',

            'address'       => '',
            'state'         => '',
            'city'          => '',
            'pin_code'      => '',
            'nominee_name'  => '',
            'nominee_relation'  => '',
            'nominee_dob'       => '',
          
        ]);

        $userDetails = [];
        $userDetails['first_name'] = $this->first_name;
        $userDetails['last_name']  = $this->last_name;
        $userDetails['name']       = $this->first_name.' '.$this->last_name;
        $userDetails['phone']      = $this->phone;
        $userDetails['dob']        = Carbon::parse($this->dob)->format('Y-m-d');

        $this->authUser->update($userDetails);

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
        $profileDetails['nominee_relation'] = $this->nominee_relation;
        $profileDetails['nominee_dob']      = Carbon::parse($this->nominee_dob)->format('Y-m-d');

        $this->authUser->profile()->update($profileDetails);

        $this->closedEditSection();
        $this->flash('success', 'Profile has been updated.');

        if(auth()->user()->is_super_admin || auth()->user()->is_admin){
            $profileRoute = 'auth.admin-profile';
        }else if(auth()->user()->is_user){
            $profileRoute = 'auth.user-profile';
        }
        return redirect()->route($profileRoute);
    }

    public function resetFields(){
        $this->first_name = '';
        $this->last_name  = '';
        $this->email      = '';
        $this->phone      = '';
        $this->dob        = '';
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
        $this->nominee_relation   = '';
        $this->nominee_dob        = '';
       
    }

    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }
}
