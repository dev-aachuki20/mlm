<?php

namespace App\Http\Livewire\User\Kyc;

use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert, WithFileUploads;

    protected $layout = null;

    public $formMode = false;

    public $account_holder_name, $bank_name, $account_number, $ifsc_code, $pan_card_name, $pan_card_number, $aadhar_card_name, $aadhar_card_number;

    public $authUser, $aadharCardImageFront=null,$aadharFrontOriginal, $aadharCardImageBack=null,$aadharBackOriginal, $panCardImage=null, $panOriginal;

    // protected $listeners = [
       
    // ];

    public function mount(){
       $this->authUser = auth()->user();
    }

    public function render()
    {
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
        $this->aadhar_card_name    = $this->authUser->kycDetail->aadhar_card_name;
        $this->aadhar_card_number  =  $this->authUser->kycDetail->aadhar_card_number;

        $this->initializePlugins();
    }

    public function updateKycDetails(){
        $validateArr = [
            'account_holder_name'   => ['required', 'string'],
            'bank_name'             => ['required', 'string'],
            'account_number'        => ['required', 'string'],
            'ifsc_code'             => ['required', 'string'],
            'pan_card_name'         => ['required', 'string'],
            'pan_card_number'       => ['required', 'string'],
            'aadhar_card_name'      => ['required', 'string'],
            'aadhar_card_number'    => ['required', 'numeric'],
        ];

        $validationMessages = [
            'required' => 'The field is required.',
            'account_holder_name.required' => 'The Full name is required', 
        ];

        // if($this->image || $this->removeImage){
        //     $validatedArray['image'] = 'required|image|max:'.config('constants.img_max_size');
        // }

        $vaidateData = $this->validate($validateArr,$validationMessages);
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
            'panCardImage',
            'panOriginal',
        ];
        $this->reset($resetArray);
    }
}
