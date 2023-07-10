<form wire:submit.prevent="updateProfile">
    @if($activeTab == 'user-tab')
      <div class="row">
        <div class="col-lg-6 col-sm-12">
          <div class="form-outer">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">First Name<span>:</span></label>
              <div class="col-sm-8">
                <input type="text" class="form-control" wire:model.defer="first_name" placeholder="First Name">
                @error('first_name') <span class="error text-danger">{{ $message }}</span>@enderror
              </div>
              
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Contact Number  <span>:</span></label>
              <div class="col-sm-8">
                <input type="text" class="form-control" wire:model.defer="phone"  onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space' && this.value.length < 10 " step="1"  autocomplete="off">
                @error('phone') <span class="error text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-sm-12">
          <div class="form-outer">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Last Name<span>:</span></label>
              <div class="col-sm-8">
                <input type="text" class="form-control" wire:model.defer="last_name" placeholder="Last Name">
                @error('last_name') <span class="error text-danger">{{ $message }}</span>@enderror
              </div>
              
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">DOB  <span>:</span></label>
              <div class="col-sm-8">                                  
                <div class="input-group date" id="datepicker">
                  <input type="text" placeholder="dd/mm/yyyy" class="form-control" value="{{ $authUser->dob ? convertDateTimeFormat($authUser->dob,'date') :'' }}" wire:model.defer="dob"  id="dob" />
                    <span class="input-group-append">
                    </span>
                </div>
                @error('dob') <span class="error text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
          
          </div>
        </div>

      </div>
    @endif

    @if($activeTab == 'profile-tab')
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="form-outer">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Gender<span>:</span></label>
                <div class="col-sm-8">
                    <select wire:model.defer="gender" class="form-control">
                        <option value="">Select gender</option>
                        <option value="male" {{$gender == 'male' ? 'selected' : ''}}>Male</option>
                        <option value="female" {{$gender == 'female' ? 'selected' : ''}}>Female</option>
                        <option value="other" {{$gender == 'other' ? 'selected' : ''}}>Other</option>
                    </select>
                    @error('gender') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Profession <span>:</span></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" wire:model.defer="profession" placeholder="{{ __('cruds.user.profile.profession') }}"/>
                    @error('profession') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Martial Status  <span>:</span></label>
                <div class="col-sm-8">
                    <select wire:model.defer="marital_status" class="form-control">
                        <option value="">Select marital status</option>
                        <option value="married" {{$gender == 'married' ? 'selected' : ''}}>Married</option>
                        <option value="unmarried" {{$gender == 'unmarried' ? 'selected' : ''}}>Unmarried</option>
                    </select>
                    @error('marital_status') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Address  <span>:</span></label>
                <div class="col-sm-8">
                    <textarea class="form-control" wire:model.defer="address" rows="4"></textarea>
                    @error('address') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">State  <span>:</span></label>
                <div class="col-sm-8" wire:ignore>
                    <select class="js-example-basic-single select-state w-100" wire:model.defer="state" >
                        <option>Select State</option>
                        @foreach(config('indian-regions.states') as $id=>$stateName)
                            <option value="{{$stateName}}" {{ucwords($state) == $stateName ? 'selected':''}} data-stateId="{{$id}}">{{ ucwords($stateName) }}</option>
                        @endforeach
                    </select>
                </div>
                @error('state') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">City  <span>:</span></label>
                <div class="col-sm-8">
                    <select class="js-example-basic-single select-city w-100" wire:model.defer="city" >
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
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Pin Code  <span>:</span></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" wire:model.defer="pin_code" placeholder="{{ __('cruds.user.profile.pin_code') }}"/>
                    @error('pin_code') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Father’s/Husband Name  <span>:</span></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" wire:model.defer="guardian_name" placeholder="Father’s/Husband Name"/>
                    @error('guardian_name') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="form-outer">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Nominee Name<span>:</span></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" wire:model.defer="nominee_name" placeholder="{{ __('cruds.user.profile.nominee_name') }}"/>
                    @error('nominee_name') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Nominee DOB <span>:</span></label>
                <div class="col-sm-8">
                <div class="input-group date" id="datepicker2">
                    <input type="text" class="form-control" id="nominee_dob" wire:model.defer="nominee_dob" placeholder="{{ __('cruds.user.profile.nominee_dob') }}"/>
                    @error('nominee_dob') <span class="error text-danger">{{ $message }}</span>@enderror
                    <span class="input-group-append">
                    </span>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Nominee Relation  <span>:</span></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" wire:model.defer="nominee_relation" placeholder="{{ __('cruds.user.profile.nominee_relation') }}"/>
                    @error('nominee_relation') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            </div>
        </div>
    </div>
    @endif
    
    <div class="pt-3 border-top">

        <button class="btn btn-secondary custom-btn w-auto mt-0 ml-auto" wire:loading.attr="disabled" wire:click.prevent="closedEditSection">
            {{ __('global.cancel')}}
            <span wire:loading wire:target="closedEditSection">
                <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
            </span>
        </button>

        <button class="btn btn-default custom-btn btn-save js-save w-auto mt-0 ml-auto" type="submit" wire:loading.attr="disabled">
            {{ __('global.update')}} Details
            <span wire:loading wire:target="updateProfile">
                <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
            </span>
        </button>
    
    </div>

