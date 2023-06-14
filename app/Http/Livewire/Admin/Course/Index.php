<?php

namespace App\Http\Livewire\Admin\Course;

use Gate;
use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\BaseComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;

class Index extends BaseComponent
{
    use WithPagination, LivewireAlert, WithFileUploads;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false, $course_id=null;

    public $name, $description, $image, $originalImage, $video, $originalVideo, $status=1;

    protected $courses;
    
    public function mount(){
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function render()
    {
        $this->courses = Course::query()
        ->where('name', 'like', '%'.$this->search.'%')
        ->orderBy('id','desc')
        ->paginate(10);
      
        $allCourse = $this->courses;

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
