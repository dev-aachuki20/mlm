<?php

namespace App\Http\Livewire\User\MyCourses;

use App\Models\Course;
use App\Models\VideoGroup;
use Livewire\Component;
use Livewire\WithPagination;


class Lectures extends Component
{
    use WithPagination;

    public $courseSlug = null, $course_id,$title, $description, $imageUrl= null, $videoUrl = null, $videoExtension;

    public $lectureCount = 0;

    public function mount($slug){
        $this->courseSlug = $slug;
        $course  = Course::where('slug',$this->courseSlug)->first();
        if($course){
            $this->course_id = $course->id;
            $this->title = $course->name ?? '';
            $this->description = $course->description ?? '';
            $this->imageUrl = $course->course_image_url;
            $this->videoUrl = $course->course_video_url;
            $this->videoExtension = $course->courseVideo->extension;
        }
    }

    public function render()
    {
        $lectureList = null;
        if($this->courseSlug){
            
            $course  = Course::where('slug',$this->courseSlug)->first();
            if($course){
                $lectureList = $course->videoGroup()->where('status',1)->paginate(10);
            }else{
                return abort(404);
            }

        }else{
            return abort(404);
        }

    
        return view('livewire.user.my-courses.lectures',compact('course','lectureList'));
    }

    public function activeVideo($vid,$action){
        
        if($action == 'course'){
            $course  = Course::find($vid);
            if($course){
                $this->title = $course->name ?? '';
                $this->description = $course->description ?? '';
                $this->imageUrl = $course->course_image_url;
                $this->videoUrl = $course->course_video_url;
                $this->videoExtension = $course->courseVideo->extension;
            }
            
        }else if($action == 'lecture'){
            $lecture = VideoGroup::find($vid);
            if($lecture){
                $this->title = $lecture->title ?? '';
                $this->description = $lecture->description ?? '';
                $this->imageUrl = $lecture->course_image_url;
                $this->videoUrl = $lecture->course_video_url;
                $this->videoExtension = $lecture->courseVideo->extension;
            }
        }

    }
}
