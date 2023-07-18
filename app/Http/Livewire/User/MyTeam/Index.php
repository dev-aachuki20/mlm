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

        $levelOneUserIds = User::where('referral_user_id', auth()->user()->id)->pluck('id'); // Referrals (level 1) user IDs
        $levelTwoUserIds = User::whereIn('referral_user_id', $levelOneUserIds)->pluck('id'); // Referrals (level 2) user IDs
        $levelThreeUserIds = User::whereIn('referral_user_id', $levelTwoUserIds)->pluck('id'); // Referrals (level 3) user IDs

        // all users
        $allTeams = User::whereIn('id', $levelOneUserIds)
            ->orWhereIn('id', $levelTwoUserIds)
            ->orWhereIn('id', $levelThreeUserIds)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationLength);

        //Records of level 1, 2, 3
        $levelOneRecords = User::whereIn('id', $levelOneUserIds)->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->paginationLength);
        $levelTwoRecords = User::whereIn('id', $levelTwoUserIds)->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->paginationLength);
        $levelThreeRecords = User::whereIn('id', $levelThreeUserIds)->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->paginationLength);

        return view('livewire.user.my-team.index', compact('allTeams', 'levelOneRecords', 'levelTwoRecords', 'levelThreeRecords'));
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
