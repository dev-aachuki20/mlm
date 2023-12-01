<?php

namespace App\Http\Livewire\Admin\Partials;

use DB;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;


class Leaderboard extends Component
{
    use WithPagination;

    protected $layout = null;

    public $search = '';

    public $sortColumnName = 'total_amount', $sortDirection = 'desc', $paginationLength = 10;

    public $activeTab = 'all';
    
    protected $listeners = [
        'updatePaginationLength',
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

    public function switchTab($tab){
        $this->activeTab = $tab;
    }

    public function mount(){
        
    }

    public function render()
    {
        DB::statement("SET SQL_MODE=''");

        $this->search = str_replace(',', '', $this->search);
        $searchValue = $this->search;

        // All Time
        $allTimeTopRecords = null;
        if($this->activeTab == 'all'){

            $allTimeTopRecords = Transaction::query()->selectRaw('*, SUM(amount) as total_amount')
            ->where(function ($query) use($searchValue) {
                $query->whereRelation('user','name','like',  $searchValue . '%')
                ->orWhereRelation('payment.package','title','like',  $searchValue . '%')
                ->orWhereRelation('payment.package','amount','like',  $searchValue . '%');
            })
             ->where('payment_type','credit')
             ->groupBy('referrer_id')
            //  ->havingRaw('SUM(amount) LIKE ?', ['%' . $searchValue . '%'])
             ->orderBy($this->sortColumnName, $this->sortDirection)
             ->paginate($this->paginationLength);

        }

        $weeklyTopRecords = null;
        if($this->activeTab == 'weekly'){

            $weeklyTopRecords = Transaction::selectRaw('*, SUM(amount) as total_amount')
            ->where(function ($query) use($searchValue) {
                $query->whereRelation('user','name','like',  $searchValue . '%')
                ->orWhereRelation('payment.package','title','like',  $searchValue . '%')
                ->orWhereRelation('payment.package','amount','like',  $searchValue . '%');
            })
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('payment_type','credit')
            ->groupBy('referrer_id')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationLength);

        }


        $monthlyTopRecords = null;
        if($this->activeTab == 'monthly'){

            $currentMonth = Carbon::now()->format('Y-m');
            $monthlyTopRecords = Transaction::selectRaw('*, SUM(amount) as total_amount')
            ->where(function ($query) use($searchValue) {
                $query->whereRelation('user','name','like',  $searchValue . '%')
                ->orWhereRelation('payment.package','title','like',  $searchValue . '%')
                ->orWhereRelation('payment.package','amount','like',  $searchValue . '%');
            })
            ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$currentMonth])
            ->where('payment_type','credit')
            ->groupBy('referrer_id')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationLength);

        }


        $yearlyTopRecords = null;
        if($this->activeTab == 'yearly'){
            $yearStart = date('Y-04-01'); 
            $yearEnd = date('Y-03-31', strtotime('+1 year'));

            $yearlyTopRecords = Transaction::selectRaw('*, SUM(amount) as total_amount')
            ->where(function ($query) use($searchValue) {
                $query->whereRelation('user','name','like',  $searchValue . '%')
                ->orWhereRelation('payment.package','title','like',  $searchValue . '%')
                ->orWhereRelation('payment.package','amount','like',  $searchValue . '%');
            })
            ->whereBetween('created_at', [$yearStart, $yearEnd])
            ->where('payment_type','credit')
            ->groupBy('referrer_id')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationLength);

        }

        return view('livewire.admin.partials.leaderboard',compact('allTimeTopRecords','weeklyTopRecords','monthlyTopRecords','yearlyTopRecords'));
    }
}
