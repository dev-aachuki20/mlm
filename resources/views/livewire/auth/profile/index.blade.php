

<div class="content-wrapper">

   <div wire:loading wire:target="openEditSection,closedEditSection" class="loader" role="status" aria-hidden="true"></div>
   
   <section style="background-color: #f5f7ff;">
      <div class="container py-1">
        <!-- Start headsection -->
       <div class="row">
            <div class="col-lg-12 grid-margin ">
                <div class="card">
                    <div class="card-body">
                      <div class="d-flex float-left">
                        <h4 class="font-weight-bold">{{($editMode) ? trans('global.edit').' Profile' : 'Profile' }} </h5>
                      </div>
                      <div class="d-flex float-right">
                        @if(!$editMode)
                        <button class="btn btn-sm btn-primary mr-1" wire:click="openEditSection">
                            <i class="fa fa-edit pr-1"></i>{{__('global.edit')}}
                        </button>
                        @endif
                        <button class="btn btn-sm btn-primary" id="changepassword"  data-bs-toggle="modal" data-bs-target="#changePasswordModal"><i class="fa fa-key pr-1"></i>{{__('global.change_password')}}</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End headsection -->
        @if(!$editMode)
          <!--Start row-1  -->
          <div class="row">
          
              @include('livewire.auth.profile.profile-image')

            <div class="col-lg-8">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0 font-weight-bold">{{ __('cruds.user.fields.first_name') }}</p>
                    </div>
                    <div class="col-sm-3">
                      <p class="text-muted mb-0">{{ ucfirst($authUser->first_name) }}</p>
                    </div>
                    <div class="col-sm-3">
                      <p class="mb-0 font-weight-bold">{{ __('cruds.user.fields.last_name') }}</p>
                    </div>
                    <div class="col-sm-3">
                      <p class="text-muted mb-0">{{ ucfirst($authUser->last_name) }}</p>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0 font-weight-bold">{{ __('cruds.user.fields.date_of_join') }}</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{ convertDateTimeFormat($authUser->date_of_join,'date') }}</p>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0 font-weight-bold">{{ __('cruds.user.fields.email') }}</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{ $authUser->email }}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0 font-weight-bold">{{ __('cruds.user.fields.phone') }}</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{ $authUser->phone ?? ''}}</p>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.gender') }}</p>
                    </div>
                    <div class="col-sm-3">
                      <p class="text-muted mb-0">{{ $authUser->profile->gender ?? ''}}</p>
                    </div>
                    <div class="col-sm-3">
                      <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.marital_status') }}</p>
                    </div>
                    <div class="col-sm-3">
                      <p class="text-muted mb-0">{{ $authUser->profile->marital_status ?? ''}}</p>
                    </div>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
          </div>
          <!--End row-1  -->

          <!-- Start row-2  -->
          <div class="row">
            <div class="col-md-12">
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.guardian_name') }}</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $authUser->profile->guardian_name ?? ''}}</p>
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.profession') }}</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $authUser->profile->profession ?? ''}}</p>
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.address') }}</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $authUser->profile->address ?? ''}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.city') }}</p>
                </div>
                <div class="col-sm-3">
                  <p class="text-muted mb-0">{{ $authUser->profile->city ?? ''}}</p>
                </div>
                <div class="col-sm-3">
                  <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.pin_code') }}</p>
                </div>
                <div class="col-sm-3">
                  <p class="text-muted mb-0">{{ $authUser->profile->pin_code ?? ''}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.state') }}</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $authUser->profile->state ?? ''}}</p>
                </div>
              </div>
              <hr>

              <!-- Referral Code -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0 font-weight-bold">{{ __('cruds.user.fields.referral_code') }}</p>
                </div>
                <div class="col-sm-3">
                  <p class="text-muted mb-0">{{ $authUser->referral_code ?? '' }}</p>
                </div>
                <div class="col-sm-3">
                  <p class="mb-0 font-weight-bold">{{ __('cruds.user.fields.referral_name') }}</p>
                </div>
                <div class="col-sm-3">
                  <p class="text-muted mb-0">{{ ucfirst($authUser->referral_name) }}</p>
                </div>
              </div>
              <hr>

              <!-- Start nominee details -->
                  <p class="mb-4">Nominee Details</p>

                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.nominee_name') }}</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{ $authUser->profile->nominee_name ?? ''}}</p>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.nominee_dob') }}</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{ $authUser->profile->nominee_dob ?? ''}}</p>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-4">
                      <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.nominee_relation') }}</p>
                    </div>
                    <div class="col-sm-8">
                      <p class="text-muted mb-0">{{ $authUser->profile->nominee_relation ?? ''}}</p>
                    </div>
                  </div>
                  <hr>
              <!-- End nominee details -->

                <!-- Start nominee details -->
                    <p class="mb-4">Bank Details</p>

                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.bank_name') }}</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $authUser->profile->bank_name ?? ''}}</p>
                      </div>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.branch_name') }}</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $authUser->profile->branch_name ?? ''}}</p>
                      </div>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.ifsc_code') }}</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $authUser->profile->ifsc_code ?? ''}}</p>
                      </div>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.account_number') }}</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $authUser->profile->account_number ?? ''}}</p>
                      </div>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.pan_card_number') }}</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $authUser->profile->pan_card_number ?? ''}}</p>
                      </div>
                    </div>
                    <hr>

                </div>
              </div>
            </div>
      
          </div>
        @else

          @include('livewire.auth.profile.edit')
          
        @endif

      </div>
    </section>
    @livewire('auth.profile.change-password')

</div>
@push('scripts')
<script>
  $(document).ready(function(){
    $(document).on('click','#changepassword',function(){
      $('#changePasswordModal').modal('show');
    });
    
    $(document).on('click','.close-modal',function(){
         $('#changePasswordModal').modal('hide');
    });
  });
</script>
@endpush