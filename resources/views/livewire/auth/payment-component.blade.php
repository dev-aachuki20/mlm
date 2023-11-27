<div>
    <section class="login signup-plan-sec d-flex flex-wrap">
        <div class="login-left bg-white">
        <div class="login-left-inner">
            <div class="signup-plans">
                <div class="signup-head">
                <h4>Choose The Plan</h4>
                <p>Choose your plan and enjoy!</p>
                </div>
                <div class="signupplan">
                @if($packages->count() > 0)
                    @foreach($packages as $key=>$package)
                    <div class="plan-list {{ ($fromURLPackageSelected && ($package->id != $defaultSelectedPackage)) ? 'inactive-plan' : ''}}">
                        <input type="radio" name="radio" id="basic-package-{{$key}}" value="{{ $package->id }}"  @if($key == 0 || $package->id == $defaultSelectedPackage) checked @endif wire:model.defer = "select_package" wire:change="handleOptionSelection({{ $package->id }})" {{ ($fromURLPackageSelected && ($package->id != $defaultSelectedPackage)) ? 'disabled' : ''}}>
                        <label class="signupplan-inner" for="basic-package-{{$key}}">
                        <div class="plan-package">
                            <h5>{{ $package->title }}</h5>
                            <p>{{ $package->sub_title }}</p>
                            <div class="plan-price">
                            <span>
                                <svg width="26" height="39" viewBox="0 0 26 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M25.0586 0.5H0.941284V5.29149H9.44623C12.5696 5.29149 15.2335 7.29436 16.2224 10.083H0.941284V14.8745H16.2224C15.2335 17.6631 12.5696 19.666 9.44623 19.666H0.941284V24.4574L14.9837 38.5L18.3718 35.1118L7.71753 24.4576H9.44623C15.2311 24.4576 20.0712 20.3356 21.1842 14.8745H25.0586V10.0831H21.1842C20.8236 8.31368 20.0716 6.68509 19.0232 5.29156H25.0586V0.5Z"/>
                                </svg>
                            </span>
                            {{-- {{ number_format($package->amount,2)}} --}}
                            {{ $package->amount }}

                            </div>
                        </div>
                        <div class="package-include">
                            {!! $package->features !!}
                        </div>
                        </label>                  
                    </div>
                    @endforeach
                @endif
        
                </div>
            </div>
        </div>
        </div>

        <div class="login-right bg-light-orange">
        <div class="login-form">
            <div class="form-head mb-0">
                <div class="icon-head">
                    <img src="{{asset('images/icons/completed.svg')}}">
                </div>
                <h3>You have Completed SignUp!</h3>
                <div class="payment_radio row justify-content-center">
                    <div class="col-auto d-flex align-items-center gap-2">
                        <input type="radio" wire:model="payment_gateway" value="razorpay" {{ $payment_gateway == 'razorpay' ? 'checked' : '' }}> Razorpay
                    </div>
                    @if(getSetting('payment_cod_status') == 'active')
                    <div class="col-auto d-flex align-items-center gap-2">
                            <input type="radio" wire:model="payment_gateway" value="cod" {{ $payment_gateway == 'cod' ? 'checked' : '' }}> COD
                        </div>
                        @endif

                </div>
            </div>
            <div class="go-back">
            <button wire:loading.attr="disabled"  class="btn w-100" wire:click.prevent="pay">
                Complete your payment
                <span wire:loading wire:target="submit">
                    <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                </span>
            </button>
            </div>
        </div>
        </div>

      </section>
</div>

