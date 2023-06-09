<?php

namespace App\Http\Livewire\Auth\Admin;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class VerifyMail extends Component
{
    use LivewireAlert;
    
    protected $layout = null;

    public function render()
    {
        return view('livewire.auth.admin.verify-mail');
    }
}
