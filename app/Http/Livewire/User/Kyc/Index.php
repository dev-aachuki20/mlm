<?php

namespace App\Http\Livewire\User\Kyc;

use App\Models\Kyc;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\BaseComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends BaseComponent
{
    use LivewireAlert, WithFileUploads;

    protected $layout = null;

    public $formMode = false;

    public $account_holder_name, $bank_name, $account_number, $ifsc_code, $pan_card_name, $pan_card_number, $aadhar_card_name, $aadhar_card_number;

    public $authUser, $aadharCardImageFront=null,$aadharFrontOriginal, $aadharCardImageBack=null,$aadharBackOriginal, $pan_card_image=null, $panOriginal;

    public $isRemovePanCardImage =false, $isRemoveAadharCardFrontImg = false, $isRemoveAadharCardBackImg = false;

    public $profile_image, $showConfirmCancel = false;

    protected $listeners = [
       
    ];

    public function mount(){
    }

    public function validateProfileImage()
    {
        $this->showConfirmCancel = true;

        $validateImage = $this->validate([
            'profile_image' => 'image|max:'.config('constants.profile_image_size'), // Maximum file size of 1MB
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

        if ($response) {
            $this->emit('profileImageUpdated', true);

            // Set Flash Message
            $this->alert('success', 'Picture has been updated.');
        } else {

            $this->alert(trans('panel.alert-type.error'), trans('panel.message.error'));
        }
    }

    public function cancelUpdateProfileImage()
    {
        $this->showConfirmCancel = false;

        $this->reset(['profile_image']);
    }

    public function render()
    {
        $this->authUser = auth()->user();
        return view('livewire.user.kyc.index');
    }

    public function openEdit(){
        $this->formMode = true;
       
        $this->account_holder_name = $this->authUser->kycDetail->account_holder_name;
        $this->bank_name           = $this->authUser->kycDetail->bank_name;
        $this->account_number      = $this->authUser->kycDetail->account_number;
        $this->ifsc_code           = $this->authUser->kycDetail->ifsc_code;

        $this->pan_card_name       = $this->authUser->kycDetail->pan_card_name;
        $this->pan_card_number     = $this->authUser->kycDetail->pan_card_number;
        $this->panOriginal         =  $this->authUser->pancard_image_url;

        $this->aadhar_card_name    = $this->authUser->kycDetail->aadhar_card_name;
        $this->aadhar_card_number  =  $this->authUser->kycDetail->aadhar_card_number;
        $this->aadharFrontOriginal  =  $this->authUser->aadhar_front_image_url;
        $this->aadharBackOriginal   =  $this->authUser->aadhar_back_image_url;

        $this->initializePlugins();
    }

    public function updateKycDetails(){
        $validateArr = [
            'account_holder_name'   => ['required', 'string'],
            'bank_name'             => ['required', 'string'],
            'account_number'        => ['required', 'numeric'],
            'ifsc_code'             => ['required', 'string'],
            'pan_card_name'         => ['required', 'string'],
            'pan_card_number'       => ['required', 'alpha_num','size:10',Rule::unique((new Kyc)->getTable(), 'pan_card_number')->ignore($this->authUser->kycDetail->id)],
            'aadhar_card_name'      => ['required', 'string'],
            'aadhar_card_number'    => ['required', 'numeric','digits:12',Rule::unique((new Kyc)->getTable(), 'aadhar_card_number')->ignore($this->authUser->kycDetail->id)],
        ];

        $validationMessages = [
            'required' => 'The field is required.',
            'account_holder_name.required' => 'The Full name is required', 
        ];

        if(empty($this->authUser->profile_image_url)){
            $validateArr['profile_image'] = 'required|image|max:'.config('constants.profile_image_size');
        }

        if(is_null($this->authUser->pancard_image_url) || ($this->pan_card_image || $this->isRemovePanCardImage)){
            $validateArr['pan_card_image'] = 'required|image|mimes:'.config('constants.pancard_image.extensions').'|min:'.config('constants.pancard_image.size.min').'|max:'.config('constants.pancard_image.size.max');
        }

        if(is_null($this->authUser->aadhar_front_image_url) || $this->aadharCardImageFront || $this->isRemoveAadharCardFrontImg){
            $validateArr['aadharCardImageFront'] = 'required|image|mimes:'.config('constants.aadharcard_image.extensions').'|min:'.config('constants.aadharcard_image.size.min').'|max:'.config('constants.aadharcard_image.size.max');
        }

        if(is_null($this->authUser->aadhar_back_image_url) || $this->aadharCardImageBack || $this->isRemoveAadharCardBackImg){
            $validateArr['aadharCardImageBack'] = 'required|image|mimes:'.config('constants.aadharcard_image.extensions').'|min:'.config('constants.aadharcard_image.size.min').'|max:'.config('constants.aadharcard_image.size.max');
        }

        $vaidateData = $this->validate($validateArr,$validationMessages);

        DB::beginTransaction();
        try{
            $isUpdated = $this->authUser->kycDetail->update($vaidateData);

            if($isUpdated){
    
                // Start to upload pancard
                if($this->pan_card_image) {
                    if($this->authUser->panCardImage){
                        $uploadImageId = $this->authUser->panCardImage->id;
                        uploadImage($this->authUser, $this->pan_card_image, 'user/documents/',"pancard", 'original', 'update', $uploadImageId);
                    }else{
                        uploadImage($this->authUser, $this->pan_card_image, 'user/documents/',"pancard", 'original', 'save', null);
                    }
                }
                // End to upload pancard
    
                // Start to upload aadhar card front
                if($this->aadharCardImageFront) {
                    if($this->authUser->aadharFrontImage){
                        $uploadImageId = $this->authUser->aadharFrontImage->id;
                        uploadImage($this->authUser, $this->aadharCardImageFront, 'user/documents/',"aadhar-card-front", 'original', 'update', $uploadImageId);
                    }else{
                        uploadImage($this->authUser, $this->aadharCardImageFront, 'user/documents/',"aadhar-card-front", 'original', 'save', null);
                    }
                }
                // End to upload aadhar card front
    
                 // Start to upload aadhar card back
                 if($this->aadharCardImageBack) {
                    if($this->authUser->aadharBackImage){
                        $uploadImageId = $this->authUser->aadharBackImage->id;
                        uploadImage($this->authUser, $this->aadharCardImageBack, 'user/documents/',"aadhar-card-back", 'original', 'update', $uploadImageId);
                    }else{
                        uploadImage($this->authUser, $this->aadharCardImageBack, 'user/documents/',"aadhar-card-back", 'original', 'save', null);
                    }
                }
                // End to upload aadhar card back
    
                DB::commit();

                $this->alert('success',trans('messages.edit_success_message'));
                $this->cancel();
            }

        }catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));
        }
       
    }

    public function cancel(){
        $this->formMode = false;
        $this->resetFields();
        $this->resetValidation();
    }

    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }

    public function resetFields(){
        $resetArray = [
            'account_holder_name',
            'bank_name',
            'account_number',
            'ifsc_code',
            'pan_card_name',
            'pan_card_number',
            'aadhar_card_name',
            'aadhar_card_number',
            'aadharCardImageFront',
            'aadharFrontOriginal',
            'aadharCardImageBack',
            'aadharBackOriginal',
            'pan_card_image',
            'panOriginal',
        ];
        $this->reset($resetArray);
    }
}
