<?php

namespace App\Http\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;

class Show extends Component
{
    protected $layout = null;
    
    public $detail;

    public function mount($course_id){
        $this->detail = Course::find($course_id);
    }

    public function render()
    {
        return view('livewire.admin.course.show');
    }

    public function cancel(){
        $this->emitUp('cancel');
    }
}
