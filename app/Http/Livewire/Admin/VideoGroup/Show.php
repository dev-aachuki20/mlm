<?php

namespace App\Http\Livewire\Admin\VideoGroup;

use Livewire\Component;
use App\Models\VideoGroup;


class Show extends Component
{
    protected $layout = null;
    
    public $detail;

    public function mount($group_video_id){
        $this->detail = VideoGroup::find($group_video_id);
    }

    public function render()
    {
        return view('livewire.admin.video-group.show');
    }

    public function cancel(){
        $this->emitUp('cancel');
    }
}
