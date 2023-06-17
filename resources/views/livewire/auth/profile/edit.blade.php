 
 <form wire:submit.prevent="updateProfile">
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
                        <label class="font-weight-bold">{{ __('cruds.user.fields.date_of_join') }}</label>
                        <input type="date" class="form-control" wire:model.defer="date_of_join" disabled />
                        @error('date_of_join') <span class="error text-danger">{{ $message }}</span>@enderror
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
        </div>
        </div>
    </div>
</div>
<!--End row-1  -->

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
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.profile.state') }}</label>
                    <input type="text" class="form-control" wire:model.defer="state" placeholder="{{ __('cruds.user.profile.state') }}"/>
                    {{-- <select wire:model.defer="state" id="state_id" class="form-control">
                        <option value="">Select State</option>
                    </select> --}}
                    @error('state') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('cruds.user.profile.city') }}</label>
                    <input type="text" class="form-control" wire:model.defer="city" placeholder="{{ __('cruds.user.profile.city') }}"/>
                    {{-- <select wire:model.defer="city" id="city_id" class="form-control">
                        <option value="">Select City</option>
                    </select> --}}
                    @error('city') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
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
                    <input type="date" class="form-control" wire:model.defer="nominee_dob" placeholder="{{ __('cruds.user.profile.nominee_dob') }}"/>
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

<div class="text-center mt-3">
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
</div>

</form>