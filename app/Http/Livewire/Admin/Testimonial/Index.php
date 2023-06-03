<?php

namespace App\Http\Livewire\Admin\Testimonial;

use Livewire\Component;
use App\Models\Testimonial;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false;

    protected $testimonials = null;

    public $testimonial_id = null, $name, $designation, $description, $rating, $status = 1;

    protected $listeners = [
        'confirmedToggleAction', 'deleteConfirm'
    ];

    public function render()
    {

        $this->testimonials = Testimonial::query()
        ->where('name', 'like', '%'.$this->search.'%')
        ->orderBy('name')
        ->paginate(10);

        $allTestimonials = $this->testimonials;

        return view('livewire.admin.testimonial.index',compact('allTestimonials'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->formMode = true;
    }


    public function store()
    {
        $validatedDate = $this->validate([
            'name'        => 'required',
            'designation' => 'required',
            'description' => 'required',
            // 'rating'      => 'required',
            'status' => 'required',
        ]);
  
        $validatedDate['status'] = !$this->status;

        Testimonial::create($validatedDate);
  
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
        $this->designation    = $testimonial->designation;
        $this->description    = $testimonial->description;
        $this->status         = $testimonial->status;

        $this->formMode = true;
        $this->updateMode = true;
    }

    public function update(){
        $validatedDate = $this->validate([
            'name'        => 'required',
            'designation' => 'required',
            'description' => 'required',
            // 'rating'      => 'required',
            'status' => 'required',
        ]);
  
        $validatedDate['status'] = !$this->status;

        $testimonial = Testimonial::find($this->testimonial_id);
        $testimonial->update($validatedDate);
  
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


    private function resetInputFields(){
        $this->name = '';
        $this->designation = '';
        $this->description = '';
        $this->status = 1;
    }

    public function cancel(){
        $this->formMode = false;
        $this->updateMode = false;
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


}
