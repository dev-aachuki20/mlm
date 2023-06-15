 


<!-- Start Personal Information -->
<div class="card mb-4">
    <div class="card-header background-purple-color">
        <label class="font-weight-bold">Personal Details</label>
        <button class="btn btn-sm btn-primary mr-1 float-right" wire:click.prevent="editStepForm('personal-detail')">
            <i class="fa fa-edit pr-1"></i>{{__('global.edit')}}
        </button>
    </div>
    <div class="card-body">          
        <div class="row">
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.fields.name') }}</label> : 
                <span class="p-2">{{ ucfirst($detail->first_name) }} {{ ucfirst($detail->last_name) }}</span>
            </div>
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.fields.email') }}</label> : 
                <span class="p-2">{{ $detail->email }}</span>
            </div>
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.fields.phone') }}</label> : 
                <span class="p-2">{{ $detail->phone }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.profile.gender') }}</label> : 
                <span class="p-2">{{ $detail->profile->gender ?? '' }}</span>
            </div>
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.profile.marital_status') }}</label> : 
                <span class="p-2">{{ $detail->profile->marital_status ?? '' }}</span>
            </div>
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.fields.dob') }}</label> : 
                <span class="p-2">{{ convertDateTimeFormat($detail->dob,'date') }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.profile.guardian_name') }}</label> : 
                <span class="p-2">{{ $detail->profile->guardian_name ?? '' }}</span>
            </div>
        
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.profile.profession') }}</label> : 
                <span class="p-2">{{ $detail->profile->profession ?? '' }}</span>
            </div>

            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.fields.date_of_join') }}</label> : 
                <span class="p-2"> {{ convertDateTimeFormat($detail->date_of_join,'date') }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <label class="font-weight-bold">{{ __('cruds.user.profile.address') }}</label> : 
                <span class="p-2"> {{ $detail->profile->address ?? '' }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.profile.city') }}</label> : 
                <span class="p-2"> {{ $detail->profile->city ?? '' }}</span>
            </div>
        
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.profile.state') }}</label> : 
                <span class="p-2"> {{ $detail->profile->state ?? '' }}</span>
            </div>

            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.profile.pin_code') }}</label> : 
                <span class="p-2"> {{ $detail->profile->pin_code ?? '' }}</span>
            </div>
        </div>
    </div>
</div>
<!-- End Personal Information -->

<!-- Start Nominee Information -->
<div class="card mb-4">
    <div class="card-header background-purple-color">
        <label class="font-weight-bold">Nominee Information</label>
        <button class="btn btn-sm btn-primary mr-1 float-right" wire:click.prevent="editStepForm('nominee-detail')">
            <i class="fa fa-edit pr-1"></i>{{__('global.edit')}}
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.profile.nominee_name') }}</label> : 
                <span class="p-2">  {{ $detail->profile->nominee_name ?? '' }}</span>
            </div>
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.profile.nominee_dob') }}</label> : 
                <span class="p-2">  {{ convertDateTimeFormat($detail->profile->nominee_dob,'date') }}</span>
            </div>
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.profile.nominee_relation') }}</label> : 
                <span class="p-2"> {{ $detail->profile->nominee_relation ?? '' }}</span>
            </div>
        </div>
    </div>
</div>
<!-- End Nominee Information -->

<!-- Start KYC Information -->
<div class="card mb-4">
    <div class="card-header background-purple-color">
        <label class="font-weight-bold">KYC  Information</label>
        <button class="btn btn-sm btn-primary mr-1 float-right" wire:click.prevent="editStepForm('kyc-detail')">
            <i class="fa fa-edit pr-1"></i>{{__('global.edit')}}
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <label class="font-weight-bold">{{ __('cruds.user.kyc.account_holder_name') }}</label> : 
                <span class="p-2">  {{ $detail->kycDetail->account_holder_name ?? '' }}</span>
            </div>
            <div class="col-sm-6">
                <label class="font-weight-bold">{{ __('cruds.user.kyc.account_number') }}</label> : 
                <span class="p-2">  {{ $detail->kycDetail->account_number ?? '' }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label class="font-weight-bold">{{ __('cruds.user.kyc.bank_name') }}</label> : 
                <span class="p-2">  {{ $detail->kycDetail->bank_name ?? '' }}</span>
            </div>
            <div class="col-sm-6">
                <label class="font-weight-bold">{{ __('cruds.user.kyc.branch_name') }}</label> : 
                <span class="p-2">  {{ $detail->kycDetail->branch_name ?? '' }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <label class="font-weight-bold">{{ __('cruds.user.kyc.ifsc_code') }}</label> : 
                <span class="p-2">  {{ $detail->kycDetail->ifsc_code ?? '' }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label class="font-weight-bold">{{ __('cruds.user.kyc.aadhar_card_name') }}</label> : 
                <span class="p-2">  {{ $detail->kycDetail->aadhar_card_name ?? '' }}</span>
            </div>
            <div class="col-sm-6">
                <label class="font-weight-bold">{{ __('cruds.user.kyc.aadhar_card_number') }}</label> : 
                <span class="p-2">  {{ $detail->kycDetail->aadhar_card_number ?? '' }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label class="font-weight-bold">{{ __('cruds.user.kyc.pan_card_name') }}</label> : 
                <span class="p-2">  {{ $detail->kycDetail->pan_card_name ?? '' }}</span>
            </div>
            <div class="col-sm-6">
                <label class="font-weight-bold">{{ __('cruds.user.kyc.pan_card_number') }}</label> : 
                <span class="p-2">  {{ $detail->kycDetail->pan_card_number ?? '' }}</span>
            </div>
        </div>
    </div>
</div>
<!-- End KYC Information -->

<!-- Start Sponsor Information -->
<div class="card mb-4">
    <div class="card-header background-purple-color">
        Sponsor Information
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <label class="font-weight-bold">{{ __('cruds.user.fields.referral_code') }}</label> : 
                <span class="p-2">  {{ $detail->referral_code ?? '' }}</span>
            </div>
            <div class="col-sm-6">
                <label class="font-weight-bold">{{ __('cruds.user.fields.referral_name') }}</label> : 
                <span class="p-2">  {{ $detail->referral_name ?? '' }}</span>
            </div>
        </div>
    </div>
</div>
<!-- End Sponsor Information -->
