
<h4 class="card-title">
    {{ $updateMode ? __('global.edit') : __('global.create') }} 
    {{ strtolower(__('cruds.page.title_singular'))}}</h4>

<form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="forms-sample">
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.page.fields.title')}}</label>
                <input type="text" class="form-control" wire:model.defer="title" placeholder="{{ __('cruds.page.fields.title')}}">
                @error('title') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.page.fields.type')}}</label>
                <select class="form-control select-type" wire:model="type" {{ $type == 3 ? 'disabled':'' }}>
                    <option value="">Select Type</option>
                    @if(config('constants.page_types'))
                        @foreach(config('constants.page_types') as $id=>$name)
                            @if($updateMode)
                                <option value="{{$id}}" {{$type == $id ? 'selected' : ''}}>{{ ucwords($name) }}</option>
                            @else
                                @if($id != 3)
                                <option value="{{$id}}" {{$type == $id ? 'selected' : ''}}>{{ ucwords($name) }}</option>
                                @endif
                            @endif
                           
                        @endforeach
                    @endif
                </select>
                @error('type') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="row {{ in_array($type,array(4,5)) ? 'd-none' : ''}}">
        <div class="col-md-12">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.page.fields.sub_title')}}</label>
                <input type="text" class="form-control" wire:model.defer="sub_title" placeholder="{{ __('cruds.page.fields.sub_title')}}">
                @error('sub_title') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="row {{ in_array($type,array(4,5)) ? 'd-none' : ''}}" >
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold">{{ __('cruds.page.fields.slider_image')}}</label>
                <input type="file" id="sliderImage"  wire:model.defer="slider_image" class="dropify" data-default-file="{{ $originalsliderImage }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" data-min-file-size-preview="1M" data-max-file-size-preview="3M" accept="image/jpeg, image/png, image/jpg,image/svg">
                <span wire:loading wire:target="slider_image">
                    <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Loading
                </span>
            </div>
            @if($errors->has('slider_image'))
            <span class="error text-danger">
                {{ $errors->first('slider_image') }}
            </span>
            @endif
        </div>
    </div>

    <div class="row {{ in_array($type,array(1,2,3)) ? 'd-none' : ''}}" >
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold">Image</label>
                <input type="file"   wire:model.defer="image" class="dropify" data-default-file="{{ $originalImage }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" data-min-file-size-preview="1M" data-max-file-size-preview="3M" accept="image/jpeg, image/png, image/jpg,image/svg">
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

    <div class="row {{ in_array($type,array(1,2,3)) ? 'd-none' : ''}}">
        <div class="col-md-12">
            <div class="form-group">
                <label class="font-weight-bold">Link</label>
                <input type="text" class="form-control" wire:model.defer="link" placeholder="Link">
                @error('link') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    @if($type != 3)
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold">{{ __('cruds.page.fields.description')}}</label>
                <textarea class="form-control" id="summernote" wire:model.defer="description" rows="4"></textarea>
            </div>
            @error('description') <span class="error text-danger">{{ $message }}</span>@enderror

        </div>
    </div>
    @endif
    
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

    <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mr-2">
        {{ $updateMode ? __('global.update') : __('global.submit') }}
        <span wire:loading wire:target="{{ $updateMode ? 'update' :'store' }}">
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
               