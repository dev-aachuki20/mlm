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
use App\Mail\SendRefferalLevelOneCommissionMail;
use App\Mail\SendRefferalLevelTwoCommissionMail;
use Livewire\WithFileUploads;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class Register extends Component
{
    use LivewireAlert, WithFileUploads, WithRateLimiting;

    public $first_name, $last_name, $email, $phone, $dob, $gender, $password, $password_confirmation;

    public $from_url_referral_id, $from_url_referral_name, $packageUUID, $referral_id, $referral_name, $address;

    public $paymentMode = false, $paymentSuccess = false, $paymentResponse = null, $share_email, $share_password,$paymentGatewayType;

    public $showResetBtn = false;

    public $cod_transaction_id = null, $paymentReceiptImage = null, $paymentReceiptImageOriginal = null, $codRequest = null;

    protected $listeners = ['updateDOB', 'updatePaymentStatus','makeCODPayment','cancelCODPayment','updatedPaymentReceiptImage','updatedPaymentReceiptImageOriginal','updatedCodRequest'];

    protected function rules()
    {
        return [
            'first_name' => ['required', 'string', /*'regex:/^[^\d\s]+(\s{0,1}[^\d\s]+)*$/',*/ 'max:255'],
            'last_name'  => ['required', 'string', /*'regex:/^[^\d\s]+(\s{0,1}[^\d\s]+)*$/',*/ 'max:255'],
            'email'      => ['required', 'string', 'email:dns', Rule::unique((new User)->getTable(), 'email')->whereNull('deleted_at')],
            'phone'      => ['required', 'digits:10'],
            'dob'        => ['required'],
            'gender'     => ['required'],
            'referral_id'   => ['required', 'regex:/^\S*$/u', 'exists:users,my_referral_code'],
            'referral_name'   => ['required', 'string'],
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
            $this->from_url_referral_name = ucwords($this->referral_name);
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
            $this->referral_name = ucwords($checkReferal->name);
        } else {
            $this->referral_name = '';
            $this->addError('referral_id', 'Invalid referral Id');
        }
    }

    public function updatePaymentStatus($paymentGateway, $package_id, $paymentResponse)
    {
        $this->paymentMode     = false;
        $this->paymentSuccess  = true;
        $this->paymentGatewayType = $paymentGateway;
        $this->paymentResponse = json_decode($paymentResponse, true);
        $this->storeRegister($paymentGateway, $package_id);
    }


    public function render()
    {
        return view('livewire.auth.admin.register');
    }

    public function storeRegister($paymentGateway = '', $package_id = '')
    {
        
        $validated = $this->validate($this->rules(), $this->messages());

        DB::beginTransaction();
        try {

            //$this->rateLimit(1,86400);

            $this->paymentMode = true;

            if ($this->paymentSuccess) {
                
                $referral_user = User::where('my_referral_code', $this->referral_id)->first();
                $password = generateRandomString(8);

                $data = [
                    'uuid'       => Str::uuid(),
                    'first_name' => $this->first_name,
                    'last_name'  => $this->last_name,
                    'name'       => $this->first_name . ' ' . $this->last_name,
                    'email'      => strtolower($this->email),
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
                    $amount = $paymentGateway == 'razorpay' ? (float)$response['amount'] / 100 : (float)$response['amount'];

                    $payment = null;
                    if($paymentGateway == 'razorpay'){
                        $payment = Payment::create([
                            'user_id'       => $userId,
                            'package_id'    => $package_id,
                            'r_payment_id'  => $response['id'],
                            'method'        => $response['method'],
                            'currency'      => $response['currency'],
                            'user_email'    => $response['email'],
                            'amount'        => $amount,
                            'payment_gateway' => 'razorpay',
                            'payment_approval'   => 'approved',
                            'payment_type'   => 'plan purchased',
                            'json_response' => json_encode((array)$response)
                        ]);
                    }else if($paymentGateway == 'cod'){
                        $payment = Payment::create([
                            'user_id'       => $userId,
                            'package_id'    => $package_id,
                            'r_payment_id'  => $response['id'],
                            'method'        => $response['method'],
                            'currency'      => $response['currency'],
                            'user_email'    => $response['email'],
                            'amount'        => $amount,
                            'payment_gateway' => 'cod',
                            'payment_approval'   => 'pending',
                            'payment_type'   => 'plan purchased',
                            'json_response' => json_encode((array)$response)
                        ]);
                    }

                    if ($payment) {

                        if($paymentGateway == 'cod'){
                            uploadImage($payment, $this->paymentReceiptImage, 'payment/reciept/',"payment-reciept", 'original', 'save', null);
                        }

                        if($paymentGateway != 'cod'){

                            $packagePurchased = $user->packages()->first();

                            foreach (config('constants.referral_levels') as $levelKey => $level) {
                                $transactionRecords = [];
                                $commissionAmount = null;
                                $referralUserId = null;

                                if ($levelKey == 1 && $referral_user) {

                                    $commissionAmount   = $packagePurchased->level_one_commission;
                                    $referralUserId     = $referral_user->is_user ? $referral_user->id : null;

                                } elseif ($levelKey == 2 && $referral_user->referrer) {

                                    $commissionAmount   = $packagePurchased->level_two_commission;
                                    $referralUserId     = $referral_user->referrer->is_user ? $referral_user->referrer->id : null;

                                } elseif ($levelKey == 3 && $referral_user->referrer) {

                                    if($referral_user->referrer->referrer){
                                        $commissionAmount   = $packagePurchased->level_three_commission;
                                        $referralUserId     = $referral_user->referrer->referrer->is_user ? $referral_user->referrer->referrer->id : null;
                                    }

                                }

                                if ($commissionAmount && $referralUserId) {
                                    $transactionRecords['user_id']         = $userId;
                                    $transactionRecords['payment_id']      = $payment->id;
                                    $transactionRecords['payment_type']    = 'credit';
                                    $transactionRecords['type']            = $levelKey;
                                    $transactionRecords['gateway']         = 1;
                                    $transactionRecords['amount']          = $commissionAmount;
                                    $transactionRecords['referrer_id']     = $referralUserId;

                                    $transactionCreated = Transaction::create($transactionRecords);
                                }
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
                    Mail::to($user->email)->queue(new SendRegisteredUserMail($subject, $user->name, $user->email,$password));

                    //Send mail for plan purchased
                    $subject = 'Plan Purchased';
                    $planName = $user->packages()->first()->title;
                    Mail::to($user->email)->queue(new SendPlanPurchasedMail($subject, $user->name, $planName));

                    //Verification mail sent
                    // $user->sendEmailVerificationNotification();

                    if($paymentGateway != 'cod'){
                        // Send mail to reffrals
                        $LevelOnereffraluser= $user->referrer->id ?? null;
                        if($LevelOnereffraluser){
                            $LOnecommissionAmount   = $user->packages()->first()->level_one_commission;
                            $levelOneuser = User::where('id',$LevelOnereffraluser)->first();
                            $subject = "Passive Income";
                            Mail::to($levelOneuser->email)->queue(new SendRefferalLevelOneCommissionMail($subject,$levelOneuser->name,$user->name,$user->email,$user->phone,$planName,$LOnecommissionAmount));

                            $LevelTworeffraluser= $user->referrer->referrer->id ?? null;
                            if($LevelTworeffraluser){
                                $LTwocommissionAmount   = $user->packages()->first()->level_two_commission;
                                $levelTwouser = User::where('id',$LevelTworeffraluser)->first();
                                $subject = "Active Income";
                                Mail::to($levelTwouser->email)->queue(new SendRefferalLevelTwoCommissionMail($subject,$levelTwouser->name,$user->name,$user->email,$user->phone,$planName,$LTwocommissionAmount));
                            }
                        }
                    }

                    DB::commit();

                    $this->share_email = $this->email;
                    $this->share_password = $password;

                    $this->resetInputFields();

                    // Set Flash Message
                    $this->cancelCODPayment();
                    $this->dispatchBrowserEvent('closedCODModal');
                    $this->alert('success', trans('panel.message.register_success'));
                    // $this->flash('success', trans('panel.message.register_success'));

                    // return redirect()->route('auth.payment-success');

                } else {
                    $this->resetInputFields();

                    //24-11-2023
                    $this->paymentMode     = false;
                    $this->paymentSuccess  = false;

                    // Set Flash Message
                    $this->dispatchBrowserEvent('closedCODModal');
                    $this->alert('error', trans('panel.message.error'));

                }
            
            }

        } catch (TooManyRequestsException $exception) {

            DB::rollBack();
            $this->resetInputFields();

            $this->paymentMode     = false;
            $this->paymentSuccess  = false;
            
            // throw ValidationException::withMessages([
            //     'email' => "Slow down! Please wait another {$exception->secondsUntilAvailable} seconds to log in.",
            // ]);

            $this->dispatchBrowserEvent('closedLoader');
            $this->dispatchBrowserEvent('closedCODModal');

            $this->flash('warning', 'Action rate limit exceeded. Please try again later.');
          
            return redirect()->route('auth.register');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->resetInputFields();
        
            //24-11-2023
            $this->paymentMode     = false;
            $this->paymentSuccess  = false;

            // dd($e->getMessage() . '->' . $e->getLine());
            $this->dispatchBrowserEvent('closedLoader');
            $this->dispatchBrowserEvent('closedCODModal');

            $this->flash('error', trans('messages.error_message'));
            
            return redirect()->route('auth.register');

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


    public function updatedPaymentReceiptImage($image){
        $this->paymentReceiptImage = $image;
    }

    public function updatedPaymentReceiptImageOriginal($image){
        $this->paymentReceiptImageOriginal = $image;
    }

    public function updatedCodRequest($codRequest){
        $this->codRequest = $codRequest;
    }

    public function makeCODPayment(){
        $validatedData = $this->validate([
            'cod_transaction_id' => 'required|string|regex:/^[^\s]+$/',
            'paymentReceiptImage'   => 'required|image',
        ],[],[
            'cod_transaction_id'=>'transaction id',
            'paymentReceiptImage'=>'upload transction receipt'
        ]);

        $requestRecord['id'] = $validatedData['cod_transaction_id'];
        $requestRecord['method'] = 'cod';
        $requestRecord['currency'] = 'INR';
        $requestRecord['name'] = $this->codRequest['name'];
        $requestRecord['email'] = $this->codRequest['email'];
        $requestRecord['amount'] = $this->codRequest['amount'];
        $requestRecord['payment_gateway'] = 'cod';

        $this->updatePaymentStatus('cod',$this->codRequest['packageId'],json_encode($requestRecord));
    }

    public function cancelCODPayment(){
        $this->reset(['cod_transaction_id','paymentReceiptImage','paymentReceiptImageOriginal']);
        $this->resetValidation();
        $this->dispatchBrowserEvent('clearDropify');
    }
}
