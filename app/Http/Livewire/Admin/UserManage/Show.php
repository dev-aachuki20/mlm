<?php

namespace App\Http\Livewire\Admin\UserManage;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{
    use LivewireAlert;

    protected $layout = null;
    
    public $detail,$editMode = false, $formType, $editButtonStatus=['personal-detail'=>true,'nominee-detail'=>true,'kyc-detail'=>true];

    public $user_id = null, $first_name, $last_name, $email,$phone, $dob, $date_of_join,$my_referral_code,$referral_code,$referral_name; 

    public $guardian_name, $gender, $profession, $marital_status, $address, $state, $city, $pin_code, $nominee_name, $nominee_dob, $nominee_relation; 

    public $account_holder_name, $account_number, $bank_name, $branch_name, $ifsc_code, $aadhar_card_name, $aadhar_card_number,  $pan_card_name, $pan_card_number;

    protected $listeners = [
        'updateDateOfJoin','updatedDob','updateNomineeDob','refreshComponent'=>'$refresh'
    ];

    public function mount($user_id){
        $this->user_id = $user_id;
        $this->detail = User::find($user_id);
    }

    public function editStepForm($formType){
        $this->editButtonStatus = ['personal-detail'=>true,'nominee-detail'=>true,'kyc-detail'=>true];
        $this->formType = $formType;
        $this->editMode = true;
        $this->editButtonStatus[$this->formType] = false;

        if($this->formType == 'personal-detail'){

            $this->first_name = $this->detail->first_name;
            $this->last_name  = $this->detail->last_name;
            $this->dob        = Carbon::parse($this->detail->dob)->format('d-m-Y');
            $this->guardian_name    = $this->detail->profile->guardian_name;
            $this->gender           = $this->detail->profile->gender;
            $this->profession       = $this->detail->profile->profession;
            $this->marital_status   = $this->detail->profile->marital_status;
            $this->address          = $this->detail->profile->address;
            $this->state            = $this->detail->profile->state;
            $this->city             = $this->detail->profile->city;
            $this->pin_code         = $this->detail->profile->pin_code;

        }elseif($this->formType == 'nominee-detail'){
            $this->nominee_name     = $this->detail->profile->nominee_name;
            $this->nominee_dob      = Carbon::parse($this->detail->profile->nominee_dob)->format('d-m-Y');
            $this->nominee_relation = $this->detail->profile->nominee_relation;

        }elseif($this->formType == 'kyc-detail'){

            $this->account_holder_name  = $this->detail->kycDetail->account_holder_name;
            $this->account_number   = $this->detail->kycDetail->account_number;
            $this->bank_name        = $this->detail->kycDetail->bank_name;
            $this->branch_name      = $this->detail->kycDetail->branch_name;
            $this->ifsc_code        = $this->detail->kycDetail->ifsc_code;
            $this->aadhar_card_name = $this->detail->kycDetail->aadhar_card_name;
            $this->aadhar_card_number = $this->detail->kycDetail->aadhar_card_number;
            $this->pan_card_name      = $this->detail->kycDetail->pan_card_name;
            $this->pan_card_number    = $this->detail->kycDetail->pan_card_number;

        }
        
        $this->emitUp('initializePlugins');
    }

    public function cancelStepForm(){
       $this->reset(['formType','editMode','editButtonStatus']);
    }
    
    
    public function cancel(){
        $this->emitUp('cancel');
    }


