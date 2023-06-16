<?php

namespace App\Http\Livewire\Admin\Partials;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class TeamList extends Component
{
    use WithPagination, LivewireAlert;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false;
    public $sortColumnName = 'date_of_join', $sortDirection = 'desc', $paginationLength = 10;

    public $user_id,$userDetail;

    protected $listeners = [
        'updatePaginationLength'
    ];

    public function mount($user_id=''){
        $this->user_id = $user_id;
        $this->userDetail = User::find($user_id);
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
        $allTeam = $this->userDetail->team;
         // $statusSearch = null;
        // $searchValue = $this->search;
        // if(Str::contains('active', strtolower($searchValue))){
        //     $statusSearch = 1;
        // }else if(Str::contains('inactive', strtolower($searchValue))){
        //     $statusSearch = 0;
        // }

        
       
        return view('livewire.admin.partials.team-list',compact('allTeam'));
    }
}
