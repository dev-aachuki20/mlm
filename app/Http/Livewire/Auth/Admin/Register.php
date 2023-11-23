<?php

namespace App\Http\Livewire\Auth\Admin;

use Mail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Invoice;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use App\Mail\SendRegisteredUserMail;
use App\Mail\SendPlanPurchasedMail;
use App\Mail\SendRefferalCommissionMail;

class Register extends Component
{
    use LivewireAlert;

    public $first_name, $last_name, $email, $phone, $dob, $gender, $password, $password_confirmation;

    public $from_url_referral_id, $from_url_referral_name, $packageUUID, $referral_id, $referral_name, $address;

    public $paymentMode = false, $paymentSuccess = false, $paymentResponse = null, $share_email, $share_password;

    public $showResetBtn = false;


    protected $listeners = ['updateDOB', 'updatePaymentStatus'];

    protected function rules()
    {
        return [
            'first_name' => ['required', 'string', 'regex:/^[^\d\s]+(\s{0,1}[^\d\s]+)*$/', 'max:255'],
            'last_name'  => ['required', 'string', 'regex:/^[^\d\s]+(\s{0,1}[^\d\s]+)*$/', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', Rule::unique((new User)->getTable(), 'email')],
            'phone'      => ['required', 'digits:10'],
            'dob'        => ['required'],
            'gender'     => ['required'],
            'referral_id'   => ['required', 'regex:/^\S*$/u', 'exists:users,my_referral_code'],
            'referral_name'   => ['required', 'regex:/^[A-Za-z]+( [A-Za-z]+)?$/u'],
            'address'         => ['required', 'string'],
            // 'password' => ['required', 'string', 'min:8'],
            // 'password_confirmation' => 'min:8|same:password',
        ];
    }

    protected function messages()
    {
        // return getCommonValidationRuleMsgs();
        return [
            'first_name.regex' => trans('validation.alpha'),
            'last_name.regex' => trans('validation.alpha'),
        ];
    }

    public function mount($referralId = '', $packageUUID = '')
    {
        if (!empty($referralId)) {
            $getReferralUser     = User::where('uuid', $referralId)->first();
            $this->referral_id   = $getReferralUser->my_referral_code;
            $this->referral_name = $getReferralUser->name;
            $this->from_url_referral_id   = $this->referral_id;
            $this->from_url_referral_name = $this->referral_name;
        }

        if (!empty($packageUUID)) {
            $this->packageUUID = $packageUUID;
            $packageExists = Package::where('uuid', $this->packageUUID)->where('status', 1)->exists();
            if (!$packageExists) {
                return abort(404);
            }
        }
    }

    public function checkReferral()
    {
        $checkReferal =  User::where('my_referral_code', $this->referral_id)->first();
        if ($checkReferal) {
            $this->resetErrorBag('referral_id');
            $this->referral_id = $checkReferal->my_referral_code;
            $this->referral_name = $checkReferal->name;
        } else {
            $this->referral_name = '';
            $this->addError('referral_id', 'Invalid referral Id');
        }
    }

    public function updatePaymentStatus($package_id, $paymentResponse)
    {
        $this->paymentMode     = false;
        $this->paymentSuccess  = true;
        $this->paymentResponse = json_decode($paymentResponse, true);
        $this->storeRegister($package_id);
    }


    public function render()
    {
        return view('livewire.auth.admin.register');
    }

    public function storeRegister($package_id = '')
    {
        $validated = $this->validate($this->rules(), $this->messages());

        $this->paymentMode = true;

        if ($this->paymentSuccess) {
            DB::beginTransaction();
            try {

                $referral_user = User::where('my_referral_code', $this->referral_id)->first();
                $password = generateRandomString(8);

                $data = [
                    'uuid'       => Str::uuid(),
                    'first_name' => $this->first_name,
                    'last_name'  => $this->last_name,
                    'name'       => $this->first_name . ' ' . $this->last_name,
                    'email'      => $this->email,
                    'phone'      => $this->phone,
                    'dob'        => Carbon::parse($this->dob)->format('Y-m-d'),
                    'date_of_join'     => Carbon::now()->format('Y-m-d'),
                    'my_referral_code' => generateRandomString(10),
                    'referral_code'    => $this->referral_id,
                    'referral_name'    => $this->referral_name,
                    'referral_user_id' => $referral_user->id,
                    'password'         => Hash::make($password),
                    'password_set_at'   => Carbon::now(),
                    'email_verified_at' => Carbon::now(),
                ];
                $user = User::create($data);

                if ($user) {
                    $userId = $user->id;

                    // Assign user Role
                    $user->roles()->sync([3]);
                    $user->packages()->sync([$package_id]);
                    $pkgData = Package::where('id', $package_id)->first();

                    // Profile records
                    $profileData = [
                        'user_id'        => $user->id,
                        'gender'         => $this->gender,
                        'address'        => $this->address,
                    ];

                    $prodata =   $user->profile()->create($profileData);

                    $pro_data = [
                        'user_id' => $prodata->user_id,
                        'gender'    => $prodata->gender,
                        'address'  => $prodata->address,
                    ];

                    $userdata = [
                        'id' => $user->id,
                        'uuid'    => $user->uuid,
                        'first_name'  => $user->first_name,
                        'last_name'  => $user->last_name,
                        'name'  => $user->name,
                        'email'  => $user->email,
                        'phone'  => $user->phone,
                        'dob'  => $user->dob,
                        'date_of_join'  => $user->date_of_join,
                    ];

                    $user_profile_data =  array_merge($userdata,$pro_data);

                    // Kyc records
                    $kycRecords = [
                        'user_id'        => $user->id,
                        'created_at'     => date('Y-m-d H:i:s'),
                        'updated_at'     => date('Y-m-d H:i:s'),
                    ];
                    $user->kycDetail()->create($kycRecords);

                    //Start Payment Transaction
                    $response = $this->paymentResponse;
                    $amount = (float)$response['amount'] / 100;
                    $payment = Payment::create([
                        'user_id'       => $userId,
                        'package_id'    => $package_id,
                        'r_payment_id'  => $response['id'],
                        'method'        => $response['method'],
                        'currency'      => $response['currency'],
                        'user_email'    => $response['email'],
                        'amount'        => $amount,
                        'json_response' => json_encode((array)$response)
                    ]);

                    if ($payment) {
                        foreach (config('constants.referral_levels') as $levelKey => $level) {
                            $transactionRecords = [];
                            $commissionAmount = null;
                            $referralUserId = null;
                            if ($levelKey == 1) {
                                $commissionAmount   = $user->packages()->first()->level_one_commission;
                                $referralUserId     = $referral_user->id ?? null;
                            } elseif ($levelKey == 2) {
                                $commissionAmount   = $user->packages()->first()->level_two_commission;
                                $referralUserId     = $referral_user->referrer->id ?? null;
                            } elseif ($levelKey == 3) {
                                $commissionAmount   = $user->packages()->first()->level_three_commission;
                                $referralUserId     = $referral_user->referrer->referrer->id ?? null;
                            }

                            if ($commissionAmount && $referralUserId) {
                                $transactionRecords['user_id']         = $userId;
                                $transactionRecords['payment_id']      = $payment->id;
                                $transactionRecords['payment_type']    = 'credit';
                                $transactionRecords['type']            = $levelKey;
                                $transactionRecords['gateway']         = '1';
                                $transactionRecords['amount']          = $commissionAmount;
                                $transactionRecords['referrer_id']     = $referralUserId;

                                $transactionCreated = Transaction::create($transactionRecords);
                            }
                        }

                        // Start to create invoice
                        $createInvoice  = Invoice::create([
                            'user_id'               => $userId,
                            'transaction_details'   => json_encode($payment),
                            'package_json'          => json_encode($pkgData),
                            'user_json'             => json_encode($user_profile_data),
                            'purpose'               => 'Package Purchased',
                            'amount'                => $amount,
                            'type'                  => 'Cr',
                            'entry_type'            => 'Invoice',
                            'date_time'             => Carbon::now(),
                        ]);
                        //End to create invoice

                    }

                    //End Payment Transaction

                    //Send welcome mail for user
                    $subject = 'Welcome to ' . config('app.name');
                    Mail::to($user->email)->queue(new SendRegisteredUserMail($subject, $user->name));

                    //Send mail for plan purchased
                    $subject = 'Plan Purchased';
                    $planName = $user->packages()->first()->title;
                    Mail::to($user->email)->queue(new SendPlanPurchasedMail($subject, $user->name, $planName));

                    //Verification mail sent
                    // $user->sendEmailVerificationNotification();

                    // Send mail to reffrals
                    $LevelOnereffraluser= $user->referrer->id ?? null;
                    if($LevelOnereffraluser){
                        $LOnecommissionAmount   = $user->packages()->first()->level_one_commission;
                        $levelOneuser = User::where('id',$LevelOnereffraluser)->first();
                        $subject = "Passive Income";
                        Mail::to($levelOneuser->email)->queue(new SendRefferalCommissionMail($subject,$levelOneuser->name,$user->name,$user->email,$user->phone,$planName,$LOnecommissionAmount));

                        $LevelTworeffraluser= $user->referrer->referrer->id ?? null;
                        if($LevelTworeffraluser){
                            $LTwocommissionAmount   = $user->packages()->first()->level_two_commission;
                            $levelTwouser = User::where('id',$LevelTworeffraluser)->first();
                            $subject = "Active Income";
                            Mail::to($levelTwouser->email)->queue(new SendRefferalCommissionMail($subject,$levelTwouser->name,$user->name,$user->email,$user->phone,$planName,$LTwocommissionAmount));
                        }
                    }

                    DB::commit();

                    $this->share_email = $this->email;
                    $this->share_password = $password;

                    $this->resetInputFields();

                    // Set Flash Message
                    $this->alert('success', trans('panel.message.register_success'));
                    // $this->flash('success', trans('panel.message.register_success'));

                    // return redirect()->route('auth.payment-success');
                } else {
                    $this->resetInputFields();

                    // Set Flash Message
                    $this->alert('error', trans('panel.message.error'));
                }
            } catch (\Exception $e) {
                DB::rollBack();
                // dd($e->getMessage() . '->' . $e->getLine());
                $this->alert('error', trans('messages.error_message'));
            }
        }
    }

    public function checkEmail()
    {
        $validated = $this->validate([
            'email'    => ['required', 'email'],
        ]);

        $user = User::where('email', $this->email)->first();
        if ($user) {
            if (is_null($user->email_verified_at)) {
                $this->showResetBtn = true;
            }
            $this->addError('email', trans('panel.message.email_already_taken'));
        } else {
            $this->resetErrorBag('email');
        }
    }

    public function updateDOB($date)
    {
        $this->dob = $date;
    }

    public function resetInputFields()
    {
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
        $this->paymentResponse = null;
    }
}
