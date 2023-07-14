<?php

namespace App\Http\Livewire\User\Webinar;
use App\Models\Webinar;
use Livewire\WithPagination;

use Livewire\Component;

class Index extends Component
{
    use WithPagination;
    protected $layout = null;

    public function render()
    {
        $webinarRecords = Webinar::paginate(10);
        return view('livewire.user.webinar.index',compact('webinarRecords'));
    }
}
