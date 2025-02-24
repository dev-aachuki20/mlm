
<h4 class="card-title">
    View
    {{ strtolower(__('cruds.testimonial.title_singular'))}}</h4>


    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.testimonial.fields.image')}}</label>
        <div class="col-sm-9 col-form-label">
             <img class="rounded img-thumbnail" src="{{ $details->image_url ? $details->image_url : asset(config('constants.default_user_logo')) }}" width="100px"/>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.testimonial.fields.name')}}</label>
        <div class="col-sm-9 col-form-label">
             {{ ucwords($details->name) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.testimonial.fields.description')}}</label>
        <div class="col-sm-9 col-form-label">
            {!! $details->description !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.testimonial.fields.rating')}}</label>
        <div class="col-sm-9 col-form-label d-flex">
            @php
                $rating = (int)$details->rating;
            @endphp
            @for($i=1; $i<=5; $i++)
                @if($i <= $rating)
                <img src="{{ asset('images/Star.svg') }}">
                @else
                <img src="{{ asset('images/Star-Border.svg') }}">
                @endif
            @endfor
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

               