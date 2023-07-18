<?php

namespace App\Http\Livewire\User\Invoice;

use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;

    public $search = '',  $viewMode = false;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $invoice_id = null;

    public $packageTitle;

    protected $listeners = [
        'updatePaginationLength'
    ];

    public function updatePaginationLength($length)
    {
        $this->paginationLength = $length;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = '';
    }

    public function sortBy($columnName)
    {
        $this->resetPage();

        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }


    public function show($id)
    {
        $this->resetPage();
        $this->invoice_id = $id;
        $this->viewMode = true;
    }

    public function mount()
    {
        $this->packageTitle =  auth()->user()->packages()->first();
    }

    public function render()
    {
        $allInvoices = Invoice::where('user_id', auth()->user()->id)
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->paginationLength);

        // $user = User::select('first_name', 'last_name')
        // ->where('id', auth()->user()->id)->first();
        // $userName = $user->first_name . ' ' . $user->last_name;

        return view('livewire.user.invoice.index', compact('allInvoices'));
    }
}
