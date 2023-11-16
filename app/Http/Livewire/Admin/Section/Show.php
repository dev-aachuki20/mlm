<?php

namespace App\Http\Livewire\Admin\Section;

use App\Models\Section;
use Livewire\Component;

class Show extends Component
{
    protected $layout=null;
    public $details;

    public function mount($section_id){
        $this->details = Section::find($section_id);
    }

    public function render()
    {
        return view('livewire.admin.section.show');
    }
}
