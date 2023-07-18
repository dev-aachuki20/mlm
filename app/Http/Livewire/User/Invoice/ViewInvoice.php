<?php

namespace App\Http\Livewire\User\Invoice;

use Livewire\Component;

class ViewInvoice extends Component
{
    protected $layout = null;

    
    public function render()
    {
        return view('livewire.user.invoice.view-invoice');
    }
}
