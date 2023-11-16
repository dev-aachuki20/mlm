
<h4 class="card-title">
    View
    {{ strtolower(__('cruds.section.title_singular'))}}</h4>


    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.section.fields.name')}}</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->name }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.section.fields.image1')}}</label>
        <div class="col-sm-9 col-form-label">
            @if($details->image1_url)
            <img class="rounded img-thumbnail" src="{{ $details->image1_url }}" width="100px"/>
            @else
            <img src="{{ asset(config('constants.default.no-image')) }}"  alt="no=image"  width="100px"/>
            @endif
       </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.section.fields.image2')}}</label>
        <div class="col-sm-9 col-form-label">
            @if($details->image2_url)
            <img class="rounded img-thumbnail" src="{{ $details->image2_url }}" width="100px"/>
            @else
            <img src="{{ asset(config('constants.default.no-image')) }}"  alt="no=image"  width="100px"/>
            @endif
       </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.section.fields.short_description')}}</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->short_description }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.section.fields.year_experience')}}</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->year_experience }}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.section.fields.features')}}</label>
        <div class="col-sm-9 col-form-label">
             {!! $details->features !!}
        </div>
    </div>


    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.section.fields.description')}}</label>
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

