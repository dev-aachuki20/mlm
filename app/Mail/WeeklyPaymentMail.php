<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyPaymentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject, $userName, $weeklyEarning, $totalEarning;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$userName, $weeklyEarning, $totalEarning)
    {
        $this->subject = $subject;
        $this->userName        = $userName;
        $this->weeklyEarning   = $weeklyEarning;
        $this->totalEarning    = $totalEarning;
    }
     /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.weekly-payment', [
                'userName' => $this->userName,
                'weeklyEarning' => $this->weeklyEarning,
                'totalEarning' => $this->totalEarning,
        ])->subject($this->subject);
    }
}
