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
    
    public $defaultSelectedPackage = 2, $select_package, $packageId;


    protected $listeners = ['pay','paymentSuccessful'];

    public function mount($data){
        $this->getData = $data;
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
        ]);

        $package = Package::find($this->select_package);
        $this->packageId = $package->id;
        $this->amount = $package->amount;
      
        // Redirect to the Razorpay checkout form
        $this->dispatchBrowserEvent('openRazorpayCheckout', [
            'name' => $this->getData['first_name'].' '.$this->getData['last_name'],
            'email' => $this->getData['email'],
            'phone' => $this->getData['phone'],
            'amount' => (float)$this->amount * 100,
        ]);
    }

    public function paymentSuccessful($payment_id)
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        DB::beginTransaction();
     
        if($payment_id){
         
            $payment = $api->payment->fetch($payment_id);
            try {

                $response = $api->payment->fetch($payment_id)->capture(array('amount' => $payment['amount']));

                $payment = Payment::create([
                    'r_payment_id'  => $response['id'],
                    'method'        => $response['method'],
                    'currency'      => $response['currency'],
                    'user_email'    => $response['email'],
                    'amount'        => (float)$response['amount']/100,
                    'json_response' => json_encode((array)$response)
                ]);

                DB::commit();

                $this->emit('updatePaymentStatus',$this->packageId);

                // $this->alert('success',trans('Payment Successful'));

            }catch (\Exception $e) {
                DB::rollBack();
                // dd($e->getMessage().'->'.$e->getLine());
                $this->alert('error',trans('messages.error_message'));
            }
        }

    }
}
