<?php

namespace App\Http\Livewire\Frontend\Pages;

use Mail;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Mail\ContactUsMail;


class Contactus extends Component
{
    use LivewireAlert;

    // public $layouts = null;

    public $pageDetail;

    public $name,$email,$message;

    public function mount(){
        $this->pageDetail = getPageContent('contact-us');
    }

    public function render()
    {
        return view('livewire.frontend.pages.contactus');
    }

    public function sendContactMail(){
        $validatedData = $this->validate([
            'name'     => ['required'],
            'email'    => ['required','email'],
            'message'  => ['required'],
        ]);

        try {
            //Send mail for plan purchased
            $subject = $this->name;
            $ownerEmail = getSetting('company_email');
            Mail::to($ownerEmail)->queue(new ContactUsMail($subject,$this->name,$this->email,$this->message));

            $this->reset();
            $this->alert('success', 'Your message sent successfully!');

        }catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));
        }
        
    }
}
