<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Package;
use Livewire\Component;

class Show extends Component
{
    protected $layout = null;
    
    public $details;

    public function mount($package_id){
        $this->details = Package::find($package_id);
    }

    public function render()
    {
        return view('livewire.admin.package.show');
    }
}
