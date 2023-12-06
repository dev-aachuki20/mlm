<?php

namespace App\Http\Livewire\User\MyTeam;

use DB;
use Carbon\Carbon;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;
    public $search = '';

    public $sortColumnName = 'date_of_join', $sortDirection = 'desc', $paginationLength = 10;

    public $activeTab = 'all', $userId = null;


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

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function mount()
    {
        $this->userId = auth()->user()->id;
    }

    public function render()
    {
        DB::statement("SET SQL_MODE=''");
        $this->search = str_replace(',', '', $this->search);
        $searchValue = $this->search;

        $levelOneUsers = User::where('referral_user_id', auth()->user()->id);
        $levelOneUserIds = $levelOneUsers->pluck('id');

        $levelTwoUsers = User::whereIn('referral_user_id', $levelOneUserIds);
        $levelTwoUserIds = $levelTwoUsers->pluck('id');

        $levelThreeUsers = User::whereIn('referral_user_id', $levelTwoUserIds);
        $levelThreeUserIds = $levelThreeUsers->pluck('id');

        $allIdofUsers = $levelOneUserIds->merge($levelTwoUserIds,$levelThreeUserIds);

        // serching
        $allTeams = null;
        $userId = auth()->user()->id;
        $allTeams = User::query()->where(function ($query) use($searchValue,$userId) {
        $query->where('my_referral_code', 'like', '%'.$searchValue.'%')
            ->orWhere('name', 'like', '%'.$searchValue.'%')
            ->orWhere('referral_code', 'like', '%'.$searchValue.'%')
            ->orWhere('phone', 'like', '%'.$searchValue.'%')
            ->orWhere('is_active', 'like', '%'.$searchValue.'%')
            ->orWhereRaw("date_format(date_of_join, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%'])
            ->orWhereHas('refferalTransaction', function ($q) use ($searchValue,$userId) {
                $q->where('amount', 'like', "$searchValue%")
                ->where('payment_type','credit')->where('referrer_id',$userId);
            });
        });

        if($this->activeTab == 'all'){
            $allTeams =   $allTeams->whereIn('id',$allIdofUsers);
        }else if($this->activeTab == 'level_1'){
            $allTeams =   $allTeams->whereIn('id',$levelOneUserIds);
        }else if($this->activeTab == 'level_2'){
            $allTeams =  $allTeams->whereIn('id',$levelTwoUserIds);
        }else if($this->activeTab == 'level_3'){
            $allTeams =  $allTeams->whereIn('id',$levelThreeUserIds);
        }

        $allTeams = $allTeams->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->paginationLength);
        return view('livewire.user.my-team.index', compact('allTeams'));

    }

    public function toggle($id)
    {
        $this->confirm('Are you sure?', [
            'text' => 'You want to change the status.',
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes Confirm!',
            'cancelButtonText' => 'No Cancel!',
            'onConfirmed' => 'confirmedToggleAction',
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['teamId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $userId = $event['data']['inputAttributes']['teamId'];
        $model = User::find($userId);
        $model->update(['is_active' => !$model->is_active]);
        $this->alert('success', trans('messages.change_status_success_message'));
    }
}
