<?php

namespace App\Http\Livewire\Frontend\Sections;

use Livewire\Component;
use App\Models\Package;

class AboutPackages extends Component
{
    public $layouts = null;

    public $packages;

    public function mount(){
        $this->packages = Package::where('status',1)->get();
    }

    public function render()
    {
        return view('livewire.frontend.sections.about-packages');
    }
}
