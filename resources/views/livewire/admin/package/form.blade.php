
<h4 class="card-title">
    {{ $updateMode ? __('global.edit') : __('global.create') }} 
    {{ strtolower(__('cruds.package.title_singular'))}}</h4>

<form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="forms-sample" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold justify-content-start">{{ __('cruds.package.fields.title')}} <i class="fas fa-asterisk"></i></label>
                <input type="text" class="form-control" wire:model.defer="title" placeholder="{{ __('cruds.package.fields.title')}}">
                @error('title') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold justify-content-start">{{ __('cruds.package.fields.amount')}}<i class="fas fa-asterisk"></i></label>
                <input type="number" class="form-control" wire:model.defer="amount" placeholder="{{ __('cruds.package.fields.amount')}}" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Period','NumpadDecimal'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"  min="0" step=".01" autocomplete="off">
                @error('amount') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold justify-content-start">{{ __('cruds.package.fields.sub_title')}}<i class="fas fa-asterisk"></i></label>
                <input type="text" class="form-control" wire:model.defer="sub_title" placeholder="{{ __('cruds.package.fields.sub_title')}}">
                @error('sub_title') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        {{-- <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.package.fields.duration')}}</label>
                <input type="text" class="form-control" id="duration" wire:model.defer="duration" placeholder="{{ __('cruds.package.fields.duration')}}" autocomplete="off">
                @error('duration') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div> --}}
        <div class="col-md-6 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">{{ __('cruds.package.fields.level')}}<i class="fas fa-asterisk"></i></label>
                <select class="js-example-basic-single select-level w-100" wire:model.defer="level" >
                    <option>Select Level</option>
                    @foreach(config('constants.levels') as $id=>$level)
                        <option value="{{$id}}" {{$level == $id ? 'selected':''}}>{{ ucfirst($level) }}</option>
                    @endforeach
                </select>
            </div>
            @error('level') <span class="error text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">Child Packages</label>
                <select class="js-example-basic-single child-packages w-100" wire:model.defer="child_packages" multiple>
                    @if($listPackages)
                        @foreach($listPackages as $id=>$package_title)
                            <option value="{{$id}}" {{ in_array($id,$child_packages) ? 'selected' : '' }}>{{ ucfirst($package_title) }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            @error('child_packages') <span class="error text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <p class="card-description">{{ __('cruds.package.fields.commission')}}</p>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold ">{{ __('cruds.package.fields.level_one_commission')}}</label>
                <input type="number" class="form-control" wire:model.defer="level_one_commission" placeholder="{{ __('cruds.package.fields.level_one_commission')}} commission" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Period','NumpadDecimal'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"  min="0" step=".01" autocomplete="off">
                @error('level_one_commission') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.package.fields.level_two_commission')}}</label>
                <input type="number" class="form-control" wire:model.defer="level_two_commission" placeholder="{{ __('cruds.package.fields.level_two_commission')}} commission" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Period','NumpadDecimal'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"  min="0" step=".01" autocomplete="off">
                @error('level_two_commission') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.package.fields.level_three_commission')}}</label>
                <input type="number" class="form-control" wire:model.defer="level_three_commission" placeholder="{{ __('cruds.package.fields.level_three_commission')}} commission" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Period','NumpadDecimal'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"  min="0" step=".01" autocomplete="off">
                @error('level_three_commission') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">{{ __('cruds.package.fields.features')}}<i class="fas fa-asterisk"></i></label>
                <textarea class="form-control" id="summernote-features" wire:model.defer="features" rows="10"></textarea>
            </div>
            @error('features') <span class="error text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">{{ __('cruds.package.fields.description')}}<i class="fas fa-asterisk"></i></label>
                <textarea class="form-control" id="summernote" wire:model.defer="description" rows="10"></textarea>
            </div>
            @error('description') <span class="error text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">{{ __('cruds.package.fields.image')}}<i class="fas fa-asterisk"></i></label>
                <input type="file"  id="dropify-image" wire:model.defer="image" class="dropify" data-default-file="{{ $originalImage }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" data-min-file-size-preview="1M" data-max-file-size-preview="3M" accept="image/jpeg, image/png, image/jpg,image/svg">
                <span wire:loading wire:target="image">
                    <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Loading
                </span>
            </div>
         
            @if($errors->has('image'))
            <span class="error text-danger">
                {{ $errors->first('image') }}
            </span>
            @endif
        </div>
    </div>
   
    <div class="row logo-section">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="font-weight-bold mb-0 justify-content-start">Video<i class="fas fa-asterisk"></i></label> 
                
                    @if($updateMode && (!$removeVideo))
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#videoModal">
                    Preview
                    </button>
                    @endif
                </div>

                <div wire:ignore>
                    <input type="file"  id="dropify-video"  wire:model.defer="video" class="dropify" data-default-file="{{ $originalVideo }}"  accept="video/webm, video/mp4, video/avi,video/wmv,video/flv,video/mov">
                    <span wire:loading wire:target="video">
                        <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Loading
                    </span>
                </div>

            </div>
            
            @if($errors->has('video'))
            <span class="error text-danger">
                {{ $errors->first('video') }}
            </span>
            @endif
        </div>
    </div> --}}

    <div class="row logo-section">
        <div class="col-md-6 mb-4 image-section">
            <div class="card" wire:ignore wire:key="image-upload-key">
                <div class="card-header text-center">
                    <h5>Upload Image File</h5>
                </div>

                <div class="card-body">
                    <div id="upload-container" class="text-center">
                        <button type="button" id="browseImageFile" class="btn btn-primary">Browse File</button>
                    </div>
                    <div style="display: none" class="progress mt-3 progress-image" style="height: 25px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" id="progress-bar-image" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                    </div>
                </div>

                @if(!is_null($originalImage))
                    <div class="card-footer p-4" style="display: block">
                        <div class="imglayer_box">
                            <img id="imagePreview" src="{{$originalImage}}" style="width: 100%; height: auto; display: block" alt="img"/>
                        </div>
                    </div>
                @else
                    <div class="card-footer p-4" style="display: none">
                        <div class="imglayer_box">
                            <img id="imagePreview" src="" style="width: 100%; height: auto; display: none" alt="img"/>
                        </div>
                    </div>
                @endif
                
            </div>
            
            @if($errors->has('image'))
            <span class="error text-danger">
                {{ $errors->first('image') }}
            </span>
            @endif
        </div>

        <div class="col-md-6 mb-4 video-section">
            <div class="card" wire:ignore wire:key="video-upload-key">
                <div class="card-header text-center">
                    <h5>Upload Video File</h5>
                </div>

                <div class="card-body">
                    <div id="upload-container" class="text-center">
                        <button type="button" id="browseVideoFile" class="btn btn-primary">Browse File</button>
                    </div>
                    <div style="display: none" class="progress mt-3 progress-video" style="height: 25px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" id="progress-bar-video" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                    </div>
                </div>

                @if(!is_null($originalVideo))
                    <div class="card-footer p-4">
                        <video class="videolayer_box" id="videoPreview" src="{{$originalVideo}}" controls style="width: 100%; height: auto;"></video>
                    </div>
                @else
                    <div class="card-footer p-4" style="display: none">
                        <video class="videolayer_box" id="videoPreview" src="" controls style="width: 100%; height: auto; display: none"></video>
                    </div>
                @endif
              
            </div>
            
            @if($errors->has('video'))
            <span class="error text-danger">
                {{ $errors->first('video') }}
            </span>
            @endif
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="font-weight-bold">{{__('global.status')}}</label>
                <div class="form-group">
                    <label class="toggle-switch">
                        <input type="checkbox" class="toggleSwitch" wire:change.prevent="changeStatus({{$status}})" value="{{ $status }}" {{ $status ==1 ? 'checked' : '' }}>
                        <span class="switch-slider"></span>
                    </label>
                </div>
                @error('status') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mr-2 submit-btn">
        {{ $updateMode ? __('global.update') : __('global.submit') }}
        <span wire:loading wire:target="{{$updateMode ? 'update' : 'store'}}">
            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
        </span>
    </button>
    <button wire:click.prevent="cancel" class="btn btn-secondary">
        {{ __('global.cancel')}}
        <span wire:loading wire:target="cancel">
            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
        </span>
    </button>
</form>

@if($updateMode)
    @include('livewire.admin.partials.includes.preview-video')
@endif