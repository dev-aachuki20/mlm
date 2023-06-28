<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailContentFromSetting extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject;
    public $message;

    public function __construct($subject, $message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }


    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->subject;
        $content = $this->message;
        return $this->subject($subject)->view('email.mailContentSetting.dynamic-email', compact('content'));
    }
}