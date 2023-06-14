<?php

namespace App\Http\Livewire\Admin\Setting;

use Gate;
use Livewire\Component;
use App\Models\Setting;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;

class Index extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false, $viewDetails = null;

    public $setting_id = null, $key, $value, $type, $status = 1, $image, $originalImage, $video, $originalVideo;

    protected $settings = null;

    protected $listeners = [
        'confirmedToggleAction','deleteConfirm','changeType',
    ];

    public function mount(){
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function render()
    {
        $this->settings = Setting::query()
        ->where('key', 'like', '%'.$this->search.'%')
        ->where('type', 'like', '%'.$this->search.'%')
        ->orderBy('id','ASC')
        ->paginate(10);
      
        $allSetting = $this->settings;

        return view('livewire.admin.setting.index',compact('allSetting'));
    }

    public function create()
    {
        $this->resetPage('page');
        $this->resetInputFields();
        $this->initializePlugins();
        $this->formMode = true;
    }

    public function store(){
        $validationArray = [
            'key'     => 'required|regex:/^\S*$/u|unique:settings,key',
            'type'    => 'required',
            'status'  => 'required',
        ];

        if($this->type == 'logo'){
            $validationArray['value'] = '';
            $validationArray['image'] = 'required|image|max:'.config('constants.img_max_size');
        }else if ($this->type == 'video'){
            $validationArray['video'] = 'required|mimetypes:video/webm,video/mp4, video/avi,video/wmv,video/flv,video/mov|max:'.config('constants.video_max_size');
        }else{
            $validationArray['value'] = 'required';
        }

        $validatedData = $this->validate($validationArray);

        $validatedData['status'] = $this->status;
    
        $createdSetting = Setting::create($validatedData);
  
        if($this->type == 'logo'){
            uploadImage($createdSetting, $this->image, 'setting/logo/',"setting", 'original', 'save', null);
        }

        if($this->type == 'video'){
            uploadImage($createdSetting, $this->video, 'setting/video/',"setting", 'original', 'save', null);
        }

        $this->formMode = false;

        $this->resetInputFields();

        $this->flash('success',trans('messages.add_success_message'));
      
        return redirect()->route('admin.setting');
    }

    public function edit($id){
        $this->resetPage('page');
        $this->initializePlugins();
        $setting = Setting::findOrFail($id);
        $this->setting_id = $id;
        $this->key     = $setting->key;
        $this->value   = $setting->value;
        $this->type    = $setting->type;

        if($setting->type == 'logo'){
            $this->originalImage = $setting->image_url;
        }

        if($setting->type == 'video'){
            $this->originalVideo= $setting->video_url;
        }

        $this->status  = $setting->status;

        $this->formMode = true;
        $this->updateMode = true;
    }

    public function update(){
       
        $validationArray = [
            'key'     => 'required|unique:settings,key,'.$this->setting_id,
            'type'    => 'required',
            'status'  => 'required',
        ];

        if($this->type == 'logo' && $this->image){
            $validationArray['value'] = '';
            $validationArray['image'] = 'required|image|max:'.config('constants.img_max_size');
        }else if ($this->type == 'video' && $this->video){
            $validationArray['video'] = 'required|mimetypes:video/webm,video/mp4, video/avi,video/wmv,video/flv,video/mov|max:'.config('constants.video_max_size');
        }else if($this->type != 'logo' && $this->type != 'video'){
            $validationArray['value'] = 'required';
        }

        $validatedData = $this->validate($validationArray);

        DB::beginTransaction();
        try {
           
            $validatedData['status'] = $this->status;
        
            $filteredData = Arr::except($validatedData, 'key');
            
            $setting = Setting::find($this->setting_id);

            $uploadId = null;
            if($this->type == 'logo' && $this->image){
                $uploadId = ($setting->image) ? $setting->image->id : null;
                if($uploadId){
                    uploadImage($setting, $this->image, 'setting/logo/',"setting", 'original', 'update', $uploadId);
                }else{
                    uploadImage($setting, $this->image, 'setting/logo/',"setting", 'original', 'save', null);
                }
            }

            if($this->type == 'video'  && $this->video){
                $uploadId = ($setting->video) ? $setting->video->id : null;
                if($uploadId){
                    uploadImage($setting, $this->video, 'setting/video/',"setting", 'original', 'update', $uploadId);
                }else{
                    uploadImage($setting, $this->video, 'setting/video/',"setting", 'original', 'save', null);
                }
            }

            $setting->update($filteredData);
        
            $this->formMode = false;
           
            $this->resetInputFields();

            $this->flash('success',trans('messages.edit_success_message'));
        
            return redirect()->route('admin.setting');
        }catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));
        }

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
        $model = Setting::find($deleteId);
        $uploadId = $model->uploads()->first()->id;
        deleteFile($uploadId);
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function show($id){
        $this->resetPage('page');
        $this->setting_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
    }

    private function resetInputFields(){
        $this->type = '';
        $this->value = '';
        $this->image = null;
        $this->originalImage = null;
        $this->video = null;
        $this->originalVideo = null;
        $this->status = 1;
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
            'confirmButtonText' => 'Yes, change it!',
            'cancelButtonText' => 'No, cancel!',
            'onConfirmed' => 'confirmedToggleAction',
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['settingId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $settingId = $event['data']['inputAttributes']['settingId'];
        $model = Setting::find($settingId);
        $model->update(['status' => !$model->status]);
        $this->alert('success', trans('messages.change_status_success_message'));
    }

    public function changeStatus($statusVal){
        $this->status = (!$statusVal) ? 1 : 0;
    }
    
    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }

    public function changeType($typeVal){
        $this->type = $typeVal;
        $this->initializePlugins();
    }
}
