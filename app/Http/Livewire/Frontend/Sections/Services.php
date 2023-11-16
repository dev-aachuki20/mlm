<?php

namespace App\Http\Livewire\Frontend\Sections;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    public $layouts = null;
    public $services;

    public function mount(){
        $this->services = Service::where('status',1)->get();
    }

    public function render()
    {
        return view('livewire.frontend.sections.services');
    }
}
