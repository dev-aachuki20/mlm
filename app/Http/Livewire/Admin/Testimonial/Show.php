<?php

namespace App\Http\Livewire\Admin\Testimonial;

use App\Models\Testimonial;
use Livewire\Component;

class Show extends Component
{

    protected $layout = null;
    
    public $details;

    public function mount($testimonial_id){
        $this->details = Testimonial::find($testimonial_id);
    }

    public function render()
    {
        return view('livewire.admin.testimonial.show');
    }
}
