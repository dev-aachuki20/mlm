
<h4 class="card-title">
    {{ $updateMode ? __('global.edit') : __('global.create') }} 
    {{ strtolower(__('cruds.page.title_singular'))}}</h4>

<form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="forms-sample">
    
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.page.fields.title')}}</label>
                <input type="text" class="form-control" wire:model.defer="title" placeholder="{{ __('cruds.page.fields.title')}}">
                @error('title') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.page.fields.template_name')}}</label>
                <input type="text" class="form-control" wire:model.defer="template_name" placeholder="{{ __('cruds.page.fields.template_name')}}">
                @error('template_name') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold">{{ __('cruds.page.fields.description')}}</label>
                <textarea class="form-control" id="summernote" wire:model.defer="description" rows="4"></textarea>
            </div>
            @error('description') <span class="error text-danger">{{ $message }}</span>@enderror

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

    <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mr-2">
        {{ $updateMode ? __('global.update') : __('global.submit') }}
        <span wire:loading wire:target="store">
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
               