
<h4 class="card-title">
    {{ $updateMode ? __('global.edit') : __('global.create') }} 
    {{ strtolower(__('cruds.package.title_singular'))}}</h4>

<form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="forms-sample">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.package.fields.title')}}</label>
                <input type="text" class="form-control" wire:model.defer="title" placeholder="{{ __('cruds.package.fields.title')}}">
                @error('title') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.package.fields.amount')}}</label>
                <input type="number" class="form-control" wire:model.defer="amount" placeholder="{{ __('cruds.package.fields.amount')}}" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Period','NumpadDecimal'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"  min="0" step=".01" autocomplete="off">
                @error('amount') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.package.fields.sub_title')}}</label>
                <input type="text" class="form-control" wire:model.defer="sub_title" placeholder="{{ __('cruds.package.fields.sub_title')}}">
                @error('sub_title') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.package.fields.duration')}}</label>
                <input type="text" class="form-control" id="duration" wire:model.defer="duration" placeholder="{{ __('cruds.package.fields.duration')}}" autocomplete="off">
                @error('duration') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold">{{ __('cruds.package.fields.level')}}</label>
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

    <p class="card-description">{{ __('cruds.package.fields.commission')}}</p>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.package.fields.level_one_commission')}}</label>
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
                <label class="font-weight-bold">{{ __('cruds.package.fields.features')}}</label>
                <textarea class="form-control" id="summernote-features" wire:model.defer="features" rows="10"></textarea>
            </div>
            @error('features') <span class="error text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold">{{ __('cruds.package.fields.description')}}</label>
                <textarea class="form-control" id="summernote" wire:model.defer="description" rows="10"></textarea>
            </div>
            @error('description') <span class="error text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold">{{ __('cruds.package.fields.image')}}</label>
                <input type="file"  wire:model.defer="image" class="dropify" data-default-file="{{ $originalImage }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" data-min-file-size-preview="1M" data-max-file-size-preview="3M" accept="image/jpeg, image/png, image/jpg,image/svg">
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
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold">Video</label> 

                @if($updateMode)
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#videoModal">
                Preview
                </button>
                @endif

                <input type="file"  wire:model.defer="video" class="dropify" data-default-file="{{ $originalVideo }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="webm mp4 avi wmv flv mov" data-min-file-size-preview="1M" data-max-file-size-preview="3M" accept="video/webm, video/mp4, video/avi,video/wmv,video/flv,video/mov">
                <span wire:loading wire:target="video">
                    <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Loading
                </span>
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

@if($updateMode)
    @include('livewire.admin.partials.includes.preview-video')
@endif