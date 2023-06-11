
<h4 class="card-title">
    {{__('global.show')}}
    {{ strtolower(__('cruds.page.title_singular'))}}</h4>


    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.page.fields.title') }}</label>
        <div class="col-sm-9">
             {{ $details->title }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.page.fields.template_name') }}</label>
        <div class="col-sm-9">
             {{ $details->template_name }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.page.fields.description') }}</label>
        <div class="col-sm-9">
             {!! $details->description !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Status</label>
        <div class="col-sm-9">
             @if($details->status)
                <div class="badge badge-success">Active</div>
             @else
                <div class="badge badge-success">Inactive</div>
             @endif
             
        </div>
    </div>

    <button wire:click.prevent="cancel" class="btn btn-secondary">
        {{ __('global.cancel')}}
        <span wire:loading wire:target="cancel">
            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
        </span>
    </button>

               