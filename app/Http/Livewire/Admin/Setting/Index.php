<?php

namespace App\Http\Livewire\Admin\Setting;

use Gate;
use Livewire\Component;
use App\Models\Setting;
use Illuminate\Support\Str; 
use Illuminate\Support\Arr;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;


class Index extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    // protected $layout = null;

    public $tab = 'site', $settings = null, $state = [];

    protected $listeners = [
        'changeTab','copyTextAlert',
    ];

    public function mount(){
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->settings = Setting::where('group',$this->tab)->where('status',1)->get();

        $this->state = $this->settings->pluck('value','key')->toArray();
    }

    public function changeTab($tab){
        $this->tab = $tab;
        $this->mount();
        $this->initializePlugins();
    }


    public function render()
    {
        $allSettingType = Setting::groupBy('group')->pluck('group');
      
        return view('livewire.admin.setting.index',compact('allSettingType'));
    }


    public function update(){

        $rules = [];
        foreach ($this->settings as $setting) {
            if($setting){

                if ($setting->type == 'text') {
                    $rules['state.'.$setting->key] = 'required|string';
                }

                if ($setting->type == 'number') {
                    $rules['state.'.$setting->key] = 'required|numeric';
                }

                if ($setting->type == 'text_area') {
                    $rules['state.'.$setting->key] = ($setting->group != 'mail') ? 'required|string' : 'string';
                }

                if($setting->type == 'image'){
                    $rules['state.'.$setting->key] = 'nullable|image|max:'.config('constants.img_max_size').'|mimes:jpeg,png,jpg,svg,PNG,JPG,SVG';
                }

                if($setting->type == 'video'){
                    $rules['state.'.$setting->key] = 'nullable|max:'.config('constants.video_max_size').'|mimetypes:video/webm,video/mp4, video/avi,video/wmv,video/flv,video/mov';
                }
                
            }
        }
   
        $customMessages = [
            'required' => 'The field is required.',
            'state.site_logo' => 'The site logo must be an image.',
            'site.site_logo.mimes' => 'The website logo must be jpeg,png,jpg,PNG,JPG.',
            'site.site_logo.max'   => 'The website logo maximum size is '.config('constants.img_max_size').' KB.',
         
            'site.introduction_video.video' => 'The introduction video must be an video.',
            'site.introduction_video.mimes' => 'The introduction video must be webm, mp4, avi, wmv, flv, mov.',
            'site.introduction_video.max'   => 'The favicon icon maximum size is '.config('constants.video_max_size').' KB.'
        ];

        $validatedData = $this->validate($rules,$customMessages);
        
        DB::beginTransaction();
        try {
            foreach($validatedData['state'] as $key=>$stateVal){
                $setting = Setting::where('key',$key)->first();

                $setting_value = $stateVal;

                if($setting->type == 'image'){
                
                    if ($stateVal) {
                        $uploadId = null;
                        $uploadId = $setting->image ? $setting->image->id : null;
                        if($uploadId){
                            uploadImage($setting, $stateVal, 'settings/images/',"setting", 'original', 'update', $uploadId);
                        }else{
                            uploadImage($setting, $stateVal, 'settings/images/',"setting", 'original', 'save', null);
                        }
                    }

                    $setting_value = null;
                }

                if($setting->type == 'video'){
                
                    if ($stateVal) {
                        $uploadId = null;
                        $uploadId = $setting->video ? $setting->video->id : null;
                        if($uploadId){
                            uploadImage($setting, $stateVal, 'settings/videos/',"setting", 'original', 'update', $uploadId);
                        }else{
                            uploadImage($setting, $stateVal, 'settings/videos/',"setting", 'original', 'save', null);
                        }
                    }

                    $setting_value = null;
                }

                $setting->value = $setting_value;
                $setting->save();

                DB::commit();
            }

            // $this->reset(['state']);

            $this->alert('success',trans('messages.edit_success_message'));
        
        }catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));
        }

    }

  
    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }

  
    public function copyTextAlert(){
        $this->alert('success','Copied Successfully!');
    }
}
