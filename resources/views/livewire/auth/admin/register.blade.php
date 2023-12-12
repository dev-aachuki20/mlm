<div>

@if(!$paymentSuccess)
  <div wire:loading wire:target="paymentSuccessful" class="loader"></div>
  <div wire:loading wire:target="makeCODPayment" class="loader"></div>
  
  @if(!$paymentMode)
    <section class="login d-flex flex-wrap">
      <div class="login-left bg-white">
        <div class="login-left-inner">
            <div class="login-quote">
              <h4>Welcome to {{ config('constants.app_name') }}</h4>
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
                    <input type="email" class="form-control" wire:model='email' wire:change="checkEmail" placeholder="Enter Your Email" />
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
                    <input type="text" id="dob" class="form-control" wire:model.defer="dob" placeholder="DOB" autocomplete="off" readonly />
                  </div>
                  @error('dob') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>
                <div class="form-group col-50">
                  <div class="input-form">
                    <label class="form-label">Gender</label>
                    <select class="form-control" wire:model.defer='gender'>
                      <option value="">Select Gender</option>
                      <option value="male" {{$gender == 'male'? 'selected' : '' }}>Male</option>
                      <option value="female" {{$gender == 'female'? 'selected' : '' }}>Female</option>
                      <option value="other" {{$gender == 'other'? 'selected' : '' }}>Other</option>
                    </select>
                  </div>
                  @error('gender') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>
                <div class="form-group no-icon col-50">
                  <div class="input-form">
                    <label class="form-label">Referral ID</label>
                    <input type="text" class="form-control" placeholder="XXXXXXX"  wire:model='referral_id' wire:input="checkReferral" {{!empty($from_url_referral_id) ? 'disabled': ''}}/>
                  </div>
                  @error('referral_id') <span class="error text-danger">{{ $message }}</span>@enderror

                </div>
                <div class="form-group no-icon col-50">
                  <div class="input-form">
                    <label class="form-label">Referral Name</label>
                    <input type="text" class="form-control" placeholder="Referral Name" wire:model.defer='referral_name' {{!empty($from_url_referral_name)  ? 'disabled': ''}}/>
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
                <button type="submit" class="btn " wire:loading.attr="disabled">SignUp &nbsp;
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

  @else
          
    @livewire('auth.payment-component',['data'=>$this->all(),'packageUUID'=>$packageUUID])

  @endif

@else

  @livewire('auth.payment-success',['share_email'=>$share_email,'share_password'=>$share_password,'paymentGatewayType'=>$paymentGatewayType])

@endif

<div wire:ignore.self wire:key="cod-payment-modal" class="modal fade" id="codModal" tabindex="-1" data-bs-backdrop='static' aria-hidden="true">
  <div class="modal-dialog codModal modal-dialog-centered modal-dialog-scrollable">
    <form wire:submit.prevent="makeCODPayment" class="modal-content border-0">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="exampleModalLabel">COD Payment</h5>
        <button type="button" class="btn-close shadow-none border-0" wire:click.prevent="cancelCODPayment" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <div class="mb-3 text-center">
                @php
                  $codQrCodeImage = getSetting('payment_qr_code');
                @endphp
                <img src="{{$codQrCodeImage}}" width="200px">
            </div>
            <div class="mb-3">
                <div class="form-group mb-0" wire:ignore>
                    <label class="font-weight-bold justify-content-start">Upload Transaction Receipt:</label>
                    <input type="file" id="dropify-image"  wire:model.defer="paymentReceiptImage" class="dropify" data-default-file="{{ $paymentReceiptImageOriginal }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" accept="image/jpeg, image/png, image/jpg,image/svg">
                    <span wire:loading wire:target="paymentReceiptImage">
                        <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Loading
                    </span>
                </div>
                @if($errors->has('paymentReceiptImage'))
                <span class="error text-danger">
                    {{ $errors->first('paymentReceiptImage') }}
                </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Transaction Id:</label>
                <input type="text" class="form-control p-3 h-auto" wire:model.defer="cod_transaction_id">
                @error('cod_transaction_id') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" wire:click.prevent="cancelCODPayment" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btnprimary" wire:loading.attr="disabled">
                Submit &nbsp;
                <span wire:loading wire:target="makeCODPayment">
                    <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                </span>
            </button>
        </div>
        </form>
  </div>
</div>

</div>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script type="text/javascript">

    var today = new Date();
    var minDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());

    $('input[id="dob"]').daterangepicker({
        autoApply: true,
        // autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'DD-MM-YYYY'
        },
        // minDate: minDate,
        maxDate: today

    });

    $('input[id="dob"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        Livewire.emit('updateDOB',picker.startDate.format('DD-MM-YYYY'));
    });

  
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
  window.addEventListener('openRazorpayCheckout', event => {

    var options = {
          "key": "{{ config('services.razorpay.key') }}", // Enter the Key ID generated from the Dashboard
          "amount": event.detail.amount,
          "currency": "INR",
          "description": "{{ config('app.name') }}",
          "image": "{{ asset(config('constants.default.logo')) }}",
          "prefill":
          {
          "name": event.detail.name,
          "email": event.detail.email,
          "contact": '+91'+event.detail.phone,
          },
          config: {
          display: {
              // blocks: {
              //   banks: {
              //     name: 'Methods with Offers',
              //     instruments: [
              //       {
              //         method: 'wallet',
              //         wallets: ['olamoney']
              //       }]
              //   },
              // },
              // sequence: ['block.banks'],
              preferences: {
                show_default_blocks: true,
              },
            },
          },
          "handler": function (response) {
              // console.log('response',response);
              document.querySelector('.loader').style.display = 'block';

              Livewire.emit('paymentSuccessful',response.razorpay_payment_id);
          },
          "modal": {
          "ondismiss": function () {
              if (confirm("Are you sure, you want to close the form?")) {
                  txt = "You pressed OK!";
                  console.log("Checkout form closed by the user");
                  // Show the loader element
                  // document.querySelector('.loader').style.display = 'block';

                  document.querySelector('.loader').style.display = 'none';

                  // window.location.replace('{{route('auth.register')}}');
              } else {
                  txt = "You pressed Cancel!";
                  console.log("Complete the Payment")
              }
          }
          }
    };

    var rzp1 = new Razorpay(options);
    rzp1.open();
   
  });

  window.addEventListener('openCODModal', event => {
    //  console.log(event.detail);
     $('#codModal').modal('show');

      @this.emit('updatedCodRequest',event.detail);

      $('.dropify').dropify();
      $('.dropify-errors-container').remove();

      $('.dropify-clear').click(function(e) {
          e.preventDefault();
          var elementName = $(this).siblings('input[type=file]').attr('id');
          if (elementName == 'dropify-image') {
              @this.emit('updatedPaymentReceiptImage', null);
              @this.emit('updatedPaymentReceiptImageOriginal', null);
          }
      });
  });

  window.addEventListener('clearDropify', event => {
      $('.dropify-clear').trigger("click");
  });

  window.addEventListener('closedCODModal', event => {
    $('#codModal').modal('hide');
  });

  window.addEventListener('closedLoader', event => {
    console.log('closed loader');
    document.querySelector('.loader').style.display = 'none';
  });
  
</script>
@endpush
