<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class BaseComponent extends Component
{
    public $switchTab = 'home';

    public $listeners = ['switchTab'];

    public function switchTab($tab){
        $this->switchTab = $tab;
    }

    public function render()
    {
        return view('livewire.frontend.base-component');
    }
}
