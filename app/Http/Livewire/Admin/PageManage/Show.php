<?php

namespace App\Http\Livewire\Admin\PageManage;

use App\Models\Page;
use Livewire\Component;

class Show extends Component
{
    protected $layout = null;
    
    public $details;

    public function mount($page_id){
        $this->details = Page::find($page_id);
    }

    public function render()
    {
        return view('livewire.admin.page-manage.show');
    }
}