{{-- 
 <!--Start row-1  -->
 <div class="row">
    
    @include('livewire.auth.profile.profile-image')

    <div class="col-lg-8">
        <div class="card mb-4">
        <div class="card-body">
            <div class="row">
           
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('cruds.user.fields.first_name') }}</label>
                        <input type="text" class="form-control" wire:model.defer="first_name" placeholder="{{ __('cruds.user.fields.first_name') }}" />
                        @error('first_name') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('cruds.user.fields.last_name') }}</label>
                        <input type="text" class="form-control" wire:model.defer="last_name" placeholder="{{ __('cruds.user.fields.last_name') }}"/>
                        @error('last_name') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

            </div>
           
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('cruds.user.fields.email') }}</label>
                        <input type="email" class="form-control" wire:model.defer="email" placeholder="{{ __('cruds.user.fields.email') }}" disabled/>
                        @error('email') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('cruds.user.fields.dob') }}</label>
                        <input type="text" class="form-control" id="dob" wire:model.defer="dob" placeholder="{{ __('cruds.user.fields.dob') }}" autocomplete="off"/>
                        @error('dob') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('cruds.user.fields.phone') }}</label>
                        <input type="text" class="form-control" wire:model.defer="phone" placeholder="{{ __('cruds.user.fields.phone') }}" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space' && this.value.length < 10 " step="1"  autocomplete="off"/>
                        @error('phone') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('cruds.user.profile.gender') }}</label>
                        <select wire:model.defer="gender" class="form-control">
                            <option value="">Select gender</option>
                            <option value="male" {{$gender == 'male' ? 'selected' : ''}}>Male</option>
                            <option value="female" {{$gender == 'female' ? 'selected' : ''}}>Female</option>
                            <option value="other" {{$gender == 'other' ? 'selected' : ''}}>Other</option>
                        </select>
                        @error('gender') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
    
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('cruds.user.profile.marital_status') }}</label>
                        <select wire:model.defer="marital_status" class="form-control">
                            <option value="">Select marital status</option>
                            <option value="married" {{$gender == 'married' ? 'selected' : ''}}>Married</option>
                            <option value="unmarried" {{$gender == 'unmarried' ? 'selected' : ''}}>Unmarried</option>
                        </select>
                        @error('marital_status') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-right mt-3">
                        <button class="btn btn-success" type="submit" wire:loading.attr="disabled">
                            {{ __('global.update')}}
                            <span wire:loading wire:target="updateProfile">
                                <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                            </span>
                        </button>
                        <button class="btn btn-info" wire:loading.attr="disabled" wire:click.prevent="closedEditSection">
                            {{ __('global.cancel')}}
                            <span wire:loading wire:target="closedEditSection">
                                <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
        </div>

    </div>
</div>
<!--End row-1  -->
--}}

