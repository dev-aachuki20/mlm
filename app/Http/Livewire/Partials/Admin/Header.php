<?php

namespace App\Http\Livewire\Partials\Admin;

use Livewire\Component;
use App\Http\Livewire\BaseComponent;

class Header extends BaseComponent
{
    protected $layout = null;

    public function render()
    {
        return view('livewire.partials.admin.header');
    }
}
