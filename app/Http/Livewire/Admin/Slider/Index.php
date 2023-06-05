<?php

namespace App\Http\Livewire\Admin\Slider;

use Livewire\Component;

class Index extends Component
{
    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false, $viewDetails = null;

    public $slider_id = null, $status = 1;

    protected $sliders = null;

    protected $listeners = [
        'confirmedToggleAction','deleteConfirm'
    ];

    public function render()
    {
        return view('livewire.admin.slider.index');
    }
}
