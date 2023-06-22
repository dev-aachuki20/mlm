
<h4 class="card-title">
    {{ $updateMode ? __('global.edit') : __('global.create') }} 
    {{ strtolower(__('cruds.setting.title_singular'))}}</h4>

<form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="forms-sample">
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.setting.fields.key')}}</label>
                <input type="text" class="form-control" wire:model.defer="key" placeholder="{{ __('cruds.setting.fields.key')}}" autocomplete="off" disabled>
                @error('key') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.setting.fields.type')}}</label>
                <select  wire:model.defer="type" class="form-control section-type">
                    <option value="">Select type</option>
                    @php
                      $allType = config('constants.setting_types');
                    @endphp
                    @if(count($allType) > 0)
                      @foreach($allType as $valType)
                        <option value="{{ $valType }}" {{$valType == $type ? 'selected' : ''}}>{{ ucfirst($valType) }}</option>
                      @endforeach
                    @endif
                </select>
                @error('type') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="row logo-section {{ $type == 'logo' ? '':'d-none'}}">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold">Logo</label>
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

    <div class="row logo-section {{ $type == 'video' ? '':'d-none'}}">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold">Video</label>
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

    
    <div class="row value-section {{ $type != 'logo' && $type != 'video' ? '':'d-none'}}">
        <div class="col-md-12">
            <div class="form-group ">
                <label class="font-weight-bold">{{ __('cruds.setting.fields.value')}}</label>
                <input class="form-control"  wire:model.defer="value">
                @error('value') <span class="error text-danger">{{ $message }}</span>@enderror
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
                @error('status') <span class="error text-danger">{{ $message }}</span>@enderror
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
               