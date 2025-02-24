<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Razorpay\Api\Api;
use App\Models\Payment;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Http\Request;


class PaymentComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public $amount=0.00, $getData;
    
    public $defaultSelectedPackage = 1, $fromURLPackageSelected=false, $select_package, $packageId, $payment_gateway;

    protected $listeners = ['pay','paymentSuccessful'];

    public function mount($data,$packageUUID = ''){
        $this->getData = $data;
        
        if(!empty($packageUUID)){
            $this->fromURLPackageSelected = true;
            $packageExists = Package::where('uuid',$packageUUID)->where('status',1)->first();
            if($packageExists){
                $this->defaultSelectedPackage = $packageExists->id;
            }
        }

        $this->handleOptionSelection($this->defaultSelectedPackage);
    }
    
    public function handleOptionSelection($seletPackage)
    {
        $this->select_package = $seletPackage;
    }

   

    public function render()
    {
        $packages = Package::where('status',1)->get();

        return view('livewire.auth.payment-component',compact('packages'));
    }

    public function pay()
    {
        $validated = $this->validate([
            'select_package' => 'required',
            'payment_gateway'   => 'required',
        ]);

        $package = Package::where('status',1)->where('id',$this->select_package)->first();
        if($package){
            $this->packageId = $package->id;
            $this->amount = $package->amount;
          
            switch($this->payment_gateway) {
               
                case($this->payment_gateway == 'razorpay' && (getSetting('razorpay_status') == 'active')):
                    // Redirect to the Razorpay checkout form
                    $this->dispatchBrowserEvent('openRazorpayCheckout', [
                        'name'  => $this->getData['first_name'].' '.$this->getData['last_name'],
                        'email' => $this->getData['email'],
                        'phone' => $this->getData['phone'],
                        'amount' => (float)$this->amount * 100,
                        'payment_gateway' => $this->payment_gateway,
                    ]);
                    break;
     
                case($this->payment_gateway == 'cod' && (getSetting('payment_cod_status') == 'active')):
                     
                    // Open the cod modal
                    $this->dispatchBrowserEvent('openCODModal',[
                        'packageId'=>$this->packageId,
                        'name'  => $this->getData['first_name'].' '.$this->getData['last_name'],
                        'email' => $this->getData['email'],
                        'phone' => $this->getData['phone'],
                        'amount' => (float)$this->amount,
                        'payment_gateway' => $this->payment_gateway,
                    ]);
                    break;

                // case('phonepe'):

                //     $this->phonePe($this->amount);

                //     break;
     
                default:
                  $this->alert('error','Invalid payment type!');
            }

           
        }else{
            $this->alert('error','Package is required!');
        }
        
    }

    public function phonePe($amount){
        
        try {
          
            $phonePayMerchantId = getSetting('phone_pe_merchant_id') ? getSetting('phone_pay_merchant_id') : config('services.phonepe.merchant_id');

            $phonePeKey = getSetting('phone_pe_key') ? getSetting('phone_pe_key') : config('services.phonepe.key');

            $phonePeIndex = config('services.phonepe.index');

            $data = array(
                "merchantId" => $phonePayMerchantId,
                "merchantTransactionId" =>  "MT785059006818815",
                "merchantUserId"=> generateRandomString(20),
                "mobileNumber"=> $this->getData['phone'] ?? null,
                "amount"=> (float)$amount*100,
                "redirectUrl"=>  route('pay-callback-url'),
                "redirectMode"=> "POST",
                "callbackUrl"=> route('pay-callback-url'),
                "paymentInstrument"=> array(
                    "type"=>"PAY_PAGE"
                )
            );

            storeSessionData('user_details','test');

            $encode = base64_encode(json_encode($data));

            $string = $encode.'/pg/v1/pay'.$phonePeKey;
            $sha256 = hash('sha256',$string);

            $finalXHeader = $sha256.'###'.$phonePeIndex;

            $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay";

            $response = Curl::to($url)
                    ->withHeader('Content-Type:application/json')
                    ->withHeader('X-VERIFY:'.$finalXHeader)
                    ->withData(json_encode(['request' => $encode]))
                    ->post();

            $rData = json_decode($response);

            $userDetails = collect($this->getData)->except(['password','password_confirmation','from_url_referral_name','from_url_referral_id','share_email','share_password','paymentResponse','paymentMode','paymentSuccess','paymentGatewayType','paymentGatewayType','showResetBtn','cod_transaction_id','codRequest']);

            return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);

        }catch (\Exception $e) {
            dd($e->getMessage() . '->' . $e->getLine());
            $this->alert('error',trans('messages.error_message'));
        }
    }

    public function paymentSuccessful($payment_id)
    {
        $razorPayKey = getSetting('razorpay_key') ? getSetting('razorpay_key') : config('services.razorpay.key');
        $razorPaySecret = getSetting('razorpay_secret') ? getSetting('razorpay_secret') : config('services.razorpay.secret');
        
        $api = new Api($razorPayKey, $razorPaySecret);

        DB::beginTransaction();
     
        if($payment_id){
         
            $payment = $api->payment->fetch($payment_id);
            try {

                $response = $api->payment->fetch($payment_id)->capture(array('amount' => $payment['amount']));

                // Convert the Razorpay\Api\Payment object to array
                $paymentArray = $response->toArray();
                // Convert the payment array to JSON
                $jsonData = json_encode($paymentArray);

                DB::commit();

                $this->emit('updatePaymentStatus','razorpay',$this->packageId,$jsonData);


            }catch (\Exception $e) {
                DB::rollBack();
                // dd($e->getMessage().'->'.$e->getLine());
                $this->alert('error',trans('messages.error_message'));
            }
        }

    }


   
}
