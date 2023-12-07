<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRefferalLevelOneCommissionMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject,$referalName,$username,$useremail,$userphone,$planName,$commissionAmount;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$referalName,$username,$useremail,$userphone,$planName,$commissionAmount)
    {
        $this->subject = $subject;
        $this->referalName    = $referalName;
        $this->username = $username;
        $this->useremail = $useremail;
        $this->userphone    = $userphone;
        $this->planName = $planName;
        $this->commissionAmount = $commissionAmount;
    }
     /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.send-refferal-level-one-commisison', [
                'referalName' => $this->referalName,
                'username' => $this->username,
                'useremail' => $this->useremail,
                'userphone' => $this->userphone,
                'planName' => $this->planName,
                'commissionAmount' => $this->commissionAmount,
            ])->subject($this->subject);
    }
}
