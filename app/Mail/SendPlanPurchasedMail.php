<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPlanPurchasedMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $name,$planName,$subject;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$name,$planName)
    {
        $this->subject = $subject;
        $this->name    = ucwords($name);
        $this->planName = $planName;

    }


     /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.send-plan-purchased', [
                'name' => $this->name,
                'planName' => $this->planName,
            ])->subject($this->subject);
    }
}
