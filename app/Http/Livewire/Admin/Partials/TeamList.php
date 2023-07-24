<?php

namespace App\Http\Livewire\Admin\Partials;

use App\Models\User;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class TeamList extends Component
{
    use WithPagination, LivewireAlert;
    public $activeTab = 'all';
    public $search = '', $formMode = false, $updateMode = false, $viewMode = false;
    public $sortColumnName = 'date_of_join', $sortDirection = 'desc', $paginationLength = 10;
    public $user_id, $userDetail, $level1Comm = 0,$level2Comm = 0, $level3Comm =0;
    // public $commission;

    protected $listeners = [
        'updatePaginationLength'
    ];

    public function mount($user_id = '')
    {
        $this->user_id = $user_id;
        $this->userDetail = User::find($user_id);
        $id = $this->userDetail->referrals->pluck('referral_user_id');
        if($id)
        {
            
            $this->level1Comm = Transaction::whereIn('referrer_id', $id)->sum('amount');
        }
    }

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

    public function cancel()
    {
        $this->emitUp('cancel');
    }

    public function render()
    {
        $allTeam = $this->userDetail->team;
        // $statusSearch = null;
        // $searchValue = $this->search;
        // if(Str::contains('active', strtolower($searchValue))){
        //     $statusSearch = 1;
        // }else if(Str::contains('inactive', strtolower($searchValue))){
        //     $statusSearch = 0;
        // }


        $levelOneUserIds = User::where('referral_user_id', $this->user_id)->pluck('id');
        $levelTwoUserIds = User::whereIn('referral_user_id', $levelOneUserIds)->pluck('id');
        $levelThreeUserIds = User::whereIn('referral_user_id', $levelTwoUserIds)->pluck('id');

        // all users
        $allTeams = User::whereIn('id', $levelOneUserIds)
            ->orWhereIn('id', $levelTwoUserIds)
            ->orWhereIn('id', $levelThreeUserIds)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationLength);

        //  Records of level 1, 2, 3
        $levelOneRecords = User::whereIn('id', $levelOneUserIds)->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->paginationLength);

        $levelTwoRecords = User::whereIn('id', $levelTwoUserIds)->orderBy($this->sortColumnName,$this->sortDirection)->paginate($this->paginationLength);

        $levelThreeRecords = User::whereIn('id', $levelThreeUserIds)->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->paginationLength);
        $this->level2Comm =$levelTwoUserIds != '' ? Transaction::whereIn('referrer_id', $levelTwoUserIds)->sum('amount') : 0 ;
        $this->level3Comm =$levelThreeUserIds != '' ?Transaction::whereIn('referrer_id', $levelThreeUserIds)->sum('amount'):0;

        return view('livewire.admin.partials.team-list', compact('allTeam','levelOneRecords','levelTwoRecords','levelThreeRecords','allTeams'));
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }
}
