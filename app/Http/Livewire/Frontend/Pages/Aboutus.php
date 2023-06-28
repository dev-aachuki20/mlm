<?php

namespace App\Http\Livewire\Frontend\Pages;

use Livewire\Component;

class Aboutus extends Component
{

    // public $layouts = null;

    public $pageDetail;

    public function mount(){
        $this->pageDetail = getPageContent('about-us');
    }

    public function render()
    {
        return view('livewire.frontend.pages.aboutus');
    }
}
