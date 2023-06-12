
<h4 class="card-title">
    {{__('global.show')}}
    {{ strtolower(__('cruds.setting.title_singular'))}}</h4>


    @if($detail->type == 'logo')
    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Logo</label>
        <div class="col-sm-9 col-form-label">
             <img class="rounded img-thumbnail" src="{{ $detail->image_url }}" width="100px"/>
        </div>
    </div>
    @endif

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.setting.fields.key')}}</label>
        <div class="col-sm-9 col-form-label">
             {{ $detail->key }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.setting.fields.type')}}</label>
        <div class="col-sm-9 col-form-label">
             {{ $detail->type }}
        </div>
    </div>

    @if(!empty($detail->value))
    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.setting.fields.value')}}</label>
        <div class="col-sm-9 col-form-label">
             {!! $detail->value !!}
        </div>
    </div>
    @endif

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Status</label>
        <div class="col-sm-9 col-form-label">
             @if($detail->status)
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

               