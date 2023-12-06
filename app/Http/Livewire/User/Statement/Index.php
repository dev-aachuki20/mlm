<?php

namespace App\Http\Livewire\User\Statement;

use App\Models\Transaction;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;


class Index extends Component
{
    use WithPagination, LivewireAlert;
    protected $layout = null;
    public $search = '';
    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;
    public $userId = null;

    protected $listeners = [
        'updatePaginationLength',
        'confirmedToggleAction',
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
    public function mount()
    {
        $this->userId = auth()->user()->id;
    }
    public function render()
    {
        $levelSearch = null;
        $gatewaySearch = null;
        $searchValue = $this->search;
        if (Str::contains('level 1', strtolower($searchValue))) {
            $levelSearch = 1;
        } else if (Str::contains('level 2', strtolower($searchValue))) {
            $levelSearch = 2;
        } else if (Str::contains('level 3', strtolower($searchValue))) {
            $levelSearch = 3;
        }

        if (Str::contains('razorpay', strtolower($searchValue))) {
            $gatewaySearch = 1;
        }
        if (Str::contains('cod', strtolower($searchValue))) {
            $gatewaySearch = 2;
        }

        $allTransaction = null;
        $allTransaction = Transaction::query()->where('referrer_id', $this->userId)->where(function ($query) use ($searchValue, $levelSearch, $gatewaySearch) {
            $query->where('payment_type', 'like', '%' . $searchValue . '%')
                ->orWhere('amount', 'like', '%' . $searchValue . '%')
                ->orWhere('gateway', $gatewaySearch)
                ->orWhereRelation('user', 'name','like', '%' . $searchValue . '%')
                ->orWhere('type', $levelSearch)
                ->orWhereRaw("date_format(created_at, '" . config('constants.search_datetime_format') . "') like ?", ['%' . $searchValue . '%']);
        });

        $allTransaction = $allTransaction->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->paginationLength);
        return view('livewire.user.statement.index', compact('allTransaction'));
    }
}
