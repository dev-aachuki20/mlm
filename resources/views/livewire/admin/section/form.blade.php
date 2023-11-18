
<h4 class="card-title">
    {{ $updateMode ? __('global.edit') : __('global.create') }}
    {{ strtolower(__('cruds.section.title_singular'))}}</h4>

<form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="forms-sample">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="font-weight-bold justify-content-start">{{ __('cruds.section.fields.name')}} <i class="fas fa-asterisk"></i></label>
                <input type="text" class="form-control" wire:model.defer="name" placeholder="{{ __('cruds.section.fields.name')}}">
                @error('name') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    @if($section_key == 'what_is_bizshiksha')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="font-weight-bold justify-content-start">{{ __('cruds.section.fields.year_experience')}} </label>
                <input type="number" class="form-control" wire:model.defer="year_experience" placeholder="{{ __('cruds.section.fields.year_experience')}}">
                @error('year_experience') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="font-weight-bold justify-content-start">{{ __('cruds.section.fields.short_description')}}</label>
                <input type="text" class="form-control" wire:model.defer="short_description" placeholder="{{ __('cruds.section.fields.short_description')}}">
                @error('short_description') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">{{ __('cruds.section.fields.description')}}<i class="fas fa-asterisk"></i></label>
                <textarea class="form-control" id="summernote" wire:model.defer="description" rows="10"></textarea>
            </div>
            @error('description') <span class="error text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">{{ __('cruds.section.fields.features')}}</label>
                <textarea class="form-control" id="summernote-features" wire:model.defer="features" rows="10"></textarea>
            </div>
            @error('features') <span class="error text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">{{ __('cruds.section.fields.image1')}}<i class="fas fa-asterisk"></i></label>
                <input type="file"  id="dropify-image" wire:model.defer="image1" class="dropify" data-default-file="{{ $originalImage1 }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" data-min-file-size-preview="1M" data-max-file-size-preview="3M" accept="image/jpeg, image/png, image/jpg,image/svg">
                <span wire:loading wire:target="image1">
                    <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Loading
                </span>
            </div>
            @if($errors->has('image1'))
            <span class="error text-danger">
                {{ $errors->first('image1') }}
            </span>
            @endif
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">{{ __('cruds.section.fields.image2')}}</label>
                <input type="file"  id="dropify-image" wire:model.defer="image2" class="dropify" data-default-file="{{ $originalImage2 }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" data-min-file-size-preview="1M" data-max-file-size-preview="3M" accept="image/jpeg, image/png, image/jpg,image/svg">
                <span wire:loading wire:target="image2">
                    <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Loading
                </span>
            </div>
            @if($errors->has('image2'))
            <span class="error text-danger">
                {{ $errors->first('image2') }}
            </span>
            @endif
        </div>
    </div> --}}

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

