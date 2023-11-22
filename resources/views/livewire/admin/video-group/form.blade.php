
<h4 class="card-title">
    {{ $updateMode ? __('global.edit') : __('global.add') }} 
     Lecture</h4>

<form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="forms-sample">
    
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="font-weight-bold justify-content-start">Title <i class="fas fa-asterisk"></i></label>
                <input type="text" class="form-control" wire:model.defer="title" placeholder="Title" autocomplete="off">
                @error('title') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
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

{{--
    <div class="row logo-section">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">Image<i class="fas fa-asterisk"></i></label>
                <input type="file" id="dropify-image" wire:model.defer="image" class="dropify" data-default-file="{{ $originalImage }}"  data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" data-min-file-size-preview="1M" data-max-file-size-preview="3M" accept="image/jpeg, image/png, image/jpg,image/svg">
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
                    <input type="file" id="video-file" wire:model.defer="video" class="dropify" data-default-file="{{ $originalVideo }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="webm mp4 avi wmv flv mov" data-min-file-size-preview="1M" data-max-file-size-preview="3M" accept="video/webm, video/mp4, video/avi,video/wmv,video/flv,video/mov">
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
    </div>
--}}

    <div class="row logo-section">
        <div class="col-md-6 mb-4 image-section">
            <div class="card" wire:ignore wire:key="image-upload-key">
                <div class="card-header text-center">
                    <h5>Upload Image File</h5>
                </div>

                <div class="card-body">
                    <div id="upload-container" class="text-center">
                        <button type="button" id="browseImageFile" class="btn btn-primary">Browse File</button>
                        @if($errors->has('image'))
                        <p class="error text-danger">
                            {{ $errors->first('image') }}
                        </p>
                        @endif
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
        </div>

        <div class="col-md-6 mb-4 video-section">
            <div class="card" wire:ignore wire:key="video-upload-key">
                <div class="card-header text-center">
                    <h5>Upload Video File</h5>
                </div>

                <div class="card-body">
                    <div id="upload-container" class="text-center">
                        <button type="button" id="browseVideoFile" class="btn btn-primary">Browse File</button>
                        @if($errors->has('video'))
                        <p class="error text-danger">
                            {{ $errors->first('video') }}
                        </p>
                        @endif
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
               