<?php

namespace App\Http\Livewire\Admin\Partials;

use Livewire\Component;

class Leaderboard extends Component
{
    protected $layout = null;
    
    public function render()
    {
        return view('livewire.admin.partials.leaderboard');
    }
}
