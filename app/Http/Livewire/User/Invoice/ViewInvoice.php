<?php

namespace App\Http\Livewire\User\Invoice;

use App\Models\Invoice;
use Livewire\Component;

class ViewInvoice extends Component
{
    protected $layout = null;

    public $detail, $userenrolled, $pkg_data, $user_data;

    public function mount($invoice_id)
    {
        $this->detail = Invoice::find($invoice_id);
        $this->userenrolled = auth()->user()->packages()->count();
        if($this->detail){
        $this->pkg_data = json_decode($this->detail->package_json,true);
        $this->user_data = json_decode($this->detail->user_json,true);
        }
    }

    public function render()
    {
        return view('livewire.user.invoice.view-invoice');
    }
}
