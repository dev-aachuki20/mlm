<?php

namespace App\Http\Livewire\Admin\Webinar;

use Gate;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Webinar;
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

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $webinar_id=null, $title, $presenter, $date = null, $time=null, $description, $image, $originalImage, $status=1;

    public $removeImage = false;

    protected $listeners = [
        'cancel','updatePaginationLength', 'updateStatus', 'confirmedToggleAction','deleteConfirm',
    ];

    public function mount(){
        abort_if(Gate::denies('webinar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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

    public function updatedDate(){
        $this->date = Carbon::parse($this->date)->format('d-m-Y');
    }

    public function updatedTime(){
        $this->time = Carbon::parse($this->time)->format('h:i A');
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

        $allWebinar = Webinar::query()->where(function ($query) use($searchValue,$statusSearch) {
            $query->where('title', 'like', '%'.$searchValue.'%')
            ->orWhere('presenter', 'like', '%'.$searchValue.'%')
            ->orWhere('status', $statusSearch)
            ->orWhereRaw("date_format(created_at, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%']);
        })
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->paginationLength);

        return view('livewire.admin.webinar.index',compact('allWebinar'));
    }

    public function create()
    {
        $this->resetPage();
        $this->initializePlugins();
        $this->formMode = true;
    }

    public function store(){
        $validatedData = $this->validate([
            'title'        => 'required',
            'presenter'    => 'required',
            'date'         => 'required',
            'time'         => 'required',
            'description' => 'required|strip_tags',
            'status'      => 'required',
            'image'       => 'required|image|max:'.config('constants.img_max_size'),
        ],[
            'description.strip_tags'=> 'The description field is required',
        ]);

        $validatedData['date']   = Carbon::parse($this->date)->format('Y-m-d');
        $validatedData['time']   = Carbon::parse($this->time)->format('H:i');

        $validatedData['status'] = $this->status;

        $webinar = Webinar::create($validatedData);

        //Upload Image
        uploadImage($webinar, $this->image, 'webinar/image/',"webinar", 'original', 'save', null);

        $this->formMode = false;

        $this->reset(['title','presenter','date','time','description','status','image']);

        $this->flash('success',trans('messages.add_success_message'));

        return redirect()->route('admin.webinar');
    }

    public function edit($id)
    {
        $this->resetPage();
        $this->initializePlugins();
        $this->formMode = true;
        $this->updateMode = true;


        $webinar = Webinar::findOrFail($id);
        $this->webinar_id      =  $webinar->id;
        $this->title           =  $webinar->title;
        $this->presenter       =  $webinar->presenter;
        $this->date            =  Carbon::parse($webinar->date)->format('d-m-Y');
        $this->time            =  Carbon::parse($webinar->time)->format('h:i A');
        $this->description    =  $webinar->description;
        $this->status         =  $webinar->status;
        $this->originalImage  =  $webinar->image_url;

    }


    public function update(){
        $validatedArray['title']        = 'required';
        $validatedArray['presenter']    = 'required';
        $validatedArray['date']         = 'required';
        $validatedArray['time']         = 'required';
        $validatedArray['description'] = 'required|strip_tags';
        $validatedArray['status']      = 'required';

        if($this->image || $this->removeImage){
            $validatedArray['image'] = 'required|image|max:'.config('constants.img_max_size');
        }

        $validatedData = $this->validate($validatedArray,[
            'description.strip_tags'=> 'The description field is required',
        ]);

        $validatedData['date']   = Carbon::parse($this->date)->format('Y-m-d');
        $validatedData['time']   = Carbon::parse($this->time)->format('H:i');
        $validatedData['status'] = $this->status;

        $webinar = Webinar::find($this->webinar_id);

        // Check if the image has been changed
        $uploadImageId = null;
        if ($this->image) {
            $uploadImageId = $webinar->webinarImage->id;
            uploadImage($webinar, $this->image, 'webinar/image/',"webinar", 'original', 'update', $uploadImageId);
        }


        $webinar->update($validatedData);

        $this->formMode = false;
        $this->updateMode = false;

        $this->flash('success',trans('messages.edit_success_message'));

        $this->reset(['title','presenter','date','time','description','status','image']);

        return redirect()->route('admin.webinar');
    }

    public function show($id){
        $this->resetPage();
        $this->webinar_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
    }

    public function updateStatus($id){
        if($this->isConfirmed){
            $this->isConfirmed = false;
            $model = Webinar::find($id);
            $model->update(['status' => !$model->status]);
            $this->alert('success', trans('messages.change_status_success_message'));
        }
    }

    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }

    public function cancel(){
        $this->reset();
        $this->resetValidation();
    }

    public function delete($id)
    {
        $this->confirm('Are you sure?', [
            'text'=>'You want to delete it.',
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

    public function deleteConfirm($event){
        $deleteId = $event['data']['inputAttributes']['deleteId'];
        $model    = Webinar::find($deleteId);
        $uploadImageId = $model->webinarImage->id;
        deleteFile($uploadImageId);
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function toggle($id){
        $this->confirm('Are you sure?', [
            'text'=>'You want to change the status.',
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes Confirm!',
            'cancelButtonText' => 'No Cancel!',
            'onConfirmed' => 'confirmedToggleAction',
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['webinarId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $webinarId = $event['data']['inputAttributes']['webinarId'];
        $model = Webinar::find($webinarId);
        $model->update(['status' => !$model->status]);
        $this->alert('success', trans('messages.change_status_success_message'));
    }

    public function changeStatus($statusVal){
        $this->status = (!$statusVal) ? 1 : 0;
    }

}
