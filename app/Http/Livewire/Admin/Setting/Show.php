<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
use Livewire\Component;

class Show extends Component
{
    protected $layout = null;
    
    public $detail;

    public function mount($setting_id){
        $this->detail = Setting::find($setting_id);
    }

    public function render()
    {
        return view('livewire.admin.setting.show');
    }
}
