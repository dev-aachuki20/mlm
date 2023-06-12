 
 <h4 class="card-title">
   {{__('global.show') }}
    {{ strtolower(__('cruds.user.title_singular'))}}</h4>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.fields.name') }}</label>
        <div class="col-sm-9">
        {{ ucfirst($detail->first_name) }} {{ ucfirst($detail->last_name) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.fields.email') }}</label>
        <div class="col-sm-9">
            {{ $detail->email }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.fields.phone') }}</label>
        <div class="col-sm-9">
        {{ $detail->phone }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.gender') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->gender ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.marital_status') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->marital_status ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.fields.dob') }}</label>
        <div class="col-sm-9">
        {{ convertDateTimeFormat($detail->dob,'date') }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.guardian_name') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->guardian_name ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.profession') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->profession ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.address') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->address ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.city') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->city ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.state') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->state ?? '' }}
        </div>
    </div>
 
    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.pin_code') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->pin_code ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.fields.referral_code') }}</label>
        <div class="col-sm-9">
        {{ $detail->referral_code ?? '' }}
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.fields.referral_name') }}</label>
        <div class="col-sm-9">
        {{ $detail->referral_name ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.fields.date_of_join') }}</label>
        <div class="col-sm-9">
        {{ convertDateTimeFormat($detail->date_of_join,'date') }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.fields.date_of_join') }}</label>
        <div class="col-sm-9">
        {{ convertDateTimeFormat($detail->date_of_join,'date') }}
        </div>
    </div>

    <p class="mb-4">Nominee Details</p>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.nominee_name') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->nominee_name ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.nominee_dob') }}</label>
        <div class="col-sm-9">
        {{ convertDateTimeFormat($detail->profile->nominee_dob,'date') }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.nominee_relation') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->nominee_relation ?? '' }}
        </div>
    </div>
 
    <!-- Start nominee details -->
    <p class="mb-4">Bank Details</p>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.bank_name') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->bank_name ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.branch_name') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->branch_name ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.account_number') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->account_number ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.ifsc_code') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->ifsc_code ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.user.profile.pan_card_number') }}</label>
        <div class="col-sm-9">
        {{ $detail->profile->pan_card_number ?? '' }}
        </div>
    </div>

<div class="mt-3">
    <button class="btn btn-secondary" wire:loading.attr="disabled" wire:click.prevent="cancel">
        {{ __('global.cancel')}}
        <span wire:loading wire:target="cancel">
            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
        </span>
    </button>
</div>
