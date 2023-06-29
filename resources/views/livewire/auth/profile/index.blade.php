

<div class="content-wrapper">

   <div wire:loading wire:target="openEditSection,closedEditSection" class="loader" role="status" aria-hidden="true"></div>
   
   <section style="background-color: #f5f7ff;">
      <div class="container py-1">
        <!-- Start headsection -->
       <div class="row">
            <div class="col-lg-12 grid-margin">
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
                      <p class="mb-0 font-weight-bold">{{ __('cruds.user.fields.dob') }}</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{ convertDateTimeFormat($authUser->dob,'date') }}</p>
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

          {{-- 
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
                      <p class="text-muted mb-0">{{ ucfirst($authUser->profile->nominee_name) ?? ''}}</p>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.nominee_dob') }}</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{ convertDateTimeFormat($authUser->profile->nominee_dob,'date') ?? ''}}</p>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0 font-weight-bold">{{ __('cruds.user.profile.nominee_relation') }}</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{ ucfirst($authUser->profile->nominee_relation) ?? ''}}</p>
                    </div>
                  </div>
                  <hr>
              <!-- End nominee details -->

                <!-- Start nominee details -->
                    <p class="mb-4">Bank Details</p>

                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0 font-weight-bold">{{ __('cruds.user.kyc.bank_name') }}</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $authUser->kycDetail->bank_name ?? ''}}</p>
                      </div>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0 font-weight-bold">{{ __('cruds.user.kyc.branch_name') }}</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $authUser->kycDetail->branch_name ?? ''}}</p>
                      </div>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0 font-weight-bold">{{ __('cruds.user.kyc.ifsc_code') }}</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $authUser->kycDetail->ifsc_code ?? ''}}</p>
                      </div>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0 font-weight-bold">{{ __('cruds.user.kyc.account_number') }}</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $authUser->kycDetail->account_number ?? ''}}</p>
                      </div>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0 font-weight-bold">{{ __('cruds.user.kyc.pan_card_number') }}</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $authUser->kycDetail->pan_card_number ?? ''}}</p>
                      </div>
                    </div>
                    <hr>

                </div>
              </div>
            </div>
      
          </div>
          --}}
        @else

          @include('livewire.auth.profile.edit')
          
        @endif

      </div>
    </section>
    @livewire('auth.profile.change-password')

</div>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="{{ asset('admin/assets/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('admin/assets/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('admin/css/vertical-layout-light/style.css') }}">
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('admin/assets/select2/select2.min.js') }}"></script>
<script type="text/javascript">
  
  document.addEventListener('reinitializePlugins', function (event) {
    $(".select-city").select2({
            placeholder: 'Select City',
      });
      $(document).on('change','.select-city',function(){
          var selectCity = $(this).val();
          // @this.set('city', selectCity);
          Livewire.emit('updatedCity',selectCity);
      });
  });
 

  document.addEventListener('loadPlugins', function (event) {
 
    // Start select 2 for state
      if ($(".select-state").length) {
        $(".select-state").select2({
            placeholder: 'Select State',
        });
      }
      
      $(document).on('change','.select-state',function(){
          var selectState = $(this).val();
          var stateId = $('.select-state option:selected').attr('data-stateId');
          // @this.set('state', selectState);
          Livewire.emit('updatedState',selectState,stateId);
      });
      // End select2 for state

      // Start select2 for city
      if ($(".select-city").length) {
        $(".select-city").select2({
            placeholder: 'Select City',
        });
      }
      
      $(document).on('change','.select-city',function(){
          var selectCity = $(this).val();
          // @this.set('city', selectCity);
          Livewire.emit('updatedCity',selectCity);
      });
      // End select2 for city

      var today = new Date();
      var minDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());

      var dateToSet = '{{ $dob ?? null}}';

      $('input[id="dob"]').daterangepicker({
          autoApply: true,
          singleDatePicker: true,
          showDropdowns: true,
          locale: {
              format: 'DD-MM-YYYY'
          },
          maxDate: today,
      },
      function(start, end, label) {
        // console.log('hello');
          Livewire.emit('updatedDob',start.format('YYYY-MM-DD'));
      });

      $('input[id="nominee_dob"]').daterangepicker({
          autoApply: true,
          singleDatePicker: true,
          showDropdowns: true,
          locale: {
              format: 'DD-MM-YYYY'
          },
          maxDate: today,
      },
      function(start, end, label) {
          Livewire.emit('updateNomineeDob',start.format('YYYY-MM-DD'));
      });
      
  });
</script>
<script type="text/javascript">
  window.addEventListener('close-modal', event => {
    $(event.detail.element).modal('hide');
  });

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