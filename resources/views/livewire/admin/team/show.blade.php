
<h4 class="card-title">
    {{__('global.show')}}
    {{ strtolower(__('cruds.package.title_singular'))}}</h4>


    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.team.fields.profile_image')}}</label>
        <div class="col-sm-9 col-form-label">
             <img class="rounded img-thumbnail" src="{{ $details->profile_image_url }}" width="100px"/>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.team.fields.name')}}</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->name }}
        </div>
    </div>
    

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.team.fields.email')}}</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->email }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.team.fields.phone_number')}}</label>
        <div class="col-sm-9 col-form-label">
              {{ $details->phone }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Role</label>
        <div class="col-sm-9 col-form-label">
              {{ $details->roles()->first()->title }}
        </div>
    </div>

    
    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Status</label>
        <div class="col-sm-9 col-form-label">
             @if($details->is_active)
                <div class="badge badge-success">Active</div>
             @else
                <div class="badge badge-danger">Inactive</div>
             @endif
             
        </div>
    </div>

    <button wire:click.prevent="cancel" class="btn btn-secondary">
        {{ __('global.cancel')}}
        <span wire:loading wire:target="cancel">
            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
        </span>
    </button>

               