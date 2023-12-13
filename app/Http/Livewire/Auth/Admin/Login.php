<?php

namespace App\Http\Livewire\Auth\Admin;

use Mail;
use Auth;
use Livewire\Component;
use App\Models\User;
use App\Rules\IsActive;
use App\Http\Livewire\BaseComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Login extends BaseComponent
{
    use LivewireAlert;

    // protected $layout = null;

    public $email, $password,$remember_me;

    public $verifyMailComponent = false;

    protected $listeners = [ 'verifiedAlert','alreadyVerifiedAlert' ];

    public function render()
    {
        $verified = session('verified') ?? 'false';
        $alreadyVerified = session('alreadyVerified') ?? 'false';

        return view('livewire.auth.admin.login',compact('verified','alreadyVerified'));
    }

    private function resetInputFields(){
        $this->email = '';
        $this->password = '';
    }

    public function submitLogin()
    {

        $validated = $this->validate([
            'email'    => ['required','email:dns',new IsActive],
            'password' => 'required',
        ]);

        $remember_me = !is_null($this->remember_me) ? true : false;
        $credentialsOnly = [
            'email'    => strtolower($this->email),
            'password' => $this->password,
        ];

        try {
            $checkVerified = User::where('email',strtolower($this->email))->first();

            if(!is_null($checkVerified)){

                if(is_null($checkVerified->email_verified_at)){
                    $this->addError('email', trans('panel.message.email_verify_first'));
                    return false;

                    // $checkVerified->sendEmailVerificationNotification();
                    // $this->verifyMailComponent = true;
                }

                if($checkVerified->is_user && $checkVerified->plan_purchased != 'approved'){
                    $this->alert('warning', trans('auth.payment_pending'));
                    return false;
                }

            }

            if (Auth::attempt($credentialsOnly, $remember_me)) {

                $this->resetInputFields();
                $this->resetErrorBag();
                $this->resetValidation();

                $this->flash('success', trans('panel.message.login_success'));

                if(Auth::user()->is_user){
                    
                    request()->session()->put('is_intro_video_show', true);
                   
                    return redirect()->route('user.dashboard');
                }else{
                    return redirect()->route('admin.dashboard');
                }

            }else{
                $this->addError('email', trans('auth.failed'));
            }

            $this->resetInputFields();

        } catch (ValidationException $e) {

            $this->addError('email', $e->getMessage());
        }

    }


    public function checkEmail()
    {
        $validated = $this->validate([
            'email'    => ['required','email',new IsActive],
        ], getCommonValidationRuleMsgs());

        // $user = User::where('email', $this->email)->whereNull('email_verified_at')->first();
        // if ($user) {
        //     // $this->showResetBtn = true;
        //     $this->addError('email', trans('panel.message.email_verify_first'));
        // }
    }

    public function backToLogin(){
        $this->verifyMailComponent = false;
    }

    public function verifiedAlert(){
        $this->alert('success', 'Verified successfully! your password has been sent to your mail id.');
    }

    public function alreadyVerifiedAlert(){
        $this->alert('success', 'Your mail has been already verified!');
    }

}
