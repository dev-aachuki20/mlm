
    <h4 class="card-title">
        View
        {{ strtolower(__('cruds.slider.title_singular'))}}
    </h4>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.slider.fields.image')}}</label>
        <div class="col-sm-9 col-form-label">
             <img class="rounded img-thumbnail" src="{{ $details->image_url }}" width="100px"/>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.slider.fields.name')}}</label>
        <div class="col-sm-9 col-form-label">
             {{ ucfirst($details->name) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.slider.fields.type')}}</label>
        <div class="col-sm-9 col-form-label">
             {{ ucfirst($details->type) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Status</label>
        <div class="col-sm-9 col-form-label">
             @if($details->status)
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

               