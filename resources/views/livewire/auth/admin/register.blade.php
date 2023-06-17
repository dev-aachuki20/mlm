<div>
    <section class="login d-flex flex-wrap">
      <div class="login-left bg-white">
        <div class="login-left-inner">
            <div class="login-quote">
              <h4>Welcome to MyFutureBiz</h4>
              <p>It is an e-learning platform where you can learn different type of skills that will be helpful to create a better future for you.it is an e-learning platform where you can learn.</p>
            </div>
            <div class="login-img-left">
              <img src="{{asset('images/login-left.png')}}" alt="login img">
            </div>
        </div>
      </div>
      <div class="login-right bg-light-orange">
        <div class="login-form">
          <div class="form-head">
            <h3>Nice to see you again!</h3>
          </div>

          @if(!$paymentMode)
          
          <form wire:submit.prevent="storeRegister" class="form">            
            <div class="form-outer">
                <div class="form-group col-50">
                  <div class="input-form">
                    <div class="login-icon"><img src="{{asset('images/icons/user.svg')}}" alt="User"></div>
                    <label class="form-label">First Name</label>
                    <input type="text" wire:model.defer = 'first_name' class="form-control" placeholder="First Name" />
                  </div>
                  @error('first_name') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>
                <div class="form-group col-50">
                  <div class="input-form">
                    <div class="login-icon"><img src="{{asset('images/icons/user.svg')}}" alt="User"></div>
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" wire:model.defer = 'last_name' placeholder="Last Name" />
                  </div>
                  @error('last_name') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>
                <div class="form-group">
                  <div class="input-form">
                    <div class="login-icon"><img src="{{asset('images/icons/email.svg')}}" alt="User"></div>
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" wire:model.defer='email' placeholder="Enter Your Email" />
                  </div>
                  @error('email') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>
                <div class="form-group">
                  <div class="input-form">
                    <div class="login-icon"><img src="{{asset('images/icons/phone.svg')}}" alt="User"></div>
                    <label class="form-label">Phone Number</label>
                    <input type="number" class="form-control" wire:model.defer="phone" placeholder="Phone Number" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space' && this.value.length < 10 " step="1"  autocomplete="off" />
                  </div>
                  @error('phone') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>
                <div class="form-group col-50">
                  <div class="input-form">
                    <div class="login-icon"><img src="{{asset('images/icons/date.svg')}}" alt="User"></div>
                    <label class="form-label">DOB</label>
                    <input type="text" id="dob" class="form-control" wire:model.defer="dob" placeholder="DOB" autocomplete="off" />
                  </div>
                  @error('dob') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>
                <div class="form-group col-50">
                  <div class="input-form">
                    <label class="form-label">Gender</label>
                    <select class="form-control" wire:model.defer='gender'>
                      <option value="">Select Gender</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="other">Other</option>
                    </select>
                  </div>
                  @error('gender') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>
                <div class="form-group no-icon col-50">
                  <div class="input-form">
                    <label class="form-label">Referral ID</label>
                    <input type="text" class="form-control" placeholder="XXXXXXX"  wire:model.defer='referral_id' {{!empty($referral_id) ? 'disabled': ''}}/>
                  </div>
                  @error('referral_id') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>
                <div class="form-group no-icon col-50">
                  <div class="input-form">
                    <label class="form-label">Referral Name</label>
                    <input type="text" class="form-control" placeholder="Referral Name" wire:model.defer='referral_name' {{!empty($referral_name) ? 'disabled': ''}}/>
                  </div>
                  @error('referral_name') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                  <div class="input-form">
                    <div class="login-icon"><img src="{{asset('images/icons/map.svg')}}" alt="User"></div>
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" placeholder="Address here"  wire:model.defer='address'/>
                  </div>
                  @error('address') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>

                <div class="form-group">
                  <div class="input-form">
                    <label class="form-label">Package</label>
                    <select class="form-control" wire:model.defer='package'>
                      <option value="">Select Package</option>
                      @foreach($packages as $package)
                        <option value="{{ $package->id }}">{{ $package->title }}</option>
                      @endforeach
                    </select>
                  </div>
                  @error('package') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>

              </div>
              <div class="submit-btn">
                <button type="submit" class="btn " wire:loading.attr="disabled">SignUp
                        <span wire:loading wire:target="storeRegister">
                            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                        </span>
                </button>
                
              </div>
              <div class="have-account">
                <p>Already Have an account? <a href="{{ route('auth.login') }}">Login Now!</a></p>
              </div>
          </form>

          @else
          
            @livewire('auth.payment-component')

          @endif
            
        </div>
      </div>
    </section>
</div>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">


    $('input[id="dob"]').daterangepicker({
        autoApply: true,
        // autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'DD-MM-YYYY'
        },
    });

    $('input[id="dob"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        Livewire.emit('updateDOB',picker.startDate.format('DD-MM-YYYY'));
    });

  

</script>
@endpush
