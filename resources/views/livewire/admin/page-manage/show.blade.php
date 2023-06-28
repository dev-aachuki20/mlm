
<h4 class="card-title">
    {{__('global.show')}}
    {{ strtolower(__('cruds.page.title_singular'))}}</h4>


    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.page.fields.title') }}</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->title }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.page.fields.sub_title') }}</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->sub_title }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.page.fields.slider_image')}}</label>
        <div class="col-sm-9 col-form-label">
             <img class="rounded img-thumbnail" src="{{ $details->slider_image_url ? $details->slider_image_url : asset(config('constants.no_image_url')) }}" width="200px"/>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.page.fields.type') }}</label>
        <div class="col-sm-9 col-form-label">
             {{ ucwords(config('constants.page_types')[$details->type]) }}
        </div>
    </div>

   {{-- <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.page.fields.template_name') }}</label>
        <div class="col-sm-9">
             {{ $details->template_name }}
        </div>
    </div>
   --}}
   
    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.page.fields.description') }}</label>
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

               