<?php

namespace App\Http\Livewire\Frontend\Sections;

use App\Models\Section;
use Livewire\Component;

class AboutMyfuture extends Component
{
    public $layouts = null;
    public $section;

    public function mount(){
        $this->section = Section::where('status',1)->where('key','what_is_bizshiksha')->first();
    }

    public function render()
    {
        return view('livewire.frontend.sections.about-myfuture');
    }
}


