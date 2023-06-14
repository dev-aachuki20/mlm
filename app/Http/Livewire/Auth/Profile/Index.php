<?php

namespace App\Http\Livewire\Auth\Profile;

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

    public $first_name, $last_name, $email,$phone,$date_of_join,$my_referral_code,$referral_code,$referral_name; 

    public $guardian_name, $gender, $profession, $marital_status, $address, $state, $city, $pin_code, $nominee_name, $nominee_dob, $nominee_relation, $bank_name, $branch_name, $ifsc_code, $account_number, $pan_card_number ; 

    protected $listeners = [
        'confirmUpdateProfileImage','cancelUpdateProfileImage','openEditSection','closedEditSection'
    ];

    public function mount(){
        $this->authUser = auth()->user();
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
        $this->date_of_join      = $this->authUser->date_of_join;
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
        $this->bank_name          = $this->authUser->profile->bank_name;
        $this->branch_name        = $this->authUser->profile->branch_name;
        $this->ifsc_code          = $this->authUser->profile->ifsc_code;
        $this->account_number     = $this->authUser->profile->account_number;
        $this->pan_card_number    = $this->authUser->profile->pan_card_number;
    
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
            'bank_name'         => '',
            'branch_name'       => '',
            'ifsc_code'         => '',
            'account_number'    => '',
            'pan_card_number'   => '',
        ]);

        $userDetails = [];
        $userDetails['first_name'] = $this->first_name;
        $userDetails['last_name']  = $this->last_name;
        $userDetails['name']       = $this->first_name.' '.$this->last_name;
        $userDetails['phone']      = $this->phone;

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
        $profileDetails['bank_name']        = $this->bank_name;
        $profileDetails['branch_name']      = $this->branch_name;
        $profileDetails['ifsc_code']        = $this->ifsc_code;
        $profileDetails['account_number']   = $this->account_number;
        $profileDetails['pan_card_number']  = $this->pan_card_number;

        $this->authUser->profile()->update($profileDetails);

        $this->closedEditSection();
        $this->alert('success', 'Profile has been updated.');
    }

    public function resetFields(){
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
        $this->nominee_relation   = '';
        $this->bank_name          = '';
        $this->branch_name        = '';
        $this->ifsc_code          = '';
        $this->account_number     = '';
        $this->pan_card_number    = '';
    }

}
