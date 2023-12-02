<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRegisteredUserMail extends Mailable 
{
    use Queueable, SerializesModels;

    
    public $name, $subject, $email, $password;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$name,$email,$password)
    {
        $this->subject = $subject;
        $this->name    = $name;
        $this->email   = $email;
        $this->password   = $password;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.send-registered', [
                'name'  => $this->name,
                'email' => $this->email,
                'password' => $this->password,
            ])->subject($this->subject);
    }
}
