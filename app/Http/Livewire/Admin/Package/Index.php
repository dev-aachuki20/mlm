<?php

namespace App\Http\Livewire\Admin\Package;

use Gate;
use App\Models\Package;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;
use App\Rules\CommissionRule;


class Index extends Component
{
   
    use WithPagination, LivewireAlert,WithFileUploads;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false;

    protected $packages = null;

    public  $title, $amount, $status = 1, $description='',$image=null,$viewMode = false,$originalImage;

    public $package_id =null, $level_one_commission, $level_two_commission, $level_three_commission;

    protected $listeners = [
        'confirmedToggleAction','deleteConfirm'
    ];

    public function mount(){
        abort_if(Gate::denies('package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function render()
    {
        $this->search = str_replace(',', '', $this->search);
         $this->packages = Package::query()
            ->where('title', 'like', '%'.$this->search.'%')
            ->orWhere('amount', 'like', '%'.$this->search.'%')
            ->orderBy('id','desc')
            ->paginate(10);

        $allPackages = $this->packages;
        return view('livewire.admin.package.index',compact('allPackages'));
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
            'title'  => 'required',
            'amount' => 'required',
            'level_one_commission'   => [new CommissionRule($this->amount)],
            'level_two_commission'   => [new CommissionRule($this->amount)],
            'level_three_commission' => [new CommissionRule($this->amount)],
            'description' => 'required',
            'status' => 'required',
            'image' => 'required|image|max:'.config('constants.img_max_size'),
        ]);
        
        $validatedData['status'] = $this->status;

        $insertRecord = $this->except(['search','formMode','updateMode','package_id','image','originalImage','page','paginators']);

        $package = Package::create($insertRecord);
    
        uploadImage($package, $this->image, 'package/image/',"package", 'original', 'save', null);

        $this->formMode = false;

        $this->resetInputFields();

        $this->flash('success',trans('messages.add_success_message'));
        
        return redirect()->route('admin.package');
       
    }


    public function edit($id)
    {
        $package = Package::findOrFail($id);

        $this->package_id = $id;
        $this->title  = $package->title;
        $this->amount = $package->amount;
        $this->level_one_commission = $package->level_one_commission;
        $this->level_two_commission = $package->level_two_commission;
        $this->level_three_commission = $package->level_three_commission;
        $this->description = $package->description;
        $this->status = $package->status;
        $this->originalImage = $package->image_url;

        $this->formMode = true;
        $this->updateMode = true;
        $this->initializePlugins();
    }

    public function update(){
        $validatedData = $this->validate([
            'title' => 'required',
            'amount' => 'required',
            'level_one_commission'   => '',
            'level_two_commission'   => '',
            'level_three_commission' => '',
            'description' => 'required',
            'status' => 'required',
        ]);

        if($this->image){
            $validatedData['image'] = 'required|image|max:'.config('constants.img_max_size');
        }
  
        $validatedData['status'] = !$this->status;

        $package = Package::find($this->package_id);

        // Check if the photo has been changed
        $uploadId = null;
        if ($this->image) {
            $uploadId = $package->packageImage->id;
            uploadImage($package, $this->image, 'package/image/',"package", 'original', 'update', $uploadId);
        }
        
        $updateRecord = $this->except(['search','formMode','updateMode','package_id','image','originalImage','page','paginators']);

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
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function show($id){
        $this->package_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
    }

    private function resetInputFields(){
        $this->title = '';
        $this->amount = '';
        $this->level_one_commission = '';
        $this->level_two_commission = '';
        $this->level_three_commission = '';
        $this->description = '';
        $this->status = 1;
        $this->package_image =null;
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

    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }


}
