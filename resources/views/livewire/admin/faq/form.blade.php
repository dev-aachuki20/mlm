
<h4 class="card-title">
    {{ $updateMode ? __('global.edit') : __('global.create') }} 
    {{ strtolower(__('cruds.faq.title_singular'))}}</h4>

<form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="forms-sample">
    
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>{{ __('cruds.faq.fields.question')}}</label>
                <textarea class="form-control" wire:model.defer="question" rows="4"></textarea>
                @error('question') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>{{ __('cruds.faq.fields.answer')}}</label>
                <textarea class="form-control" wire:model.defer="answer" rows="4"></textarea>
                @error('answer') <span class="error text-danger">{{ $message }}</span>@enderror
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
               