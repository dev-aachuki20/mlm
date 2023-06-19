<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRegisteredUserMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $name,$subject;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$name)
    {
        $this->subject = $subject;
        $this->name    = $name;

    }


     /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.send-registered', [
                'name' => $this->name,
            ])->subject($this->subject);
    }
}
