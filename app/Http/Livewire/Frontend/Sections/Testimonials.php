<?php

namespace App\Http\Livewire\Frontend\Sections;

use Livewire\Component;
use App\Models\Testimonial;

class Testimonials extends Component
{
    public $layouts = null;

    public $allTestimonial;

    public function mount(){
        $this->allTestimonial = Testimonial::where('status',1)->get(); 
    } 

    public function render()
    {
        return view('livewire.frontend.sections.testimonials');
    }
}
