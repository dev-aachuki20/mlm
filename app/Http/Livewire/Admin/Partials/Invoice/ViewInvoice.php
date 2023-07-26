<?php

namespace App\Http\Livewire\Admin\Partials\Invoice;

use Livewire\Component;
use App\Models\Invoice;
use App\Models\User;

class ViewInvoice extends Component
{
    protected $layout = null;
    public $search = '', $formMode = false, $updateMode = false, $viewMode = false;
    public $detail, $userenrolled, $pkg_data, $user_data;
    public $user_id = null;

    public function mount($user_id)
    { 
        $this->detail = Invoice::where('user_id',$user_id)->first();
        $this->pkg_data = json_decode($this->detail->package_json,true);
        $this->user_data = json_decode($this->detail->user_json,true);
    }


    public function render()
    {
        return view('livewire.admin.partials.invoice.view-invoice');
    }
}
