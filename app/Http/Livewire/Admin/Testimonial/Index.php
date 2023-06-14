<?php

namespace App\Http\Livewire\Admin\Testimonial;

use Gate;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Testimonial;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;


class Index extends Component
{
    use WithPagination, LivewireAlert,WithFileUploads;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false,$viewMode = false;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $testimonial_id = null, $name, $designation, $description, $rating, $status = 1,$testimonial_image = null, $originalImage;

    protected $listeners = [
        'updatePaginationLength','confirmedToggleAction', 'deleteConfirm'
    ];

    public function mount(){
        abort_if(Gate::denies('testimonial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        $statusSearch = null;
        $searchValue = $this->search;
        if(Str::contains('active', strtolower($searchValue))){
            $statusSearch = 1;
        }else if(Str::contains('inactive', strtolower($searchValue))){
            $statusSearch = 0;
        }

        $allTestimonials = Testimonial::query()->where(function ($query) use($searchValue,$statusSearch) {
            $query->where('name', 'like', '%'.$searchValue.'%')
            ->orWhere('status', $statusSearch)
            ->orWhereRaw("date_format(created_at, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%']);
        })
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->paginationLength);


        return view('livewire.admin.testimonial.index',compact('allTestimonials'));
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
            'name'        => 'required',
            'designation' => 'required',
            'description' => 'required',
            'rating'      => 'required|digits_between:1,5',
            'status' => 'required',
            'testimonial_image' => 'required|image|max:'.config('constants.img_max_size'),
        ]);
  
        $validatedData['status'] = $this->status;

        $testimonial = Testimonial::create($validatedData);
  
        uploadImage($testimonial, $this->testimonial_image, 'testimonial/image/',"testimonial", 'original', 'save', null);

        $this->formMode = false;

        $this->resetInputFields();

        $this->flash('success',trans('messages.add_success_message'));
      
        return redirect()->route('admin.testimonial');
    }

    public function edit($id)
    {
        $this->resetPage('page');
        $testimonial = Testimonial::findOrFail($id);
        $this->testimonial_id = $id;
        $this->name           = $testimonial->name;
        $this->rating         = $testimonial->rating;
        $this->designation    = $testimonial->designation;
        $this->description    = $testimonial->description;
        $this->status         = $testimonial->status;
        $this->originalImage   = $testimonial->image_url;
        $this->formMode = true;
        $this->updateMode = true;
        $this->initializePlugins();
    }

    public function update(){
        $validatedData = $this->validate([
            'name'        => 'required',
            'designation' => 'required',
            'description' => 'required',
            'rating'      => 'required|digits_between:1,5',
            'status' => 'required',
        ]);

        if($this->testimonial_image){
            $validatedData['testimonial_image'] = 'required|image|max:'.config('constants.img_max_size');
        }
  
        $validatedData['status'] = $this->status;

        $testimonial = Testimonial::find($this->testimonial_id);

        // Check if the photo has been changed
        $uploadId = null;
        if ($this->testimonial_image) {
             $uploadId = $testimonial->testimonialImage->id;
             uploadImage($testimonial, $this->testimonial_image, 'testimonial/image/',"testimonial", 'original', 'update', $uploadId);
        }

        $testimonial->update($validatedData);
     
        $this->formMode = false;
        $this->updateMode = false;
  
        $this->flash('success',trans('messages.edit_success_message'));
        $this->resetInputFields();
        return redirect()->route('admin.testimonial');
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
        $model = Testimonial::find($deleteId);
        $uploadId = $model->uploads()->first()->id;
        deleteFile($uploadId);
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function show($id){
        $this->resetPage('page');
        $this->testimonial_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
    }

    private function resetInputFields(){
        $this->name = '';
        $this->rating = '';
        $this->designation = '';
        $this->description = '';
        $this->status = 1;
        $this->testimonial_image = null;
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
            'inputAttributes' => ['testimonialId' => $id],
        ]);
    }


    public function confirmedToggleAction($event)
    {
        $testimonialId = $event['data']['inputAttributes']['testimonialId'];
        $model = Testimonial::find($testimonialId);
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
