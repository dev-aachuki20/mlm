<?php

namespace App\Http\Livewire\Admin\Faq;

use App\Models\Faq;
use Livewire\Component;

class Show extends Component
{
    protected $layout = null;
    
    public $details;

    public function mount($faq_id){
        $this->details = Faq::find($faq_id);
    }

    public function render()
    {
        return view('livewire.admin.faq.show');
    }
}
