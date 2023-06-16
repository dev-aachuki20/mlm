<?php

namespace App\Http\Livewire\Admin\Partials;

use Gate;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;

class PaymentList extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false;
    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    protected $listeners = [
        'updatePaginationLength'
    ];

    public function mount(){
        abort_if(Gate::denies('transactions_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function updatePaginationLength($length){
        $this->paginationLength = $length;
    }

    public function updatedSearch()
    {
        $this->resetPage();
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

    public function cancel(){
        $this->emitUp('cancel');
    }

    public function render()
    {
        // $statusSearch = null;
        // $searchValue = $this->search;
        // if(Str::contains('active', strtolower($searchValue))){
        //     $statusSearch = 1;
        // }else if(Str::contains('inactive', strtolower($searchValue))){
        //     $statusSearch = 0;
        // }
        return view('livewire.admin.partials.payment-list');
    }
}
