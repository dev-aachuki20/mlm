<?php

namespace App\Http\Livewire\User\MyCourses;

use App\Models\Package;
use App\Models\Course;
use App\Models\VideoGroup;
use Livewire\Component;
use Livewire\WithPagination;


class Lectures extends Component
{
    use WithPagination;

    public $courseSlug = null, $title, $description, $imageUrl= null, $videoUrl = null, $videoExtension;

    public $lectureCount = 0, $package_uuid, $per_page = 7;

    protected $listeners = [
        'loadMore'
    ];

    public function mount($package_uuid,$slug){
        $lastUserWatchedLectureId = auth()->user()->other_json ? json_decode(auth()->user()->other_json)->lastLectureWatched->lecture_id : null;

        $this->courseSlug = $slug;
        $this->package_uuid  = $package_uuid;
        $course  = Course::where('slug',$this->courseSlug)->first();
        $existsPackage = Package::where('uuid',$package_uuid)->exists();
        if($course && $existsPackage){
            if($lastUserWatchedLectureId){
                $lecture = $course->videoGroup()->where('id',$lastUserWatchedLectureId)->where('status',1)->first();
            }else{
                $lecture = $course->videoGroup()->where('status',1)->first();
            }
           
            if($lecture){
                $this->title = $lecture->title ?? '';
                $this->description = $lecture->description ?? '';
                $this->imageUrl = $lecture->course_image_url;
                $this->videoUrl = $lecture->course_video_url;
                $this->videoExtension = $lecture->courseVideo->extension;
    
                $jsonData['lastLectureWatched'] = [
                    'lecture_id'=>$lecture->id,
                    'title'=>$this->title,
                ];
    
                auth()->user()->update(['other_json'=>json_encode($jsonData)]);    
            }
            
        }else{
            return abort(404);
        }
    }

    public function render()
    {
        $lastUserWatchedLectureId = json_decode(auth()->user()->other_json)->lastLectureWatched->lecture_id;

        $lectureList = null;
        if($this->courseSlug){

            $course  = Course::where('slug',$this->courseSlug)->first();
            if($course){
                $lectureList = $course->videoGroup()->where('status',1)->paginate($this->per_page);
            }else{
                return abort(404);
            }

        }else{
            return abort(404);
        }


        return view('livewire.user.my-courses.lectures',compact('course','lectureList','lastUserWatchedLectureId'));
    }

    public function loadMore(){
        $this->per_page +=5;
    }

    public function changeVideo($vid){
        $lecture = VideoGroup::find($vid);
        if($lecture){
            $this->title = $lecture->title ?? '';
            $this->description = $lecture->description ?? '';
            $this->imageUrl = $lecture->course_image_url;
            $this->videoUrl = $lecture->course_video_url;
            $this->videoExtension = $lecture->courseVideo->extension;
            
            $jsonData['lastLectureWatched'] = [
                'lecture_id'=>$lecture->id,
                'title'=>$this->title,
            ];

            auth()->user()->update(['other_json'=>json_encode($jsonData)]);

            $this->dispatchBrowserEvent('loadNewVideo',$this->videoUrl);

        }
    }

    public function cancel(){
       return redirect()->route('user.my-courses',$this->package_uuid);
    }
}
