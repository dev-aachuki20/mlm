<?php

namespace App\Http\Livewire\User\MyCourses;

use Livewire\Component;

class Index extends Component
{
    protected $layout = null;

    public function render()
    {
        return view('livewire.user.my-courses.index');
    }
}
