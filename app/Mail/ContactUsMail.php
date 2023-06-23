<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject, $name, $email, $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $name, $email, $message)
    {
       $this->subject = $subject;
       $this->name    = ucwords($name);
       $this->email   = $email;
       $this->message = $message;
    }

    

   /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact-us', [
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message,
            ])->subject($this->subject);
    }
}
