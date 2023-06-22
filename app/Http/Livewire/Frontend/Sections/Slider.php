<?php

namespace App\Http\Livewire\Frontend\Sections;

use Livewire\Component;
use App\Models\Slider as BannerSlider;

class Slider extends Component
{
    public $layouts = null;
    
    public $allBannerSlider;

    public function mount(){
        $this->allBannerSlider = BannerSlider::where('type','banner')->where('status',1)->get();
    }

    public function render()
    {
        return view('livewire.frontend.sections.slider');
    }
}
