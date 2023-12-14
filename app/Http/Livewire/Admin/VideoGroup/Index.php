<?php

namespace App\Http\Livewire\Admin\VideoGroup;

use Gate;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\Package;
use App\Models\VideoGroup;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;


class Index extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    protected $layout = null;

    public $search = '', $formMode = false, $updateMode = false, $viewMode = false;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $course_id = null, $courseName, $group_video_id = null, $title, $description, $image, $originalImage, $video, $originalVideo, $videoExtenstion, $status = 1;

    public $removeImage = false, $removeVideo = false;

    public $videoDuration = null;

    protected $listeners = [
        'cancel', 'updatePaginationLength', 'updateStatus', 'confirmedToggleAction', 'deleteConfirm', 'updateVideoDuration'
    ];


    public function mount($course_id)
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->course_id = $course_id;
        $this->courseName = Course::find($this->course_id)->name;        
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

    public function updateVideoDuration($videoTime)
    {
        $this->videoDuration = Carbon::parse($videoTime)->format('H:i:s');
    }

    public function render()
    {
        $statusSearch = null;
        $searchValue = $this->search;
        if (Str::contains('active', strtolower($searchValue))) {
            $statusSearch = 1;
        } else if (Str::contains('inactive', strtolower($searchValue))) {
            $statusSearch = 0;
        }

        $allLectures = VideoGroup::query()->where('course_id', $this->course_id)->where(function ($query) use ($searchValue, $statusSearch) {
            $query->where('title', 'like', '%' . $searchValue . '%')
                ->orWhere('status', $statusSearch)
                ->orWhereRaw("date_format(created_at, '" . config('constants.search_datetime_format') . "') like ?", ['%' . $searchValue . '%']);
        })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationLength);

        return view('livewire.admin.video-group.index', compact('allLectures'));
    }
    
    public function updatedOriginalVideo($videoUrl)
    {
        $this->originalVideo = $videoUrl;
        $this->dispatchBrowserEvent('videoUploaded',['originalVideo'=>$this->originalVideo]);
    }

    public function create()
    {
        $this->resetPage('page');
        $this->initializePlugins();
        $this->formMode = true;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'title'       => 'required|'.Rule::unique('video_groups')->where('course_id',$this->course_id)->whereNull('deleted_at'),
            'description' => 'required|strip_tags',
            'status'      => 'required',
            'image'         => 'required',
            'video'         => 'required',
            // 'image'       => 'required|image|max:' . config('constants.img_max_size'),
            // 'video'       => 'required|file|mimes:mp4,avi,mov,wmv,webm,flv|max:' . config('constants.video_max_size'),
        ],[
            'description.strip_tags'=> 'The description field is required',
        ]);

        $validatedData['status'] = $this->status;
        $validatedData['course_id'] = $this->course_id;
        $validatedData['duration'] = $this->videoDuration ?? null;

        DB::beginTransaction();
        try{
            
            $videoGroup = VideoGroup::create($validatedData);
    
            // Upload Image
            //uploadImage($videoGroup, $this->image, 'course/image/', "course-image", 'original', 'save', null);
    
            // Upload video
            //uploadImage($videoGroup, $this->video, 'course/video/', "course-video", 'original', 'save', null);
            
            $dateFolder = date("Y-m-W");
            
            $tmpImagePath = 'upload/image/'.$dateFolder.'/'.$this->image;
            uploadFile($videoGroup, $tmpImagePath, 'course/image/', "course-image", "original","save",null);
    
            $tmpVideoPath = 'upload/video/'.$dateFolder.'/'.$this->video;
            uploadFile($videoGroup, $tmpVideoPath, 'course/video/', "course-video", "original","save",null);
    
    
            //Start to update package duration
            // $total_duration = VideoGroup::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(duration))) as total_duration')->where('status', 1)->where('course_id',$this->course_id)->value('total_duration');

            // Course::find($this->course_id)->packages()->update(['duration' =>  $total_duration]);
            //End to update package duration
    
            DB::commit();
            
            $this->formMode = false;
    
            $this->reset(['title', 'description', 'status', 'image','originalImage', 'video','originalVideo', 'videoDuration']);
    
            $this->flash('success', trans('messages.add_success_message'));
    
            return redirect()->route('admin.getAllVideos', $this->course_id);
        }catch (\Exception $e) {
            DB::rollBack();
                // dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));
                
        }
    }


    public function edit($id)
    {
        $this->resetPage('page');
        $this->initializePlugins();
        $this->formMode = true;
        $this->updateMode = true;

        $group_video = VideoGroup::findOrFail($id);
        $this->group_video_id  =  $group_video->id;
        $this->title           =  $group_video->title;
        $this->description    =  $group_video->description;
        $this->status         =  $group_video->status;
        $this->originalImage  =  $group_video->course_image_url;
        $this->originalVideo  =  $group_video->course_video_url;

        $this->videoExtenstion = $group_video->courseVideo ? $group_video->courseVideo->extension : '';

        $this->videoDuration = $group_video->duration;
    }

    public function update()
    {
        $validatedArray['title']        = 'required|'.Rule::unique('video_groups')->ignore($this->group_video_id)->where('course_id',$this->course_id)->whereNull('deleted_at');
        $validatedArray['description'] = 'required|strip_tags';
        $validatedArray['status']      = 'required';

        if ($this->image || $this->removeImage) {
            // $validatedArray['image'] = 'required|image|max:' . config('constants.img_max_size');
            
            $validatedArray['image'] = 'required';
        }

        if ($this->video || $this->removeVideo) {
            // $validatedArray['video'] = 'required|file|mimes:mp4,avi,mov,wmv,webm,flv|max:' . config('constants.video_max_size');
            $validatedArray['video'] = 'required';
        }

        $validatedData = $this->validate($validatedArray,[
            'description.strip_tags'=> 'The description field is required',
        ]);

        DB::beginTransaction();
        try{
            $validatedData['course_id'] = $this->course_id;
            $validatedData['status'] = $this->status;
            
            $videoGroup = VideoGroup::find($this->group_video_id);
    
            // Check if the image has been changed
            $uploadImageId = null;
            $dateFolder = date("Y-m-W");
            if ($this->image) {
                $uploadImageId = $videoGroup->courseImage->id;
                // uploadImage($videoGroup, $this->image, 'course/image/', "course-image", 'original', 'update', $uploadImageId);
                $tmpImagePath = 'upload/image/'.$dateFolder.'/'.$this->image;
                uploadFile($videoGroup, $tmpImagePath, 'course/image/', "course-image", "original","update",$uploadImageId);
            }
    
            // Check if the video has been changed
            $uploadVideoId = null;
            if ($this->video) {
                $uploadVideoId = $videoGroup->courseVideo->id;
                // uploadImage($videoGroup, $this->video, 'course/video/', "course-video", 'original', 'update', $uploadVideoId);
                $tmpVideoPath = 'upload/video/'.$dateFolder.'/'.$this->video;
                uploadFile($videoGroup, $tmpVideoPath, 'course/video/', "course-video", "original","update",$uploadVideoId);
                
                $validatedData['duration'] = $this->videoDuration;
            }
    
            $videoGroup->update($validatedData);
    
            //Start to update package duration
            // $total_duration = VideoGroup::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(duration))) as total_duration')->where('status', 1)->where('course_id',$this->course_id)->value('total_duration');

            // Course::find($this->course_id)->packages()->update(['duration' =>  $total_duration]);
            //End to update package duration
            
            DB::commit();
    
            $this->formMode = false;
            $this->updateMode = false;
    
            $this->flash('success', trans('messages.edit_success_message'));
    
            $this->reset(['title', 'description', 'status', 'image','originalImage', 'video', 'originalVideo', 'videoDuration']);
    
            return redirect()->route('admin.getAllVideos', $this->course_id);
            
        }catch (\Exception $e) {
            DB::rollBack();
                // dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));
                
        }
    }

    public function show($id)
    {
        $this->resetPage('page');
        $this->group_video_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
        $this->initializePlugins();
    }

    public function initializePlugins()
    {
        $this->dispatchBrowserEvent('loadPlugins');
    }

    public function cancel()
    {
        $this->reset(['formMode','viewMode','updateMode','title', 'description', 'status', 'image','originalImage', 'video','originalVideo', 'videoDuration','group_video_id']);
        $this->resetValidation();
    }


    public function delete($id)
    {
        $this->confirm('Are you sure?', [
            'text' => 'You want to delete it.',
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'No, cancel!',
            'onConfirmed' => 'deleteConfirm',
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['deleteId' => $id],
        ]);
    }

    public function deleteConfirm($event)
    {
        $deleteId = $event['data']['inputAttributes']['deleteId'];
        $model    = VideoGroup::find($deleteId);
        $uploadImageId = $model->courseImage->id;
        $uploadVideoId = $model->courseVideo->id;
        deleteFile($uploadImageId);
        deleteFile($uploadVideoId);
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function toggle($id)
    {
        $this->confirm('Are you sure you?', [
            'text' => 'You want to change the status.',
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
        $model = VideoGroup::find($courseId);
        
        $cacheKey = 'all_lectures_'.$model->course_id;
        if (Cache::has($cacheKey)) {
            Cache::forget($cacheKey);
        }
        
        $model->update(['status' => !$model->status]);
        $this->alert('success', trans('messages.change_status_success_message'));
    }
}
