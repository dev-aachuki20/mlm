<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Razorpay\Api\Api;
use App\Models\Payment;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PaymentComponent extends Component
{
    use LivewireAlert;

    public $amount=0.00, $getData;
    
    public $defaultSelectedPackage = 1, $fromURLPackageSelected=false, $select_package, $packageId;


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

        return view('livewire.auth.payment-component',compact('packages','paymentQrCodeStatus','paymentQrCodeImage'));
    }

    public function pay()
    {
        $validated = $this->validate([
            'select_package' => 'required',
        ]);

       
        $package = Package::where('status',1)->where('id',$this->select_package)->first();
        if($package){
            $this->packageId = $package->id;
            $this->amount = $package->amount;
          
            // Redirect to the Razorpay checkout form
            $this->dispatchBrowserEvent('openRazorpayCheckout', [
                'name' => $this->getData['first_name'].' '.$this->getData['last_name'],
                'email' => $this->getData['email'],
                'phone' => $this->getData['phone'],
                'amount' => (float)$this->amount * 100,
            ]);
        }else{
            $this->alert('error','Package is required!');
        }
        
    }

    public function paymentSuccessful($payment_id)
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

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

                $this->emit('updatePaymentStatus',$this->packageId,$jsonData);


            }catch (\Exception $e) {
                DB::rollBack();
                // dd($e->getMessage().'->'.$e->getLine());
                $this->alert('error',trans('messages.error_message'));
            }
        }

    }
}
