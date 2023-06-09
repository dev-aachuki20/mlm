
<div class="login-right bg-light-orange">
<div class="login-form">
    <div class="form-head">
    <h3>{{ __('Forgot Password') }}</h3>
    </div>
    <form wire:submit.prevent="submit" class="form">            
    <div class="form-outer">                
        <div class="form-group">
            <div class="input-form">
                <div class="login-icon"><img src="{{asset('images/icons/email.svg')}}" alt="User"></div>
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Enter Your Email" wire:model="email"/>
            </div>
            @error('email') <span class="error text-danger ">{{ $message }}</span>@enderror
        </div>
        </div>
        <div class="submit-btn">
        <button type="submit"  wire:loading.attr="disabled" class="btn">
            Reset Password
            <span wire:loading wire:target="submit">
                <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
            </span>
        </button>           
        </div>
    </form>
</div>
</div>