    public function update(){
        $validateDataArray = [];
        if($this->formType == 'personal-detail'){
            $validateDataArray['first_name'] = 'required';
            $validateDataArray['last_name']  = 'required';
            $validateDataArray['dob']        = 'required';
            $validateDataArray['guardian_name']  = 'required';
            $validateDataArray['gender']         = 'required|in:male,female,other';
            $validateDataArray['marital_status'] = 'required|in:married,unmarried';
            $validateDataArray['profession']     = 'required';
            $validateDataArray['address']        = 'required';
            $validateDataArray['state']          = 'required';
            $validateDataArray['city']           = 'required';
            $validateDataArray['pin_code']       = 'required';

        }else if($this->formType == 'nominee-detail'){
            $validateDataArray['nominee_name']       = 'required';
            $validateDataArray['nominee_dob']        = 'required';
            $validateDataArray['nominee_relation']   = 'required';

        }else if($this->formType == 'kyc-detail'){
            $validateDataArray['account_number']      = 'required|numeric|digits_between:10,14|regex:/^\S*$/u';
            $validateDataArray['account_holder_name'] = 'required';
            $validateDataArray['bank_name']          = 'required';
            $validateDataArray['branch_name']        = 'required';
            $validateDataArray['ifsc_code']          = 'required|regex:/^\S*$/u';
            $validateDataArray['aadhar_card_name']   = 'required';
            $validateDataArray['aadhar_card_number'] = 'required|digits:12|regex:/^\S*$/u';
            $validateDataArray['pan_card_name']      = 'required';
            $validateDataArray['pan_card_number']    = 'required|min:10|regex:/^\S*$/u';

        }

        $this->emitUp('initializePlugins');

        $validatedData = $this->validate($validateDataArray);

        DB::beginTransaction();
        try {
            $userDetails = [];
            $profileDetails = [];
            $kycDetails = [];

            $updatedUser = User::find($this->user_id);

            if($this->formType == 'personal-detail'){

                $userDetails['first_name'] = $this->first_name;
                $userDetails['last_name']  = $this->last_name;
                $userDetails['dob']        = Carbon::parse($this->dob)->format('Y-m-d');

                $updatedUser->update($userDetails);

                $profileDetails['guardian_name']  = $this->guardian_name;
                $profileDetails['gender']         = $this->gender;
                $profileDetails['marital_status'] = $this->marital_status;
                $profileDetails['profession']     = $this->profession;
                $profileDetails['address']        = $this->address;
                $profileDetails['state']          = $this->state;
                $profileDetails['city']           = $this->city;
                $profileDetails['pin_code']       = $this->pin_code;

                $updatedUser->profile()->update($profileDetails);

            }elseif($this->formType == 'nominee-detail'){

                $profileDetails['nominee_name']     = $this->nominee_name;
                $profileDetails['nominee_dob']      = Carbon::parse($this->nominee_dob)->format('Y-m-d');
                $profileDetails['nominee_relation'] = $this->nominee_relation;

                $updatedUser->profile()->update($profileDetails);

            }elseif($this->formType == 'kyc-detail'){

                $kycDetails['account_number']      = $this->account_number;
                $kycDetails['account_holder_name'] = $this->account_holder_name;
                $kycDetails['bank_name']           = $this->bank_name;
                $kycDetails['branch_name']         = $this->branch_name;
                $kycDetails['ifsc_code']           = $this->ifsc_code;
                $kycDetails['aadhar_card_name']    = $this->aadhar_card_name;
                $kycDetails['aadhar_card_number']  = $this->aadhar_card_number;
                $kycDetails['pan_card_name']       = $this->pan_card_name;
                $kycDetails['pan_card_number']     = $this->pan_card_number;

                $updatedUser->kycDetail()->update($kycDetails);

            }

            DB::commit();

            $this->reset(array_keys($validatedData));

            $this->emit('refreshComponent');

            $this->cancelStepForm();

            $this->alert('success',trans('messages.edit_success_message'));
        
        }catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));
        }
    }

    public function updateDateOfJoin($date){
        $this->date_of_join = Carbon::parse($date)->format('d-m-Y');
    }

    public function updatedDob($date){
        $this->dob = Carbon::parse($date)->format('d-m-Y');
        $this->emitUp('initializePlugins');
    }

    public function updateNomineeDob($date){
        $this->nominee_dob = Carbon::parse($date)->format('d-m-Y');
    }

    public function render()
    {
        return view('livewire.admin.user-manage.show');
    }

    


}
