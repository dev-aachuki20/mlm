
<h4 class="card-title">
    View
    {{ strtolower(__('cruds.service.title_singular'))}}</h4>


    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.service.fields.title')}}</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->title }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.service.fields.image')}}</label>
        <div class="col-sm-9 col-form-label">
            @if($details->image_url)
            <img class="rounded img-thumbnail" src="{{ $details->image_url }}" width="100px"/>
            @else
            <img src="{{ asset(config('constants.default.no-image')) }}"  alt="no=image"  width="100px"/>
            @endif
       </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.service.fields.sub_title')}}</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->sub_title }}
        </div>
    </div>


    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.service.fields.description')}}</label>
        <div class="col-sm-9 col-form-label">
            {!! $details->description !!}
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

