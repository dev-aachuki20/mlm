<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class PaymentSuccess extends Component
{
    public $email, $password;

    public function mount($share_email,$share_password){
        $this->email    = $share_email;
        $this->password = $share_password;
    }

    public function render()
    {
        $email = $this->email;
        $password = $this->password;

        return view('livewire.auth.payment-success',compact('email','password'));
    }
}
