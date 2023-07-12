
<h4 class="card-title">
    {{ $updateMode ? __('global.edit') : __('global.create') }} 
    {{ strtolower(__('cruds.team.title_singular'))}}</h4>

<form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="forms-sample">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold justify-content-start">{{ __('cruds.team.fields.first_name')}} <i class="fas fa-asterisk"></i></label>
                <input type="text" class="form-control" wire:model.defer="first_name" placeholder="{{ __('cruds.team.fields.first_name')}}">
                @error('first_name') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold justify-content-start">{{ __('cruds.team.fields.last_name')}}<i class="fas fa-asterisk"></i></label>
                <input type="text" class="form-control" wire:model.defer="last_name" placeholder="{{ __('cruds.team.fields.last_name')}}">
                @error('last_name') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold justify-content-start">{{ __('cruds.team.fields.email')}}<i class="fas fa-asterisk"></i></label>
                <input type="email" class="form-control" wire:model='email' wire:change="checkEmail" placeholder="Email"  {{$updateMode ? 'disabled':''}}/>

                @error('email') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold justify-content-start">{{ __('cruds.team.fields.phone_number')}}<i class="fas fa-asterisk"></i></label>
                <input type="number" class="form-control" wire:model.defer="phone" placeholder="Phone Number" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space' && this.value.length < 10 " step="1"  autocomplete="off" />

                @error('phone') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    {{--
    @if(!$updateMode)
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.team.fields.password')}}</label>
                <div class="input-group show_hide_password" id="show_hide_password">
                    <input type="password" class="form-control" wire:model.defer="password" id="password"  autocomplete="off">
                    <div class="input-group-addon">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </div>
                </div>
                @error('password') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('cruds.team.fields.password_confirmation')}}</label>
                <div class="input-group show_hide_password" id="show_hide_password">
                    <input  type="password" wire:model.defer="password_confirmation" class="form-control" id="password_confirmation" autocomplete="off">
                    <div class="input-group-addon">
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </div>
                </div>   
                @error('password_confirmation') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
    @endif
    --}}
    
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-group mb-0" wire:ignore>
                <label class="font-weight-bold justify-content-start">{{ __('cruds.team.fields.profile_image')}}<i class="fas fa-asterisk"></i></label>
                <input type="file" id="dropify-image"  wire:model.defer="profile_image" class="dropify" data-default-file="{{ $originalImage }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" data-min-file-size-preview="1M" data-max-file-size-preview="3M" accept="image/jpeg, image/png, image/jpg,image/svg">
                <span wire:loading wire:target="profile_image">
                    <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Loading
                </span>
            </div>
            @if($errors->has('profile_image'))
            <span class="error text-danger">
                {{ $errors->first('profile_image') }}
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
        <span wire:loading wire:target="{{$updateMode ? 'update': 'store'}}">
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
