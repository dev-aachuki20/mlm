<?php

namespace App\Http\Livewire\Admin\Service;

use App\Models\Service;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination,LivewireAlert,WithFileUploads;
    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $title, $sub_title, $status = 1, $description='', $level, $image=null,$viewMode = false,$originalImage;

    public $service_id = null, $removeImage = false;

    protected $listeners = [
        'updatePaginationLength', 'confirmedToggleAction','deleteConfirm'
    ];

    public function mount(){
        abort_if(Gate::denies('service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        $this->search = str_replace(',','',$this->search);
        $statusSearch = null;
        $searchValue = $this->search;
        if(Str::contains('active', strtolower($searchValue))){
            $statusSearch = 1;
        }else if(Str::contains('inactive', strtolower($searchValue))){
            $statusSearch = 0;
        }

        $allServices = Service::query()->where(function ($query) use ($searchValue,$statusSearch){
            $query->where('title','like','%'.$searchValue.'%')
            ->orWhere('status', $statusSearch)
            ->orWhereRaw("date_format(created_at, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%']);
        })->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->paginationLength);

        return view('livewire.admin.service.index',compact('allServices'));
    }

    public function create()
    {
        $this->resetPage('page');
        $this->resetInputFields();
        $this->formMode = true;
        $this->initializePlugins();
    }

    public function store(){
        //dd($this->all());

        $validatedData = $this->validate([
            'title'      => 'required|'.Rule::unique('services')->whereNull('deleted_at'),
            'sub_title'  => 'required',
            'description'   => 'required|strip_tags',
            'status'        => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,svg|max:'.config('constants.img_max_size'),
        ],[
            'title.required' => 'The serive name field is required.',
            'sub_title.required' => 'The short description field is required.',
            'description.strip_tags'=>'The description field is required.'
        ]);

        $validatedData['status']   = $this->status;

        try{
            $insertRecord = $this->except(['search','formMode','updateMode','service_id','image','originalImage','page','paginators']);

            $service = Service::create($insertRecord);
            uploadImage($service, $this->image, 'services/image/',"services", 'original', 'save', null);
            $this->formMode = false;
            $this->resetInputFields();
            $this->flash('success',trans('messages.add_success_message'));
            return redirect()->route('admin.service');
        }catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));
        }

    }

    public function edit($id)
    {
        $this->resetPage('page');
        $service = Service::findOrFail($id);
        $this->service_id = $id;
        $this->title  = $service->title;
        $this->sub_title  = $service->sub_title;
        $this->description = $service->description;
        $this->level    = $service->level;
        $this->status = $service->status;
        $this->originalImage = $service->image_url;
        $this->formMode = true;
        $this->updateMode = true;
        $this->initializePlugins();
    }

    public function update(){
        $validatedArray = [
            'title'      => 'required|'.Rule::unique('services')->ignore($this->service_id)->whereNull('deleted_at'),
            'sub_title'  => 'required',
            'description' => 'required|strip_tags',
            'status'      => 'required',
        ];

        if($this->image || $this->removeImage){
            $validatedArray['image'] = 'required|image|mimes:jpeg,png,jpg,svg|max:'.config('constants.img_max_size');
        }

        $validatedData = $this->validate(
            $validatedArray,
            [
                'title.required'  => 'The service name field is required.',
                'sub_title.required' => 'The short description is required.',
                'description.strip_tags'=>'The description field is required.'
            ]
        );

        $validatedData['status'] = $this->status;
        $service = Service::find($this->service_id);
        // Check if the photo has been changed
        $uploadId = null;
        if ($this->image) {
            $uploadId = $service->serviceImage ? $service->serviceImage->id : '';
            if($uploadId){
                uploadImage($service, $this->image, 'services/image/',"services", 'original', 'update', $uploadId);
            }else{
                uploadImage($service, $this->image, 'services/image/',"services", 'original', 'save', null);
            }
        }

        $updateRecord = $this->except(['search','formMode','updateMode','service_id','image','originalImage','page','paginators']);

        $service->update($updateRecord);

        $this->formMode = false;
        $this->updateMode = false;

        $this->flash('success',trans('messages.edit_success_message'));
        $this->resetInputFields();
        return redirect()->route('admin.service');

    }

    public function show($id){
        $this->resetPage('page');
        $this->service_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
        $this->initializePlugins();
    }

    public function delete($id){
        //dd($this->id);
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
        $model = Service::find($deleteId);
        $uploadImageId = $model->serviceImage->id;
        deleteFile($uploadImageId);
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    private function resetInputFields(){
        $this->title = '';
        $this->sub_title = '';
        $this->description = '';
        $this->status = 1;
        $this->image = null;
    }

    public function cancel(){
        $this->formMode = false;
        $this->updateMode = false;
        $this->viewMode = false;

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
            'inputAttributes' => ['serviceId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $serviceId = $event['data']['inputAttributes']['serviceId'];
        $model = Service::find($serviceId);
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
