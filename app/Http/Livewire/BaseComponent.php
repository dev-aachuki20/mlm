<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BaseComponent extends Component
{
    public $profileImageUrlUpdated = false;
    public $isConfirmed = false,$isLoader = false;
    protected $listeners = ['successAlert' => 'showSuccess','errorAlert' => 'showError','confirmAlert'=>'confirmAlert','profileImageUpdated' => 'updateProfileImage'];


    public function showSuccess($message)
    {
        // Set Flash Email Verifed Message
        $notification = array(
            'type'      =>  trans('panel.alert-type.success'),
            'message'   =>  $message,
        );
        $this->dispatchBrowserEvent('alert',$notification); 
    }

    public function showError($message)
    {
        // Set Flash Email Verifed Message
        $notification = array(
            'type'      =>  trans('panel.alert-type.error'),
            'message'   => $message
        );
        $this->dispatchBrowserEvent('alert',$notification); 
    }

    public function showInfo($message)
    {
        // Set Flash Email Verifed Message
        $notification = array(
            'type'      =>  trans('panel.alert-type.info'),
            'message'   => $message
        );
        $this->dispatchBrowserEvent('alert',$notification); 
    }

    public function confirmAlert($text,$functionName,$paramenter){
        $this->isConfirmed = true;
        $notification = [
            'type'  => 'warning',
            'title' => 'Are you sure?',
            'text'  => $text,
            'functionName' => $functionName,
            'parameter' => $paramenter,
        ];
        $this->dispatchBrowserEvent('confirm-alert',$notification);
    }

    public function updateProfileImage($flag){
        // Update header component with the updated image URL
        $this->profileImageUrlUpdated = $flag;
    }

}

