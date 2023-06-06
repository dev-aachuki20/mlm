<?php

namespace App\Http\Livewire\Auth\Profile;

use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class Index extends Component
{
    use LivewireAlert;

    protected $layout = null;

    public $editMode =false;

    public $user;

    public function mount(){
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.auth.profile.index');
    }
}
