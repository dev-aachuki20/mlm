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

    public $packageDetail, $userenrolled, $courseCount, $lectureCount;

    public function mount($uuid)
    {
        $this->packageDetail =  Package::where('uuid',$uuid)->first();
        if($this->packageDetail){
            $this->userenrolled = $this->packageDetail->users()->count();
            $this->courseCount = $this->packageDetail ? $this->packageDetail->courses()->count() : 0;
        }else{
            return abort(404);
        }
       
    }

    public function render()
    {
        $courses = $this->packageDetail->courses()->paginate(10);

        return view('livewire.user.my-courses.index', compact('courses'));
    }

    public function cancel(){
        return redirect()->route('user.my-plan');
    }
}
