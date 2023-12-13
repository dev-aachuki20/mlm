<?php

namespace App\Http\Livewire\User\MyPlan;

use Livewire\Component;
use App\Models\Package;


class Index extends Component
{

    protected $layout = null;

    public $packageDetail, $userenrolled, $courseCount, $lectureCount;

    public $activePlanId;

    public function mount(){
        $this->packageDetail =  auth()->user()->packages()->first();
        $this->activePlanId = $this->packageDetail->id;
        $this->userenrolled = $this->packageDetail->users()->count();
        $this->courseCount = $this->packageDetail ? $this->packageDetail->courses()->count() : 0;
    }

    public function render()
    {
        $packages = Package::all();
        return view('livewire.user.my-plan.index',compact('packages'));
    }
}
