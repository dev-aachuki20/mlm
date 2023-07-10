<?php

namespace App\Http\Livewire\Admin\Kyc;

use App\Models\Kyc;
use Livewire\Component;

class Show extends Component
{
    protected $layout = null;
    
    public $details;

    public function mount($kyc_id){
        $this->details = Kyc::find($kyc_id);
    }

    public function cancel(){
        $this->emitUp('cancel');
    }

    public function render()
    {
        return view('livewire.admin.kyc.show');
    }
}
