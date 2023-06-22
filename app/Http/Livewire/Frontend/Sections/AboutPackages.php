<?php

namespace App\Http\Livewire\Frontend\Sections;

use Livewire\Component;

class AboutPackages extends Component
{
    public $layouts = null;

    public function render()
    {
        return view('livewire.frontend.sections.about-packages');
    }
}
