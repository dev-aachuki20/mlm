<?php

namespace App\Http\Livewire\Frontend\Partials;

use Livewire\Component;
use App\Http\Livewire\Frontend\BaseComponent;

class Footer extends BaseComponent
{
    public $layouts = null;
    
    public function render()
    {
        return view('livewire.frontend.partials.footer');
    }
}
