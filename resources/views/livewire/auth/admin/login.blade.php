

<div class="login-right bg-light-orange">
    <div class="login-form">
        <div class="form-head">
        <h3>Nice to see you again!</h3>
        </div>
        <form wire:submit.prevent="submitLogin" class="form">            
        <div class="form-outer">
            <div class="form-group">
                <div class="login-icon"><img src="{{ asset('images/icons/user.svg') }}" alt="User"></div>
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control"  wire:model="email" wire:keyup="checkEmail" placeholder="Enter Your Email" />
                @error('email') <span class="error text-danger ">{{ $message }}</span>@enderror
            </div>
            
            <div class="form-group">
                <div class="login-icon"><img src="{{ asset('images/icons/password.svg') }}" ></div>
                <label for="password" class="form-label">Password</label>
                <input id="password-field" type="password" class="form-control" placeholder="Enter Your Password" wire:model.defer="password" autocomplete="off"/>
                <span toggle="#password-field" class="fa-eye field-icon toggle-password">
                    <img src="{{ asset('images/icons/view-password.svg') }}" alt="view-password" class="view-password">
                    <img src="{{ asset('images/icons/hide-password.svg') }}" alt="hide-password" class="hide-password">
                </span>
                @error('password') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <div class="login-forgot">
                <label class="toggle-switch" for="checkbox">
                    <input type="checkbox" id="checkbox" wire:model.defer="remember_me" />
                    <div class="toggle-slider round"></div>
                    <div class="can-toggle__label-text">Remember me</div>
                </label>
                <a href="{{ route('auth.forget-password') }}">Forgot Password?</a>
                </div>
            </div>
            </div>
            <div class="submit-btn">
                <button type="submit"  wire:loading.attr="disabled" class="btn">
                    Login Now!
                    <span wire:loading wire:target="submitLogin">
                        <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                    </span>
                </button>
            </div>
            <div class="have-account">
            <p>Don’t Have an account? <a href="signup.html">Sign up Now!</a></p>
            </div>
        </form>
    </div>
  </div>