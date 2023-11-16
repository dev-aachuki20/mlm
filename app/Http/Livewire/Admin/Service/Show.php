<?php

namespace App\Http\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;

class Show extends Component
{
    protected $layout=null;
    public $details;

    public function mount($service_id){
        $this->details = Service::find($service_id);
    }

    public function render()
    {
        return view('livewire.admin.service.show');
    }
}
