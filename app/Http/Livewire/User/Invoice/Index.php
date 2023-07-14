<?php

namespace App\Http\Livewire\User\Invoice;

use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;

    public $search = '',  $viewMode = false;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $invoice_id =null;

    protected $listeners = [
        'updatePaginationLength'
    ];

    public function updatePaginationLength($length){
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


    public function show($id){
        $this->resetPage();
        $this->invoice_id = $id;
        $this->viewMode = true;
    }

    public function render()
    {
        return view('livewire.user.invoice.index');
    }
}
