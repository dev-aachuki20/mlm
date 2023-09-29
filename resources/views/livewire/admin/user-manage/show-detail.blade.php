 
<!-- Start Personal Information -->
<div class="card mb-4">
    <div class="card-header background-purple-color">
        <label class="font-weight-bold">Personal Details</label>
        @if($editButtonStatus['personal-detail'])
            <button class="btn btn-sm btn-primary mr-1 float-right" wire:click.prevent="editStepForm('personal-detail')">
                <i class="fa fa-edit pr-1"></i>{{__('global.edit')}}
            </button>
        @endif
    </div>
    <div class="card-body"> 
        @if($editMode && $formType == 'personal-detail')
            <form wire:submit.prevent="update">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-bold justify-content-start">{{ __('cruds.user.fields.first_name') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                            <input type="text" class="form-control" wire:model.defer="first_name" placeholder="{{ __('cruds.user.fields.first_name') }}" />
                            @error('first_name') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-bold justify-content-start">{{ __('cruds.user.fields.last_name') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                            <input type="text" class="form-control" wire:model.defer="last_name" placeholder="{{ __('cruds.user.fields.last_name') }}" />
                            @error('last_name') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="font-weight-bold justify-content-start">{{ __('cruds.user.profile.gender') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                            <select wire:model.defer="gender" class="form-control">
                                <option value="">Select gender</option>
                                <option value="male" {{$gender == 'male' ? 'selected' : ''}}>Male</option>
                                <option value="female" {{$gender == 'female' ? 'selected' : ''}}>Female</option>
                                <option value="other" {{$gender == 'other' ? 'selected' : ''}}>Other</option>
                            </select>
                            @error('gender') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="font-weight-bold justify-content-start">{{ __('cruds.user.profile.marital_status') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                            <select wire:model.defer="marital_status" class="form-control">
                                <option value="">Select marital status</option>
                                <option value="married" {{$gender == 'married' ? 'selected' : ''}}>Married</option>
                                <option value="unmarried" {{$gender == 'unmarried' ? 'selected' : ''}}>Unmarried</option>
                            </select>
                            @error('marital_status') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="font-weight-bold justify-content-start">{{ __('cruds.user.fields.dob') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                            <input type="text" class="form-control" id="dob" wire:model.defer="dob" placeholder="{{ __('cruds.user.fields.dob') }}" autocomplete="off"/>
                            @error('dob') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                       
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-bold justify-content-start">{{ __('cruds.user.profile.guardian_name') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                            <input type="text" class="form-control" wire:model.defer="guardian_name" placeholder="{{ __('cruds.user.profile.guardian_name') }}"/>
                            @error('guardian_name') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-bold justify-content-start">{{ __('cruds.user.profile.profession') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                            <input type="text" class="form-control" wire:model.defer="profession" placeholder="{{ __('cruds.user.profile.profession') }}"/>
                            @error('profession') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="font-weight-bold justify-content-start">{{ __('cruds.user.profile.address') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                            <textarea class="form-control" wire:model.defer="address" rows="4"></textarea>
                            @error('address') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="font-weight-bold justify-content-start">{{ __('cruds.user.profile.state') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>                            
                            <select class="form-control select-state"  wire:model.defer="state" >
                                <option>Select State</option>
                                @foreach(config('indian-regions.states') as $id=>$stateName)
                                    <option value="{{$stateName}}" {{ucwords($state) == $stateName ? 'selected':''}} data-stateId="{{$id}}">{{ ucwords($stateName) }}</option>
                                @endforeach
                            </select> 
                            @error('state') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="font-weight-bold justify-content-start">{{ __('cruds.user.profile.city') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                            <select class="form-control select-city" wire:model.defer="city" >
                                <option>Select City</option>                              
                                    @if($allCities)
                                    @foreach($allCities as $cityName)
                                        <option value="{{$cityName}}" {{ucwords($city) == $cityName ? 'selected':''}}>{{ ucwords($cityName) }}</option>
                                    @endforeach
                                  
                                    @endif
                            </select>
                            @error('city') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="font-weight-bold justify-content-start">{{ __('cruds.user.profile.pin_code') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                            <input type="text" class="form-control" wire:model.defer="pin_code" placeholder="{{ __('cruds.user.profile.pin_code') }}"/>
                            @error('pin_code') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>


                <div class="text-right mt-3">
                    <button class="btn btn-secondary" wire:click.prevent="cancelStepForm" wire:loading.attr="disabled">
                        {{ __('global.cancel') }}     
                         <span wire:loading wire:target="cancelStepForm">
                             <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                         </span>
                     </button>
                    <button class="btn btn-success" type="submit" wire:loading.attr="disabled">
                       {{ __('global.update') }}     
                        <span wire:loading wire:target="update">
                            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
            </form>
        @else
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
        @endif
        
    </div>
</div>
<!-- End Personal Information -->

<!-- Start Nominee Information -->
<div class="card mb-4">
    <div class="card-header background-purple-color">
        <label class="font-weight-bold">Nominee Information</label>
        @if($editButtonStatus['nominee-detail'])
        <button class="btn btn-sm btn-primary mr-1 float-right" wire:click.prevent="editStepForm('nominee-detail')">
            <i class="fa fa-edit pr-1"></i>{{__('global.edit')}}
        </button>
        @endif
    </div>
    <div class="card-body">
        @if($editMode && $formType == 'nominee-detail')
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="font-weight-bold justify-content-start">{{ __('cruds.user.profile.nominee_name') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                        <input type="text" class="form-control" wire:model.defer="nominee_name" placeholder="{{ __('cruds.user.profile.nominee_name') }}"/>
                        @error('nominee_name') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="font-weight-bold justify-content-start">{{ __('cruds.user.profile.nominee_dob') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                        <input type="text" class="form-control" id="nominee_dob" wire:model.defer="nominee_dob" placeholder="{{ __('cruds.user.profile.nominee_dob') }}" autocomplete="off"/>
                        @error('nominee_dob') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="font-weight-bold justify-content-start">{{ __('cruds.user.profile.nominee_relation') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                        <input type="text" class="form-control" wire:model.defer="nominee_relation" placeholder="{{ __('cruds.user.profile.nominee_relation') }}"/>
                        @error('nominee_relation') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="text-right mt-3">
                <button class="btn btn-secondary" wire:click.prevent="cancelStepForm" wire:loading.attr="disabled">
                    {{ __('global.cancel') }}     
                     <span wire:loading wire:target="cancelStepForm">
                         <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                     </span>
                 </button>
                <button class="btn btn-success" type="submit" wire:loading.attr="disabled">
                   {{ __('global.update') }}     
                    <span wire:loading wire:target="update">
                        <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                    </span>
                </button>
            </div>
        </form>
        @else
        <div class="row">
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.profile.nominee_name') }}</label> : 
                <span class="p-2">  {{ $detail->profile->nominee_name ?? '' }}</span>
            </div>
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.profile.nominee_dob') }}</label> : 
                <span class="p-2">  {{ $detail->profile->nominee_dob ? convertDateTimeFormat($detail->profile->nominee_dob,'date') : '' }}</span>
            </div>
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.profile.nominee_relation') }}</label> : 
                <span class="p-2"> {{ $detail->profile->nominee_relation ?? '' }}</span>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- End Nominee Information -->

<!-- Start KYC Information -->
<div class="card mb-4">
    <div class="card-header background-purple-color">
        <label class="font-weight-bold">KYC  Information</label>
        @if($editButtonStatus['kyc-detail'])
        <button class="btn btn-sm btn-primary mr-1 float-right" wire:click.prevent="editStepForm('kyc-detail')">
            <i class="fa fa-edit pr-1"></i>{{__('global.edit')}}
        </button>
        @endif
    </div>
    <div class="card-body">
        @if($editMode && $formType == 'kyc-detail')
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold justify-content-start">{{ __('cruds.user.kyc.account_holder_name') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                        <input type="text" class="form-control" wire:model.defer="account_holder_name" placeholder="{{ __('cruds.user.kyc.account_holder_name') }}"/>
                        @error('account_holder_name') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold justify-content-start">{{ __('cruds.user.kyc.account_number') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                        <input type="text" class="form-control" wire:model.defer="account_number" placeholder="{{ __('cruds.user.kyc.account_number') }}"/>
                        @error('account_number') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold justify-content-start">{{ __('cruds.user.kyc.bank_name') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                        <input type="text" class="form-control" wire:model.defer="bank_name" placeholder="{{ __('cruds.user.kyc.bank_name') }}"/>
                        @error('bank_name') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold justify-content-start">{{ __('cruds.user.kyc.branch_name') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                        <input type="text" class="form-control" wire:model.defer="branch_name" placeholder="{{ __('cruds.user.kyc.branch_name') }}"/>
                        @error('branch_name') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="font-weight-bold justify-content-start">{{ __('cruds.user.kyc.ifsc_code') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                        <input type="text" class="form-control" wire:model.defer="ifsc_code" placeholder="{{ __('cruds.user.kyc.ifsc_code') }}"/>
                        @error('ifsc_code') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold justify-content-start">{{ __('cruds.user.kyc.aadhar_card_name') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                        <input type="text" class="form-control" wire:model.defer="aadhar_card_name" placeholder="{{ __('cruds.user.kyc.aadhar_card_name') }}"/>
                        @error('aadhar_card_name') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold justify-content-start">{{ __('cruds.user.kyc.aadhar_card_number') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                        <input type="text" class="form-control" wire:model.defer="aadhar_card_number" placeholder="{{ __('cruds.user.kyc.aadhar_card_number') }}"/>
                        @error('aadhar_card_number') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold justify-content-start">{{ __('cruds.user.kyc.pan_card_name') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                        <input type="text" class="form-control" wire:model.defer="pan_card_name" placeholder="{{ __('cruds.user.kyc.pan_card_name') }}"/>
                        @error('pan_card_name') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold justify-content-start">{{ __('cruds.user.kyc.pan_card_number') }}<i class="fa-asterisk" style="color: #e14119;"></i></label>
                        <input type="text" class="form-control" wire:model.defer="pan_card_number" placeholder="{{ __('cruds.user.kyc.pan_card_number') }}"/>
                        @error('pan_card_number') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="text-right mt-3">
                <button class="btn btn-secondary" wire:click.prevent="cancelStepForm" wire:loading.attr="disabled">
                    {{ __('global.cancel') }}     
                     <span wire:loading wire:target="cancelStepForm">
                         <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                     </span>
                 </button>
                <button class="btn btn-success" type="submit" wire:loading.attr="disabled">
                   {{ __('global.update') }}     
                    <span wire:loading wire:target="update">
                        <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                    </span>
                </button>
            </div>
        </form>
        @else
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
        @endif
    </div>
</div>
<!-- End KYC Information -->

<!-- Start Sponsor Information -->
<div class="card mb-4">
    <div class="card-header background-purple-color">
        <label class="font-weight-bold">Sponsor Information</label>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <label class="font-weight-bold">{{ __('cruds.user.fields.referral_code') }}</label> : 
                <span class="p-2">  {{ $detail->referral_code ?? '' }}</span>
            </div>
            <div class="col-sm-6">
                <label class="font-weight-bold">{{ __('cruds.user.fields.referral_name') }}</label> : 
                <span class="p-2">  {{ ucwords($detail->referral_name) ?? '' }}</span>
            </div>
        </div>
    </div>
</div>
<!-- End Sponsor Information -->
