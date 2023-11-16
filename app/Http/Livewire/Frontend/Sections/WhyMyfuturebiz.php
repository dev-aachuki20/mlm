<?php

namespace App\Http\Livewire\Frontend\Sections;

use Livewire\Component;
use App\Models\Section;

class WhyMyfuturebiz extends Component
{
    public $layouts = null;
    public $section;

    public function mount(){
        $this->section = Section::where('status',1)->where('key','why_bizshiksha')->first();
    }
    public function render()
    {
        return view('livewire.frontend.sections.why-myfuturebiz');
    }
}
