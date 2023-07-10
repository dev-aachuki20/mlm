<?php

namespace App\Http\Livewire\Admin\Kyc;

use Gate;
use App\Models\Kyc;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;

use Livewire\Component;

class Index extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    protected $layout = null;
    
    public $search = '', $formMode = false , $updateMode = false, $viewMode = false ,$originalImage;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $kyc_id = null, $status = 1;

    protected $listeners = [
        'updatePaginationLength','toggle','confirmedToggleAction','cancel'
    ];

    
    public function mount(){
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    
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

    public function render()
    {
        $this->search = str_replace(',', '', $this->search);
        $statusSearch = null;
        $searchValue = $this->search;
        if(Str::contains('pending', strtolower($searchValue))){
            $statusSearch = 1;
        }else if(Str::contains('approve', strtolower($searchValue))){
            $statusSearch = 2;
        }else if(Str::contains('reject', strtolower($searchValue))){
            $statusSearch = 3;
        }

        $allKycUsers = Kyc::query()->where(function ($query) use($searchValue,$statusSearch) {
            $query->whereRelation('user', 'name','like', '%'.$searchValue.'%')
            ->orWhere('status', $statusSearch)
            ->orWhereRaw("date_format(created_at, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%']);
        })->whereHas('user.roles',function($query){
            $query->whereIn('id',[3]);
        })
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->paginationLength);

        return view('livewire.admin.kyc.index',compact('allKycUsers'));
    }

    public function toggle($id,$statusVal){
        $this->confirm('Are you sure you want to change the status?', [
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes Confirm!',
            'cancelButtonText' => 'No Cancel!',
            'onConfirmed' => 'confirmedToggleAction',
            'onCancelled' => function () {
                // console.log('hello');
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['kycId' => $id,'statusVal'=>$statusVal],
        ]);
    }


    public function confirmedToggleAction($event)
    {
        $kycId = $event['data']['inputAttributes']['kycId'];
        $statusVal = $event['data']['inputAttributes']['statusVal'];

        $model = Kyc::find($kycId);
        $model->update(['status' => $statusVal]);
        $this->alert('success', trans('messages.change_status_success_message'));
    }

    public function show($id){
        $this->resetPage();
        $this->kyc_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
    }

    public function cancel(){
        $this->formMode = false;
        $this->updateMode = false;
        $this->viewMode = false;
    }



    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }
}
