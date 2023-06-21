<?php

namespace App\Http\Livewire\Admin\Course;

use Gate;
use App\Models\Package;
use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Str; 
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;

class Index extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $course_id=null, $name, $allPackage, $package_id, $description, $image, $originalImage, $video, $originalVideo,$videoExtenstion, $status=1;
    

    protected $listeners = [
        'cancel','updatePaginationLength', 'updateStatus', 'confirmedToggleAction','deleteConfirm',
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
        $this->allPackage = Package::where('status',1)->get();
        $this->formMode = true;
    }

    public function store(){
        $validatedData = $this->validate([
            'name'        => 'required|'.Rule::unique('courses')->whereNull('deleted_at'),
            'package_id'  => 'required',
            'description' => 'required',
            'status'      => 'required',
            'image'       => 'required|image|max:'.config('constants.img_max_size'),
            'video'       => 'required|file|mimes:mp4,avi,mov,wmv,webm,flv|max:'.config('constants.video_max_size'),
        ],[
            'package_id.required' => 'The package field is required.'
        ]);

        $validatedData['status'] = $this->status;
        $validatedData['status'] = $this->status;

        $course = Course::create($validatedData);

        //Upload Image
        uploadImage($course, $this->image, 'course/image/',"course-image", 'original', 'save', null);

        //Upload video
        uploadImage($course, $this->video, 'course/video/',"course-video", 'original', 'save', null);

        $this->formMode = false;

        $this->reset(['name','description','status','image','video','allPackage','package_id']);

        $this->flash('success',trans('messages.add_success_message'));
      
        return redirect()->route('admin.course');
    }


    public function edit($id)
    {
        $this->resetPage('page');
        $this->initializePlugins();
        $this->formMode = true;
        $this->updateMode = true;

        $this->allPackage = Package::where('status',1)->get();

        $course = Course::findOrFail($id);
        $this->course_id      =  $course->id;
        $this->name           =  $course->name;
        $this->package_id     =  $course->package_id;
        $this->description    =  $course->description;
        $this->status         =  $course->status;
        $this->originalImage  =  $course->course_image_url;
        $this->originalVideo  =  $course->course_video_url;

        $this->videoExtenstion = $course->courseVideo->extension;

    }

    public function update(){
        $validatedArray['name']        = 'required|'.Rule::unique('courses')->ignore($this->course_id)->whereNull('deleted_at');
        
        $validatedArray['package_id']  = 'required';
        $validatedArray['description'] = 'required';
        $validatedArray['status']      = 'required';

        if($this->image){
            $validatedArray['image'] = 'required|image|max:'.config('constants.img_max_size');
        }

        if($this->video){
            $validatedArray['video'] = 'required|file|mimes:mp4,avi,mov,wmv,webm,flv|max:'.config('constants.video_max_size');
        }

        $validatedData = $this->validate(
            $validatedArray,
            [
                'package_id.required' => 'The package field is required.'
            ]
        );

        $validatedData['status'] = $this->status;

        $course = Course::find($this->course_id);
      
        // Check if the image has been changed
        $uploadImageId = null;
        if ($this->image) {
            $uploadImageId = $course->courseImage->id;
            uploadImage($course, $this->image, 'course/image/',"course-image", 'original', 'update', $uploadImageId);
        }

        // Check if the video has been changed
        $uploadVideoId = null;
        if ($this->video) {
            $uploadVideoId = $course->courseVideo->id;
            uploadImage($course, $this->video, 'course/video/',"course-video", 'original', 'update', $uploadVideoId);
        }

        $course->update($validatedData);
     
        $this->formMode = false;
        $this->updateMode = false;
  
        $this->flash('success',trans('messages.edit_success_message'));

        $this->reset(['name','description','status','image','video','allPackage','package_id']);

        return redirect()->route('admin.course');
    }

    public function show($id){
        $this->resetPage('page');
        $this->course_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
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


    public function delete($id)
    {
        $this->confirm('Are you sure you want to delete it?', [
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes, change it!',
            'cancelButtonText' => 'No, cancel!',
            'onConfirmed' => 'deleteConfirm',
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['deleteId' => $id],
        ]);
    }

    public function deleteConfirm($event){
        $deleteId = $event['data']['inputAttributes']['deleteId'];
        $model    = Course::find($deleteId);
        $uploadImageId = $model->courseImage->id;
        $uploadVideoId = $model->courseVideo->id;
        deleteFile($uploadImageId);
        deleteFile($uploadVideoId);
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function toggle($id){
        $this->confirm('Are you sure you want to change the status?', [
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes Confirm!',
            'cancelButtonText' => 'No Cancel!',
            'onConfirmed' => 'confirmedToggleAction',
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['courseId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $courseId = $event['data']['inputAttributes']['courseId'];
        $model = Course::find($courseId);
        $model->update(['status' => !$model->status]);
        $this->alert('success', trans('messages.change_status_success_message'));
    }

   
}
