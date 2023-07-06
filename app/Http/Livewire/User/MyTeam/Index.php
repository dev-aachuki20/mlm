<?php

namespace App\Http\Livewire\User\MyTeam;

use DB;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    protected $layout = null;

    public $search = '';

    public $sortColumnName = 'date_of_join', $sortDirection = 'desc', $paginationLength = 10;

    public $activeTab = 'all', $userId = null;
    
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
        $this->userId = auth()->user()->id;
    }

    public function render()
    {
        DB::statement("SET SQL_MODE=''");
        $this->search = str_replace(',', '', $this->search);
        $searchValue = $this->search;

        $referralUserIds = auth()->user()->referrals()->pluck('id'); // Referrals (level 1) user IDs
        $levelTwoUserIds = User::whereIn('referral_user_id', $referralUserIds)->pluck('id'); // Referrals of referrals (level 2) user IDs
        $levelThreeUserIds = User::whereIn('referral_user_id', $levelTwoUserIds)->pluck('id'); // Referrals of referrals of referrals (level 3) user IDs

        // Get all referral users up to level 3 with pagination
        $allTeams = User::whereIn('id', $referralUserIds)
            ->orWhereIn('id', $levelTwoUserIds)
            ->orWhereIn('id', $levelThreeUserIds)
            ->paginate(10); // Adjust the pagination as per your requirements


        return view('livewire.user.my-team.index',compact('allTeams'));
    }

   
}
