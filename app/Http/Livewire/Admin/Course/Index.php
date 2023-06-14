<?php

namespace App\Http\Livewire\Admin\Course;

use Gate;
use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Str; 
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;

class Index extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false, $course_id=null;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $name, $description, $image, $originalImage, $video, $originalVideo, $status=1;
    

    protected $listeners = [
        'updatePaginationLength', 'updateStatus', 'confirmedToggleAction','deleteConfirm',
    ];


    public function mount(){
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
    
    public function render()
    {
        $statusSearch = null;
        $searchValue = $this->search;
        if(Str::contains('active', strtolower($searchValue))){
            $statusSearch = 1;
        }else if(Str::contains('inactive', strtolower($searchValue))){
            $statusSearch = 0;
        }

        $allCourse = Course::query()->where(function ($query) use($searchValue,$statusSearch) {
            $query->where('name', 'like', '%'.$searchValue.'%')
            ->orWhere('status', $statusSearch)
            ->orWhereRaw("date_format(created_at, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%']);
        })
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->paginationLength);
      

        return view('livewire.admin.course.index',compact('allCourse'));
    }

    public function create()
    {
        $this->resetPage('page');
        $this->initializePlugins();
        $this->formMode = true;
    }

    public function edit()
    {
        $this->resetPage('page');
        $this->initializePlugins();
        $this->formMode = true;
    }

    public function updateStatus($id){
        if($this->isConfirmed){
            $this->isConfirmed = false;
            $model = Course::find($id);
            $model->update(['status' => !$model->status]);
            $this->alert('success', trans('messages.change_status_success_message'));
        }
    }

    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }

    public function cancel(){
        $this->formMode = false;
        $this->updateMode = false;
        $this->viewMode = false;
    }

    public function store(){
        dd('working on');
    }

    public function update(){
        dd('working on');
    }
}
