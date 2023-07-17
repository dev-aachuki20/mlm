<?php

namespace App\Http\Livewire\User\MyCourses;

use App\Models\Course;
use App\Models\Package;
use App\Models\Uploads;
use App\Models\VideoGroup;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;
    protected $layout = null;
    public $search = '', $viewMode = false;

    public $packageDetail, $userenrolled, $course, $lectureCount;

    public function mount()
    {
        $this->packageDetail =  auth()->user()->packages()->first();
        $this->userenrolled = auth()->user()->packages()->count();
        $this->course = $this->packageDetail->courses()->first();
        $this->lectureCount = $this->course->videoGroup()->count();
    }

    public function render()
    {
        $lectureList = VideoGroup::where('status', 1)->where('course_id', $this->course->id)->paginate(10);
        return view('livewire.user.my-courses.index', compact('lectureList'));
    }
}
