<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Razorpay\Api\Api;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentComponent extends Component
{
    public $amount=10;
    public $razorpay_payment_id;

    protected $listeners = ['pay','paymentSuccessful'];

    public function render()
    {
        return view('livewire.auth.payment-component');
    }

    public function pay()
    {
        // Create a new instance of the Razorpay API
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        // Create an order
        $order = $api->order->create([
            'amount' => $this->amount * 100,
            'currency' => 'INR',
            'receipt' => uniqid(),
        ]);

        $this->razorpay_payment_id = $order->id;
        dd($order);

        // $this->paymentSuccessful();
        // Redirect to the Razorpay payment page
        // return redirect()->to($order['short_url']);

        // return redirect()->to('https://rzp.io/l/ikmbG9Jeb');
        
    }

    public function paymentSuccessful()
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        DB::beginTransaction();
     
        if($this->razorpay_payment_id){
            dd($api->payment);
            $payment = $api->payment->fetch($this->razorpay_payment_id);
            try {

                $response = $api->payment->fetch($this->razorpay_payment_id)->capture(array('amount' => $payment['amount']));

                $payment = Payment::create([
                    'r_payment_id'  => $response['id'],
                    'method'        => $response['method'],
                    'currency'      => $response['currency'],
                    'user_email'    => $response['email'],
                    'amount'        => $response['amount']/100,
                    'json_response' => json_encode((array)$response)
                ]);

                DB::commit();
                $this->alert('error',trans('Payment Successful'));

            }catch (\Exception $e) {
                DB::rollBack();
                dd($e->getMessage().'->'.$e->getLine());
                $this->alert('error',trans('messages.error_message'));
            }
        }

    }
}
