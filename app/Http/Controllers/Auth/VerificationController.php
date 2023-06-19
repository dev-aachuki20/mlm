<?php

namespace App\Http\Controllers\Auth;

use Mail; 
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\SendPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Hash;


class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request)
    {
        $userId = $request->route('id');
        $user = User::find($userId);

        if($user->hasVerifiedEmail()){
            return redirect($this->redirectPath())->with('alreadyVerified', true);
        }else{
            $user->markEmailAsVerified();

            event(new Verified($user));
    
            $name = $user->name;
            $email_id = $user->email;
            $password = generateRandomString(8);
            $user->password = Hash::make($password);
            $user->password_set_at = Carbon::now();
            $user->save();
    
            $subject = 'Your Password';
            Mail::to($email_id)->queue(new SendPasswordMail($name,$password, $subject));
    
            return redirect($this->redirectPath())->with('verified', true);
        }
       
    }

}
