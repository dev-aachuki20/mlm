<?php

namespace App\Http\Livewire\Admin\Testimonial;

use Gate;
use Livewire\Component;
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

    protected $testimonials = null ;

    public $testimonial_id = null, $name, $designation, $description, $rating, $status = 1,$testimonial_image = null, $originalImage;

    protected $listeners = [
        'confirmedToggleAction', 'deleteConfirm'
    ];

    public function mount(){
        abort_if(Gate::denies('testimonial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function render()
    {

        $this->testimonials = Testimonial::query()
        ->where('name', 'like', '%'.$this->search.'%')
        ->orderBy('id','desc')
        ->paginate(10);

        $allTestimonials = $this->testimonials;

        return view('livewire.admin.testimonial.index',compact('allTestimonials'));
    }

    public function create()
    {
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
            'testimonial_image' => 'required|image|max:'.config('constants.logo_max_size'),
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
            $validatedData['testimonial_image'] = 'required|image|max:'.config('constants.logo_max_size');
        }
  
        $validatedData['status'] = !$this->status;

        $testimonial = Testimonial::find($this->testimonial_id);

        // Check if the photo has been changed
        $uploadId = null;
        if ($this->testimonial_image) {
             $uploadId = $testimonial->testimonialLogo->id;
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
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function show($id){
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


    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }

}
