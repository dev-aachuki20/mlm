<?php

namespace App\Http\Livewire\Admin\UserManage;

use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{
    use LivewireAlert;

    protected $layout = null;
    
    public $detail,$editMode = false, $formType;

    public $user_id = null, $first_name, $last_name, $email,$phone, $dob, $date_of_join,$my_referral_code,$referral_code,$referral_name; 

    public $guardian_name, $gender, $profession, $marital_status, $address, $state, $city, $pin_code, $nominee_name, $nominee_dob, $nominee_relation, $bank_name, $branch_name, $ifsc_code, $account_number, $pan_card_number ; 

    protected $listeners = [
        'editStepForm','update','cancel','updateDateOfJoin','updateDob','updateNomineeDob'
    ];

    public function mount($user_id){
        $this->user_id = $user_id;
        $this->detail = User::find($user_id);
    }

    public function editStepForm($formType){
        dd('hello');
        $this->formType = $formType;
       
        $this->editMode = true;
    }
    
    
    public function cancel(){
        $this->emitUp('cancel');
    }

    public function edit(){
        $this->editMode = true;
       
        $this->first_name = $this->detail->first_name;
        $this->last_name  = $this->detail->first_name;
        $this->email  = $this->detail->email;
        $this->phone  = $this->detail->phone;
        $this->dob    = $this->detail->dob;
        $this->date_of_join     = $this->detail->date_of_join;
        $this->my_referral_code = $this->detail->my_referral_code;
        $this->referral_code    = $this->detail->referral_code;
        $this->referral_name    = $this->detail->referral_name;

        $this->guardian_name    = $this->detail->profile->guardian_name;
        $this->gender           = $this->detail->profile->gender;
        $this->profession       = $this->detail->profile->profession;
        $this->marital_status   = $this->detail->profile->marital_status;
        $this->address          = $this->detail->profile->address;
        $this->state            = $this->detail->profile->state;
        $this->city             = $this->detail->profile->city;
        $this->pin_code         = $this->detail->profile->pin_code;
        $this->nominee_name     = $this->detail->profile->nominee_name;
        $this->nominee_dob      = $this->detail->profile->nominee_dob;
        $this->nominee_relation = $this->detail->profile->nominee_relation;
        $this->bank_name        = $this->detail->profile->bank_name;
        $this->branch_name      = $this->detail->profile->branch_name;
        $this->ifsc_code        = $this->detail->profile->ifsc_code;
        $this->account_number   = $this->detail->profile->account_number;
        $this->pan_card_number  = $this->detail->profile->pan_card_number;
    }

    public function update(){
        $validatedDate = $this->validate([
            'first_name'  => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
            'last_name'   => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
            // 'email'       => 'required|unique:users,email',
            // 'phone'         => 'required|digits:10',
            'dob'           => 'required',
            'guardian_name' => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
            'gender'        => 'required',
            'profession'    => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
            'marital_status' => 'required',

            // 'referral_code' => 'required|regex:/^\S*$/u|exists:users,my_referral_code',
            // 'referral_name' => 'required|regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',
            // 'date_of_join'  => 'required',
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

    public function render()
    {
        return view('livewire.admin.user-manage.show');
    }

    


}
