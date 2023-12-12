
<h4 class="card-title">
    {{ $updateMode ? __('global.edit') : __('global.create') }} 
    {{ strtolower(__('cruds.course.title_singular'))}}</h4>

<form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="forms-sample">
    
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="font-weight-bold justify-content-start">{{ __('cruds.course.fields.name')}}<i class="fas fa-asterisk"></i></label>
                <input type="text" class="form-control" wire:model.defer="name" placeholder="{{ __('cruds.course.fields.name')}}" autocomplete="off">
                @error('name') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">{{ __('cruds.course.fields.package')}}<i class="fas fa-asterisk"></i></label>
                
                <select class="js-example-basic-single select-package w-100" wire:model.defer="selectedPackages" multiple>
                    @foreach($allPackage as $package)
                        <option value="{{$package->id}}" {{ in_array($package->id,$selectedPackages) ? 'selected' : ''}}>{{$package->title}}</option>
                    @endforeach
                </select>
            </div>
            @error('selectedPackages') <span class="error text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">{{ __('cruds.course.fields.description')}}<i class="fas fa-asterisk"></i></label>
                <textarea class="form-control" id="summernote" wire:model.defer="description" rows="4"></textarea>
            </div>
            @error('description') <span class="error text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

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
                        <video class="videolayer_box" id="videoPreview" src="{{$originalVideo}}" controls style="width: 100%; height: auto;" autoplay></video>
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
                @error('state.status') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mr-2 submit-btn">
        {{ $updateMode ? __('global.update') : __('global.submit') }}
        <span wire:loading wire:target="{{ $updateMode ? 'update' : 'store' }}">
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
               