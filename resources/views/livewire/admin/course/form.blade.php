
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
                
                <select class="js-example-basic-single select-package w-100" wire:model.defer="package_id" >
                    <option>Select Package</option>
                    @foreach($allPackage as $package)
                        <option value="{{$package->id}}" {{$package_id == $package->id ? 'selected':''}} {{$package->courses()->count() > 0 ? 'disabled':''}}>{{$package->title}}</option>
                    @endforeach
                </select>
            </div>
            @error('package_id') <span class="error text-danger">{{ $message }}</span>@enderror
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
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">Image<i class="fas fa-asterisk"></i></label>
                <input type="file" id="dropify-image"  wire:model.defer="image" class="dropify" data-default-file="{{ $originalImage }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" accept="image/jpeg, image/png, image/jpg,image/svg">
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
                    <input type="file"  id="dropify-video"  wire:model.defer="video" class="dropify" data-default-file="{{ $originalVideo }}"  data-errors-position="outside" data-allowed-file-extensions="webm mp4 avi wmv flv mov" data-max-file-size="{{ config('constants.data_max_file_size') }}" accept="video/webm, video/mp4, video/avi,video/wmv,video/flv,video/mov">
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

    <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mr-2">
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
               