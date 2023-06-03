
<h4 class="card-title">
    {{ $updateMode ? __('global.edit') : __('global.create') }} 
    {{ strtolower(__('cruds.package.title_singular'))}}</h4>

<form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="forms-sample">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __('cruds.package.fields.title')}}</label>
                <input type="text" class="form-control" wire:model.defer="title" placeholder="{{ __('cruds.package.fields.title')}}">
                @error('title') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __('cruds.package.fields.amount')}}</label>
                <input type="number" class="form-control" wire:model.defer="amount" placeholder="{{ __('cruds.package.fields.amount')}}" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Period','NumpadDecimal'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"  min="0" step=".01" autocomplete="off">
                @error('amount') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <p class="card-description">{{ __('cruds.package.fields.commission')}}</p>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __('cruds.package.fields.level_one_commission')}}</label>
                <input type="number" class="form-control" wire:model.defer="level_one_commission" placeholder="{{ __('cruds.package.fields.level_one_commission')}} commission" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Period','NumpadDecimal'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"  min="0" step=".01" autocomplete="off">
                @error('level_one_commission') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __('cruds.package.fields.level_two_commission')}}</label>
                <input type="number" class="form-control" wire:model.defer="level_two_commission" placeholder="{{ __('cruds.package.fields.level_two_commission')}} commission" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Period','NumpadDecimal'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"  min="0" step=".01" autocomplete="off">
                @error('level_two_commission') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __('cruds.package.fields.level_three_commission')}}</label>
                <input type="number" class="form-control" wire:model.defer="level_three_commission" placeholder="{{ __('cruds.package.fields.level_three_commission')}} commission" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Period','NumpadDecimal'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"  min="0" step=".01" autocomplete="off">
                @error('level_three_commission') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>{{ __('cruds.package.fields.description')}}</label>
                <textarea class="form-control" id="summernote" wire:model.defer="description" rows="4"></textarea>
            </div>
            @error('description') <div class="error text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-0">
                <label>{{ __('cruds.package.fields.logo')}}</label>
                <input type="file"  wire:model.defer="package_logo" class="dropify" data-default-file="{{ $package_logo }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" data-min-file-size-preview="1M" data-max-file-size-preview="3M" accept="image/jpeg, image/png, image/jpg,image/svg">
            </div>
            @if($errors->has('package_logo'))
            <span class="error text-danger">
                {{ $errors->first('package_logo') }}
            </span>
            @endif
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