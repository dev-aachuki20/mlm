<?php

namespace App\Http\Livewire\Frontend\Pages\Package;

use Livewire\Component;
use App\Models\Package;

class Show extends Component
{
    public $layouts = null;

    public $package;

    public function mount($uuid){
        $this->package = Package::where('uuid',$uuid)->first();
    }

    public function render()
    {
        return view('livewire.frontend.pages.package.show');
    }
}
