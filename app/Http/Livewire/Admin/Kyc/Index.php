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
    
    public $search = '',  $viewMode = false ,$originalImage;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $selectStatus;

    public $kyc_id = null, $status = 1, $status_comment;

    protected $listeners = [
        'updatePaginationLength','cancel','updateStatus','refreshComponent',
    ];

    
    public function mount(){
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->selectStatus = config('constants.kyc_status');

    }

    public function refreshComponent(){
        $this->resetPage();
        $this->reset(['kyc_id','status','status_comment']);
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

    public function updateStatus($kycId,$statusVal,$comment=null){
        $model = Kyc::find($kycId);
        if($model){
            $model->update(['status' => $statusVal,'comment'=>$comment]);
            $this->alert('success', trans('messages.change_status_success_message'));
        }
    }
/*
    public function toggle($id,$statusVal){
        $this->initializePlugins();
        $this->confirm('Are you sure?', [
            'text'=>'You want to change the status.',
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes Confirm!',
            'cancelButtonText' => 'No Cancel!',
            'onConfirmed' => 'confirmedToggleAction',
            // 'onDismissed' => 'cancelledToggleAction',
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['kycId' => $id,'statusVal'=>$statusVal],
        ]);
    }


    public function confirmedToggleAction($event)
    {
        $kycId = $event['data']['inputAttributes']['kycId'];
        $statusVal = $event['data']['inputAttributes']['statusVal'];
        if(in_array($statusVal,array(1,2))){
            $model = Kyc::find($kycId);
            $model->update(['status' => $statusVal,'comment'=>null]);
            $this->alert('success', trans('messages.change_status_success_message'));
        }else{
            $this->kyc_id = $kycId;
            $this->status = $statusVal;
            $this->dispatchBrowserEvent('openKycStatusModal');
        }
    }*/

    public function submitStatusComment(){
        $this->validate([
            'status_comment' => 'required|string',
        ],[
            'status_comment.required'=>'Comment is required.',
        ]);
        $model = Kyc::find($this->kyc_id);
        $model->update(['status' => $this->status,'comment'=>$this->status_comment]);
        $this->closedKycModal();
        $this->alert('success', trans('messages.change_status_success_message'));
    }

    public function show($id){
        $this->resetPage();
        $this->kyc_id = $id;
        $this->viewMode = true;
    }

    public function cancel(){
        $this->viewMode = false;
    }


    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }
}