{{-- 
<!--Start row-2  -->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4 mb-md-0">
        <div class="card-body">

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.fields.phone') }}</label>
                    <input type="text" class="form-control" wire:model.defer="phone" placeholder="{{ __('cruds.user.fields.phone') }}" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space' && this.value.length < 10 " step="1"  autocomplete="off"/>
                    @error('phone') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.profile.gender') }}</label>
                    <select wire:model.defer="gender" class="form-control">
                        <option value="">Select gender</option>
                        <option value="male" {{$gender == 'male' ? 'selected' : ''}}>Male</option>
                        <option value="female" {{$gender == 'female' ? 'selected' : ''}}>Female</option>
                        <option value="other" {{$gender == 'other' ? 'selected' : ''}}>Other</option>
                    </select>
                    @error('gender') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.profile.marital_status') }}</label>
                    <select wire:model.defer="marital_status" class="form-control">
                        <option value="">Select marital status</option>
                        <option value="married" {{$gender == 'married' ? 'selected' : ''}}>Married</option>
                        <option value="unmarried" {{$gender == 'unmarried' ? 'selected' : ''}}>Unmarried</option>
                    </select>
                    @error('marital_status') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.profile.guardian_name') }}</label>
                    <input type="text" class="form-control" wire:model.defer="guardian_name" placeholder="{{ __('cruds.user.profile.guardian_name') }}"/>
                    @error('guardian_name') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.profile.profession') }}</label>
                    <input type="text" class="form-control" wire:model.defer="profession" placeholder="{{ __('cruds.user.profile.profession') }}"/>
                    @error('profession') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.profile.address') }}</label>
                    <textarea class="form-control" wire:model.defer="address" rows="4"></textarea>
                    @error('address') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 mb-4">
                <div class="form-group mb-0" wire:ignore>
                    <label class="font-weight-bold">{{ __('cruds.user.profile.state')}}</label>
                    <select class="js-example-basic-single select-state w-100" wire:model.defer="state" >
                        <option>Select State</option>
                        @foreach(config('indian-regions.states') as $id=>$stateName)
                            <option value="{{$stateName}}" {{ucwords($state) == $stateName ? 'selected':''}} data-stateId="{{$id}}">{{ ucwords($stateName) }}</option>
                        @endforeach
                    </select>
                </div>
                @error('state') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="col-sm-4 mb-4">
                <div class="form-group mb-0">
                    <label class="font-weight-bold">{{ __('cruds.user.profile.city')}}</label>
                    
                    <select class="js-example-basic-single select-city w-100" wire:model.defer="city" >
                        <option>Select City</option>
                      
                            @if($allCities)
                            @foreach($allCities as $cityName)
                                <option value="{{$cityName}}" {{ucwords($city) == $cityName ? 'selected':''}}>{{ ucwords($cityName) }}</option>
                            @endforeach
                          
                        @endif
                    </select>
                   
                </div>
                @error('city') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
           
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.profile.pin_code') }}</label>
                    <input type="text" class="form-control" wire:model.defer="pin_code" placeholder="{{ __('cruds.user.profile.pin_code') }}"/>
                    @error('pin_code') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <!-- Referral Code -->
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.fields.referral_code') }}</label>
                    <input type="text" class="form-control" wire:model.defer="referral_code" placeholder="{{ __('cruds.user.fields.referral_code') }}" disabled/>
                    @error('referral_code') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.fields.referral_name') }}</label>
                    <input type="text" class="form-control" wire:model.defer="referral_name" placeholder="{{ __('cruds.user.fields.referral_name') }}" disabled/>
                    @error('referral_name') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            
        </div>

    

        <!-- Start nominee details -->
        <p class="mb-4">Nominee Details</p>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.profile.nominee_name') }}</label>
                    <input type="text" class="form-control" wire:model.defer="nominee_name" placeholder="{{ __('cruds.user.profile.nominee_name') }}"/>
                    @error('nominee_name') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.profile.nominee_dob') }}</label>
                    <input type="text" class="form-control" id="nominee_dob" wire:model.defer="nominee_dob" placeholder="{{ __('cruds.user.profile.nominee_dob') }}"/>
                    @error('nominee_dob') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.profile.nominee_relation') }}</label>
                    <input type="text" class="form-control" wire:model.defer="nominee_relation" placeholder="{{ __('cruds.user.profile.nominee_relation') }}"/>
                    @error('nominee_relation') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            
        </div>
        <!-- End nominee details -->
        </div>
        </div>
    </div>
</div>
--}}

{{-- <div class="text-center mt-3">
    <button class="btn btn-success" type="submit" wire:loading.attr="disabled">
        {{ __('global.update')}}
        <span wire:loading wire:target="updateProfile">
            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
        </span>
    </button>
    <button class="btn btn-secondary" wire:loading.attr="disabled" wire:click.prevent="closedEditSection">
        {{ __('global.cancel')}}
        <span wire:loading wire:target="closedEditSection">
            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
        </span>
    </button>
</div> --}}

</form>