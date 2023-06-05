
<h4 class="card-title">
    {{__('global.show')}}
    {{ strtolower(__('cruds.package.title_singular'))}}</h4>


    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.package.fields.image')}}</label>
        <div class="col-sm-9">
             <img class="rounded img-thumbnail" src="{{ $details->image_url }}" width="100px"/>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.package.fields.title')}}</label>
        <div class="col-sm-9">
             {{ $details->title }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.package.fields.amount')}}</label>
        <div class="col-sm-9">
            <i class="fa-solid fa-indian-rupee-sign"></i>  {{ number_format($details->amount,2) }}
        </div>
    </div>

    <p class="card-description">{{ __('cruds.package.fields.commission')}}</p>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.package.fields.level_one_commission')}}</label>
        <div class="col-sm-9">
            <i class="fa-solid fa-indian-rupee-sign"></i>  {{ number_format($details->level_one_commission,2) }}
        </div>
    </div>


    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.package.fields.level_two_commission')}}</label>
        <div class="col-sm-9">
            <i class="fa-solid fa-indian-rupee-sign"></i>  {{ number_format($details->level_two_commission,2) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.package.fields.level_three_commission')}}</label>
        <div class="col-sm-9">
            <i class="fa-solid fa-indian-rupee-sign"></i>  {{ number_format($details->level_three_commission,2) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.package.fields.description')}}</label>
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

               