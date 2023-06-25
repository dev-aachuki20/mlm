<?php

namespace App\Http\Livewire\Frontend\Pages\Package;

use Livewire\Component;
use App\Models\Package;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{
    use LivewireAlert;

    public $layouts = null;

    public $package;

    protected $listeners = [ 'copyLinkSuccessAlert' ];

    public function mount($uuid){
        $this->package = Package::where('uuid',$uuid)->first();
    }

    public function render()
    {
        return view('livewire.frontend.pages.package.show');
    }

    public function copyLinkSuccessAlert(){
        $this->alert('success','Link copied successfully!');
    }
}
