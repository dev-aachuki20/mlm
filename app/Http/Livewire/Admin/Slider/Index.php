<?php

namespace App\Http\Livewire\Admin\Slider;

use Gate;
use App\Models\Slider;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;

class Index extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false ,$originalImage;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $slider_id = null, $name, $type, $image=null, $status = 1;


    protected $listeners = [
        'updatePaginationLength','confirmedToggleAction','deleteConfirm'
    ];

    public function mount(){
        abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        $this->search = str_replace(',', '', $this->search);
        $statusSearch = null;
        $searchValue = $this->search;
        if(Str::contains('active', strtolower($searchValue))){
            $statusSearch = 1;
        }else if(Str::contains('inactive', strtolower($searchValue))){
            $statusSearch = 0;
        }

        $allSliders = Slider::query()->where(function ($query) use($searchValue,$statusSearch) {
            $query->where('name', 'like', '%'.$searchValue.'%')
            ->orWhere('status', $statusSearch)
            ->orWhereRaw("date_format(created_at, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%']);
        })
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->paginationLength);

        return view('livewire.admin.slider.index',compact('allSliders'));
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
            'name'  => 'required',
            'type'  => 'required',
            'status' => 'required',
            'image' => 'required|image|max:'.config('constants.img_max_size'),
        ]);
        
        $validatedData['status'] = $this->status;

        $insertRecord = $this->except(['search','formMode','updateMode','slider_id','image','originalImage','page','paginators']);

        $slider = Slider::create($insertRecord);
    
        uploadImage($slider, $this->image, 'slider/',"slider", 'original', 'save', null);

        $this->formMode = false;

        $this->resetInputFields();

        $this->flash('success',trans('messages.add_success_message'));
        
        return redirect()->route('admin.slider');
       
    }

    public function edit($id)
    {
        $this->resetPage('page');
        $slider = Slider::findOrFail($id);
        $this->slider_id = $id;
        $this->name           = $slider->name;
        $this->type           = $slider->type;
        $this->status         = $slider->status;
        $this->originalImage  = $slider->image_url;
        $this->formMode = true;
        $this->updateMode = true;
        $this->initializePlugins();
    }

    public function update(){
        $validatedData = $this->validate([
            'name'        => 'required',
            'type'        => 'required',
            'status'      => 'required',
        ]);

        if($this->image){
            $validatedData['image'] = 'required|image|max:'.config('constants.img_max_size');
        }
  
        $validatedData['status'] = $this->status;

        $slider = Slider::find($this->slider_id);

        // Check if the photo has been changed
        $uploadId = null;
        if ($this->image) {
             $uploadId = $slider->sliderImage->id;
             uploadImage($slider, $this->image, 'slider/',"slider", 'original', 'update', $uploadId);
        }

        $slider->update($validatedData);
     
        $this->formMode = false;
        $this->updateMode = false;
  
        $this->flash('success',trans('messages.edit_success_message'));
        $this->resetInputFields();
        return redirect()->route('admin.slider');
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
        $model = Slider::find($deleteId);
        $uploadId = $model->uploads()->first()->id;
        deleteFile($uploadId);
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function show($id){
        $this->resetPage('page');
        $this->slider_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
    }

    private function resetInputFields(){
        $this->name = '';
        $this->type = '';
        $this->status = 1;
        $this->image = null;
        $this->originalImage = null;
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
            'inputAttributes' => ['sliderId' => $id],
        ]);
    }


    public function confirmedToggleAction($event)
    {
        $sliderId = $event['data']['inputAttributes']['sliderId'];
        $model = Slider::find($sliderId);
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
