<?php

namespace App\Http\Livewire\Admin\Package;

use DB;
use Gate;
use Carbon\Carbon;
use App\Models\Package;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;
use App\Rules\CommissionRule;


class Index extends Component
{
   
    use WithPagination, LivewireAlert,WithFileUploads;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public  $uuid, $title, $sub_title, $amount, $status = 1, $features, $description='', /*$duration,*/ $level, $image=null,$viewMode = false,$originalImage,$video, $originalVideo,$videoExtenstion;

    public $package_id =null, $level_one_commission, $level_two_commission, $level_three_commission;

    protected $listeners = [
        'updatePaginationLength', 'confirmedToggleAction','deleteConfirm'
    ];

    public function mount(){
        abort_if(Gate::denies('package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        if(Str::contains('active', strtolower($searchValue))){
            $statusSearch = 1;
        }else if(Str::contains('inactive', strtolower($searchValue))){
            $statusSearch = 0;
        }

        $allPackages = Package::query()->where(function ($query) use($searchValue,$statusSearch) {
            $query->where('title', 'like', '%'.$searchValue.'%')
            ->orWhere('amount', 'like', '%'.$searchValue.'%')
            ->orWhere('status', $statusSearch)
            ->orWhereRaw("date_format(created_at, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%']);
        })
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->paginationLength);

        return view('livewire.admin.package.index',compact('allPackages'));
    }

    public function create()
    {
        $this->resetPage('page');
        $this->resetInputFields();
        $this->formMode = true;
        $this->initializePlugins();
    }

    public function store()
    {
        $validatedData = $this->validate([
            'title'      => 'required|'.Rule::unique('package')->whereNull('deleted_at'),
            'sub_title'  => 'required',
            'amount'     => 'required',
            'level_one_commission'   => [new CommissionRule($this->amount)],
            'level_two_commission'   => [new CommissionRule($this->amount)],
            'level_three_commission' => [new CommissionRule($this->amount)],
            'features'      => 'required',
            'description'   => 'required',
            // 'duration'      => 'required',
            'level'         => 'required',
            'status'        => 'required',
            'image'         => 'required|image|max:'.config('constants.img_max_size'),
            'video'         => 'required|file|mimes:mp4,avi,mov,wmv,webm,flv|max:'.config('constants.video_max_size'),
        ],[
            'title.required' => 'The package name field is required.',
            'amount.required' => 'The package price field is required.',
        ]);
        
        // $validatedData['duration'] = Carbon::parse($this->duration)->format('HH:mm');
        $validatedData['status']   = $this->status;

        try{
            $this->uuid     = Str::uuid();

            $insertRecord = $this->except(['search','formMode','updateMode','package_id','image','originalImage','page','paginators']);

            $package = Package::create($insertRecord);
        
            //Image
            uploadImage($package, $this->image, 'package/image/',"package", 'original', 'save', null);

            //Upload video
            uploadImage($package, $this->video, 'package/video/',"package-video", 'original', 'save', null);

            $this->formMode = false;

            $this->resetInputFields();

            $this->flash('success',trans('messages.add_success_message'));
            
            return redirect()->route('admin.package');
        }catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));
        }

    }


    public function edit($id)
    {
        $this->resetPage('page');
        $package = Package::findOrFail($id);

        $this->package_id = $id;
        $this->title  = $package->title;
        $this->sub_title  = $package->sub_title;
        $this->amount = $package->amount;
        $this->level_one_commission = $package->level_one_commission;
        $this->level_two_commission = $package->level_two_commission;
        $this->level_three_commission = $package->level_three_commission;
        $this->features = $package->features;
        $this->description = $package->description;
        // $this->duration = $package->duration;
        $this->level    = $package->level;
        $this->status = $package->status;
        $this->originalImage = $package->image_url;
        $this->originalVideo = $package->video_url;
        $this->videoExtenstion = $package->packageVideo->extension;

        $this->formMode = true;
        $this->updateMode = true;
        $this->initializePlugins();
    }

    public function update(){
        $validatedArray = [
            'title'      => 'required|'.Rule::unique('package')->ignore($this->package_id)->whereNull('deleted_at'),
            'sub_title'  => 'required',
            'amount'     => 'required',
            'level_one_commission'   => '',
            'level_two_commission'   => '',
            'level_three_commission' => '',
            'features'    => 'required',
            'description' => 'required',
            // 'duration'    => 'required',
            'level'       => 'required',
            'status'      => 'required',
        ];

        if($this->image){
            $validatedArray['image'] = 'required|image|max:'.config('constants.img_max_size');
        }

        if($this->video){
            $validatedArray['video'] = 'required|file|mimes:mp4,avi,mov,wmv,webm,flv|max:'.config('constants.video_max_size');
        }
  
        $validatedData = $this->validate(
            $validatedArray,
            [
                'title.required'  => 'The package name field is required.',
                'amount.required' => 'The package price field is required.',
            ]
        );

        // $validatedData['duration'] = Carbon::parse($this->duration)->format('HH:mm');
        $validatedData['status'] = $this->status;

        $package = Package::find($this->package_id);

        // Check if the photo has been changed
        $uploadId = null;
        if ($this->image) {
            $uploadId = $package->packageImage->id;
            uploadImage($package, $this->image, 'package/image/',"package", 'original', 'update', $uploadId);
        }

        // Check if the video has been changed
        $uploadVideoId = null;
        if ($this->video) {
            $uploadVideoId = $package->packageVideo->id;
            uploadImage($package, $this->video, 'package/video/',"package-video", 'original', 'update', $uploadVideoId);
        }
        
        $updateRecord = $this->except(['search','formMode','updateMode','package_id','image','originalImage','page','paginators','uuid','duration']);

        $package->update($updateRecord);
  
        $this->formMode = false;
        $this->updateMode = false;
  
        $this->flash('success',trans('messages.edit_success_message'));
        $this->resetInputFields();
        return redirect()->route('admin.package');

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
        $model = Package::find($deleteId);
        $uploadImageId = $model->packageImage->id;
        $uploadVideoId = $model->packageVideo->id;
        deleteFile($uploadImageId);
        deleteFile($uploadVideoId);
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function show($id){
        $this->resetPage('page');
        $this->package_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
    }

    private function resetInputFields(){
        $this->uuid = '';
        $this->title = '';
        $this->sub_title = '';
        $this->amount = '';
        $this->level_one_commission = '';
        $this->level_two_commission = '';
        $this->level_three_commission = '';
        $this->features = '';
        $this->description = '';
        // $this->duration = '';
        $this->level = '';
        $this->status = 1;
        $this->image = null;
        $this->video = null;
    }

    public function cancel(){
        $this->formMode = false;
        $this->updateMode = false;
        $this->viewMode = false;

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
            'inputAttributes' => ['packageId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $packageId = $event['data']['inputAttributes']['packageId'];
        $model = Package::find($packageId);
        $model->update(['status' => !$model->status]);
        $this->alert('success', trans('messages.change_status_success_message'));
    }

    public function changeStatus($statusVal){
        $this->status = (!$statusVal) ? 1 : 0;
    }
    
    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }


}
