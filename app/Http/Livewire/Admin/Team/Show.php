<?php

namespace App\Http\Livewire\Admin\Team;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    protected $layout = null;

    public $details;

    public function mount($team_id){
        $this->details = User::find($team_id);
    }

    public function render()
    {
        return view('livewire.admin.team.show');
    }
}
