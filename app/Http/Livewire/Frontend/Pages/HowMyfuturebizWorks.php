<?php

namespace App\Http\Livewire\Frontend\Pages;

use Livewire\Component;

class HowMyfuturebizWorks extends Component
{
    // public $layouts = null;

    public $pageDetail;

    public function mount(){
        $this->pageDetail = getPageContent('how-myfuturebiz-works');
    }

    public function render()
    {
        return view('livewire.frontend.pages.how-myfuturebiz-works');
    }
}
