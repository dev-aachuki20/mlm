<?php

namespace App\Http\Livewire\Auth\Admin;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;


class Register extends Component
{
    use LivewireAlert;

    public $first_name, $last_name, $email, $phone ,$dob, $gender, $password ,$password_confirmation;

    public $referral_id, $referral_name, $address;

    public $showResetBtn = false;

    protected $listeners = [ 'updateDOB'
    ];
    
    protected function rules()
    {
        return [
            'first_name' => ['required', 'string','regex:/^[^\d\s]+(\s{0,1}[^\d\s]+)*$/', 'max:255'],
            'last_name'  => ['required', 'string','regex:/^[^\d\s]+(\s{0,1}[^\d\s]+)*$/', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', Rule::unique((new User)->getTable(), 'email')],
            'phone'      => ['required','digits:10'],
            'dob'        => ['required'],
            'gender'     => ['required'],
            'referral_id'   => ['required','regex:/^\S*$/u','exists:users,my_referral_code'],
            'referral_name'   => ['required','regex:/^[A-Za-z]+( [A-Za-z]+)?$/u'],
            'address'         => ['required'],
            // 'password' => ['required', 'string', 'min:8'],
            // 'password_confirmation' => 'min:8|same:password',
        ];
    }

    protected function messages() 
    {
        // return getCommonValidationRuleMsgs();
        return [
            'first_name.regex' => trans('validation.not_allowed_numeric'),
            'last_name.regex' => trans('validation.not_allowed_numeric'),
        ];
    }

    public function mount($referralId = ''){
        if(!empty($referralId)){
            $referralId = decrypt($referralId);
            $getReferralUser     = User::find($referralId);
            $this->referral_id   = $getReferralUser->my_referral_code;
            $this->referral_name = $getReferralUser->name;
        }
    }

    public function render()
    {
        
        // $encryptReferralId = encrypt(7);
        // $decryptReferralId = decrypt($encryptReferralId);

        // dd($encryptReferralId,$decryptReferralId);

        return view('livewire.auth.admin.register');
    }

    public function storeRegister()
    {
        $validated = $this->validate($this->rules(),$this->messages());
 
        DB::beginTransaction();
        try {

            $referral_user_id = User::where('my_referral_code',$this->referral_id)->value('id');

            $data = [ 
                'first_name' => $this->first_name, 
                'last_name'  => $this->last_name, 
                'name'       => $this->first_name.' '.$this->last_name,
                'email'      => $this->email,
                'phone'      => $this->phone,
                'dob'        => Carbon::parse($this->dob)->format('Y-m-d'),
                'date_of_join'     => Carbon::now()->format('Y-m-d'),
                'my_referral_code' => generateRandomString(10),
                'referral_code'    => $this->referral_id,
                'referral_name'    => $this->referral_name,
                'referral_user_id' => $referral_user_id,

                // 'password'   => Hash::make($this->password)
            ];
            $user = User::create($data);
            if($user){
                // Assign user Role
                $user->roles()->sync([3]);

                $profileData = [
                    'user_id'        => $user->id,
                    'gender'         => $this->gender,
                    'address'        => $this->address,
                ];

                $user->profile()->create($profileData);

                //Verification mail sent
                $user->sendEmailVerificationNotification();

                DB::commit();

                $this->resetInputFields();

                // Set Flash Message
                $this->flash('success', trans('panel.message.check_email_verification'));
                
                return redirect()->route('auth.login');
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
    
    public function checkEmail()
    {
        $validated = $this->validate([
            'email'    => ['required','email'],
        ]);

        $user = User::where('email', $this->email)->first();
        if ($user) {
            if(is_null($user->email_verified_at)){
                $this->showResetBtn = true;
            }
            $this->addError('email', trans('panel.message.email_already_taken'));
        }else{
            $this->resetErrorBag('email');
        }
    }

    public function updateDOB($date){
        $this->dob = $date;
    }

    public function resetInputFields(){
        $this->first_name   = ''; 
        $this->last_name    = ''; 
        $this->email        = '';
        $this->phone        = '';
        $this->dob          = '';
        $this->date_of_join = '';
        $this->gender       = '';
        $this->referral_id  = '';
        $this->referral_name = '';
        $this->address = '';
    }
  
}
