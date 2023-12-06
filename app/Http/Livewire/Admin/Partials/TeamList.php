<?php

namespace App\Http\Livewire\Admin\Partials;

use App\Models\User;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;


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
        if($this->user_id){
            $this->level1Comm = Transaction::where('referrer_id', $this->user_id)->where('payment_type','credit')->where('type',1)->sum('amount');
            $this->level2Comm = Transaction::where('referrer_id', $this->user_id)->where('payment_type','credit')->where('type',2)->sum('amount');
            $this->level3Comm = Transaction::where('referrer_id', $this->user_id)->where('payment_type','credit')->where('type',3)->sum('amount');
        }

    }

    public function updatePaginationLength($length)
    {
        $this->paginationLength = $length;
    }

    public function updatedSearch()
    {

        $this->resetPage('page');
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

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->render();
    }

    public function render()
    {
        $this->search = str_replace(',', '', $this->search);
        $searchValue = $this->search;

        $levelOneUsers = User::where('referral_user_id', $this->user_id);
        $levelOneUserIds = $levelOneUsers->pluck('id');


        $levelTwoUsers = User::whereIn('referral_user_id', $levelOneUserIds);
        $levelTwoUserIds = $levelTwoUsers->pluck('id');

        $levelThreeUsers = User::whereIn('referral_user_id', $levelTwoUserIds);
        $levelThreeUserIds = $levelThreeUsers->pluck('id');

        $allIdofUsers = $levelOneUserIds->merge($levelTwoUserIds,$levelThreeUserIds);

        //  Records of level 1, 2, 3
        $levelOneRecords = $levelOneUsers->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->paginationLength);

        $levelTwoRecords = $levelTwoUsers->orderBy($this->sortColumnName,$this->sortDirection)->paginate($this->paginationLength);

        $levelThreeRecords = $levelThreeUsers->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->paginationLength);


         // serching
         $allTeams = null;
         $userId = $this->user_id;
         $allTeams = User::query()->where(function ($query) use($searchValue,$userId) {
            $query->where('name', 'like', '%'.$searchValue.'%')
                ->orWhere('is_active', 'like', '%'.$searchValue.'%')
                ->orWhere('phone', 'like', '%'.$searchValue.'%')
                ->orWhere('email', 'like', '%'.$searchValue.'%')
                ->orWhereRaw("date_format(date_of_join, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%'])

                ->orWhereHas('refferalTransaction', function ($q) use ($searchValue,$userId) {
                    $q->where('amount', 'like', "$searchValue%")
                    ->where('payment_type','credit')->where('referrer_id',$userId);
                });
            });

            if($this->activeTab == 'all'){
                // dd($allIdofUsers);
                $allTeams =   $allTeams->whereIn('id',$allIdofUsers);
            }else if($this->activeTab == 'level_1'){
                $allTeams =   $allTeams->whereIn('id',$levelOneUserIds);
            }else if($this->activeTab == 'level_2'){
                $allTeams =  $allTeams->whereIn('id',$levelTwoUserIds);
            }else if($this->activeTab == 'level_3'){
                $allTeams =  $allTeams->whereIn('id',$levelThreeUserIds);
            }

            $allTeams = $allTeams->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->paginationLength);


        return view('livewire.admin.partials.team-list', compact('allTeams'));
    }


}
