<?php

namespace App\Http\Livewire\Auth;

use Mail;
use Auth;
use Livewire\Component;
use App\Models\User;
use App\Rules\IsActive;
use App\Http\Livewire\BaseComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PaymentSuccess extends Component
{
    use LivewireAlert;

    public $email, $password, $remember_me,$paymentGatewayType;

    public function mount($share_email,$share_password,$paymentGatewayType){
        $this->email    = $share_email;
        $this->password = $share_password;
        $this->paymentGatewayType = $paymentGatewayType;
    }

    public function render()
    {
        $email = $this->email;
        $password = $this->password;

        return view('livewire.auth.payment-success',compact('email','password'));
    }


    public function submitLogin()
    {
        $validated = $this->validate([
            'email'    => ['required','email',new IsActive],
            'password' => 'required',
        ]);
         
        $remember_me = !is_null($this->remember_me) ? true : false;
        $credentialsOnly = [
            'email'    => $this->email,
            'password' => $this->password,
        ]; 

        try {
            $checkVerified = User::where('email',$this->email)->whereNull('email_verified_at')->first();
            if(!$checkVerified){
                if($checkVerified->payment_status == 1){
                    $this->alert('warning', 'Your payment is not approved. so you cannot login!');
                    return redirect()->route('auth.login');
                }
                
                if (Auth::attempt($credentialsOnly, $remember_me)) {
            
                    $this->reset(['email','password']);
                    $this->resetErrorBag();
                    $this->resetValidation();

                    $this->flash('success', trans('panel.message.login_success'));

                    if(Auth::user()->is_user){
                        return redirect()->route('user.dashboard');
                    }else{
                        return redirect()->route('admin.dashboard');
                    }
                  
                }
        
                $this->addError('email', trans('auth.failed'));
            }
            
            $this->reset(['email','password']);
        
        } catch (ValidationException $e) {

            $this->addError('email', $e->getMessage());
        }
    
    }
}
