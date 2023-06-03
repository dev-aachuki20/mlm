
<h4 class="card-title">
    {{ $updateMode ? __('global.edit') : __('global.create') }} 
    {{ strtolower(__('cruds.testimonial.title_singular'))}}</h4>

<form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="forms-sample">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __('cruds.testimonial.fields.name')}}</label>
                <input type="text" class="form-control" wire:model.defer="name" placeholder="{{ __('cruds.testimonial.fields.name')}}">
                @error('name') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __('cruds.testimonial.fields.designation')}}</label>
                <input type="text" class="form-control" wire:model.defer="designation" placeholder="{{ __('cruds.testimonial.fields.designation')}}">
                @error('designation') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>{{ __('cruds.testimonial.fields.description')}}</label>
                <textarea class="form-control" wire:model.defer="description" rows="4"></textarea>
                @error('description') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-group">
                    <label class="toggle-switch float-right">
                        <input type="checkbox" class="toggleSwitch" value="{{ $status }}" {{ $status ==1 ? 'checked' : '' }}>
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
    <button wire:click.prevent="cancel" class="btn btn-light">
        {{ __('global.cancel')}}
        <span wire:loading wire:target="cancel">
            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
        </span>
    </button>
</form>
               