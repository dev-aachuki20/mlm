<?php

namespace App\Http\Livewire\Frontend\Sections;

use Livewire\Component;
use App\Models\Faq as Faqs;

class Faq extends Component
{
    public $layouts = null;

    public $allFaqs;

    public function mount(){
        $this->allFaqs = Faqs::where('status',1)->get();
    }

    public function render()
    {
        return view('livewire.frontend.sections.faq');
    }
}
