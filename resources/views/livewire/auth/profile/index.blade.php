
<div class="content-wrapper">
  <div wire:loading wire:target="openEditSection,closedEditSection" class="loader" role="status" aria-hidden="true"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="my-team-head  mb-3">
            <div class="profile-img-edit">
              <img src="{{ ($authUser->profileImage()->first()) ? $authUser->profileImage()->first()->file_url : asset(config('constants.default.profile_image')) }}" alt="profile">
            </div>
            <ul class="nav nav-tabs my-team-tab-head" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link {{$activeTab == 'user-tab' ? 'active' : ''}}" id="users-tab" wire:click="switchTab('user-tab')" data-toggle="tab" href="#users" role="tab" aria-controls="users"
                  aria-selected="true">Users</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{$activeTab == 'profile-tab' ? 'active' : ''}}" id="profile-tab" data-toggle="tab" wire:click="switchTab('profile-tab')" href="#profile" role="tab" aria-controls="profile"
                  aria-selected="false">profile</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" id="password-change-tab" data-toggle="tab" href="#password-change" role="tab" aria-controls="password-change"
                  aria-selected="false">Change Password</a>
              </li> -->
            </ul>                    
          </div>
          
        
          <div class="tab-content border-0 p-0" id="myTabContent">

            @if($activeTab == 'user-tab')

            {{-- Start users section --}}
            <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
             
              <form class="{{ ($editMode) ? 'is-editing' : 'is-readonly' }}" wire:submit.prevent="{{ ($editMode) ? 'updateProfile' : '' }}">
            
                <div class="d-flex justify-content-between align-items-center pb-3 border-b-1  mb-5">
                  <p class="card-title border-0 mb-0 p-0">Users</p>

                  @if(!$editMode)
                    <a href="javascript:void(0)" class="edit-form btn-edit js-edit" wire:click="openEditSection">
                      <img src="{{ asset('images/icons/edit-icon.svg') }}"> Edit</a>
                  @endif

                </div>

                @if($editMode)
                  <div class="row">
                    <div class="col-lg-6 col-sm-12">
                      <div class="form-outer">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label justify-content-start">First Name <i class="fa-asterisk" style="color: #e14119;"></i> <span>:</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" wire:model="first_name" placeholder="First Name" value="{{ ucfirst($authUser->first_name) }}">
                            @error('first_name') <span class="error text-danger">{{ $message }}</span>@enderror
                          </div>
                          
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Contact Number  <span>:</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" wire:model.defer="phone" value="{{ $authUser->phone ?? ''}}" >
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
                            <input type="text" class="form-control" wire:model.defer="last_name" placeholder="Last Name" value="{{ ucfirst($authUser->last_name) }}">
                            @error('last_name') <span class="error text-danger">{{ $message }}</span>@enderror
                          </div>
                          
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">DOB  <span>:</span></label>
                          <div class="col-sm-8">                                  
                            <div class="input-group date" id="datepicker">
                              <input type="text" placeholder="dd/mm/yyyy" class="form-control" value="{{ convertDateTimeFormat($authUser->dob,'date') }}" wire:model.defer="dob"  id="dob" />
                                <span class="input-group-append">
                                </span>
                            </div>
                            @error('dob') <span class="error text-danger">{{ $message }}</span>@enderror
                          </div>
                        </div>
                      
                      </div>
                    </div>

                  </div>
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
                
                @else

                  <div class="row">
                    <div class="col-lg-6 col-sm-12">
                      <div class="form-outer">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Name<span>:</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Enter Full Name" value="{{ ucwords($authUser->name) }}" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Email ID <span>:</span></label>
                          <div class="col-sm-8">
                            <input type="email" class="form-control" placeholder="Enter Email ID" value="{{ $authUser->email }}" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Contact Number  <span>:</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ $authUser->phone ?? ''}}" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">DOB  <span>:</span></label>
                          <div class="col-sm-8">                                  
                            <div class="input-group date" id="datepicker">
                              <input type="text" placeholder="dd/mm/yyyy" class="form-control" value="{{ convertDateTimeFormat($authUser->dob,'date') }}" id="dob" disabled/>
                                <span class="input-group-append">
                                </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                      <div class="form-outer">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Date Of  Joing<span>:</span></label>
                          <div class="col-sm-8">                                  
                            <div class="input-group date" id="datepicker1">
                              <input type="text" placeholder="dd/mm/yyyy" class="form-control" id="date_of_join" value="{{ convertDateTimeFormat($authUser->date_of_join,'date') }}" disabled/>
                                <span class="input-group-append">
                                </span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">My referral code  <span>:</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Enter my referral code" value="{{ $authUser->my_referral_code}}" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Referral code  <span>:</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control"  value="{{ $authUser->referral_code ?? '' }}" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Referral Name  <span>:</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control"  value="{{ ucwords($authUser->referral_name) }}" disabled>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                @endif

              </form>
            </div>
            {{-- End users section --}}

            @endif

            @if($activeTab == 'profile-tab')

            {{-- Start profile section --}}
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <form class="is-readonly">
                <div class="d-flex justify-content-between align-items-center pb-3 border-b-1  mb-5">
                  <p class="card-title border-0 mb-0 p-0">Profile</p>
                  <a href="javascript:void(0)" class="edit-form btn-edit js-edit">
                    <img src="{{ asset('images/icons/edit-icon.svg') }}"> Edit</a>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-sm-12">
                    <div class="form-outer">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Gender<span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Full Name" value="Rahul Kumar Meena" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Profession <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Profession" value="rahulkumar@gmail.com" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Martial Status  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Martial Status" value="12345678910253" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Address  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Address" value="+91-1234567890" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">State  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter State" value="Rajasthan" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">City  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter City" value="jaipur" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Pin Code  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Pin Code" value="Pin Code" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Father’s/Husband Name  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Father’s/Husband Name" value="Rahul Meena" disabled>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-sm-12">
                    <div class="form-outer">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nominee Name<span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Full Name" value="Rahul Kumar" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nominee DOB <span>:</span></label>
                        <div class="col-sm-8">
                          <div class="input-group date" id="datepicker2">
                            <input type="text" placeholder="dd/mm/yyyy" class="form-control" id="date" disabled/>
                              <span class="input-group-append">
                              </span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nominee Relation  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Nominee Relation" value="Father" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Bank Name  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Bank Name" value="Bank Name" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Bank Branch Name  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Bank Branch Name" value="Jaipur" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">IFSC code  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter IFSC code" value="IFSC0012" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Account Number  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Account Number" value="1234567890523" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">PAN Card Number  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter PAN Card Number" value="02Rahu000" disabled>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pt-3 border-top">
                  <button type="button" class="btn btn-default custom-btn btn-save js-save w-auto mt-0 ml-auto">Update Details</button>
                </div>
              </form>
            </div>
            {{-- End profile section --}}

            @endif
          
          </div>   
        </div>
      </div>
    </div>
  </div>
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