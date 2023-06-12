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
                    <input type="number" class="form-control" wire:model.defer="phone" placeholder="Phone Number" />
                  </div>
                  @error('phone') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>
                <div class="form-group col-50">
                  <div class="input-form">
                    <div class="login-icon"><img src="{{asset('images/icons/date.svg')}}" alt="User"></div>
                    <label class="form-label">DOB</label>
                    <input type="date" id="dob" class="form-control" wire:model.defer="dob" placeholder="DOB" />
                  </div>
                  @error('dob') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>
                <div class="form-group col-50">
                  <div class="input-form">
                    <label class="form-label">Gender</label>
                    <select class="form-control" wire:model.defer='gender'>
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
                    <input type="text" class="form-control" placeholder="XXXXXXX"  wire:model.defer='referral_id'/>
                  </div>
                  @error('referral_id') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>
                <div class="form-group no-icon col-50">
                  <div class="input-form">
                    <label class="form-label">Referral Name</label>
                    <input type="text" class="form-control" placeholder="Referral Name" wire:model.defer='referral_name' />
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
        </div>
      </div>
    </section>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">

</script>
@endpush
