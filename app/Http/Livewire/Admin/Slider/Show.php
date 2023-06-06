<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Component;

class Show extends Component
{
    protected $layout = null;
    
    public $details;

    public function mount($slider_id){
        $this->details = Slider::find($slider_id);
    }

    public function render()
    {
        return view('livewire.admin.slider.show');
    }
}
