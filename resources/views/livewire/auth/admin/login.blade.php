
<div class="content-wrapper d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo">
            <img src="{{ asset('admin/images/logo.svg') }}" alt="logo">
            </div>
            <h4>Hello! let's get started</h4>
            <h6 class="font-weight-light">Login to continue.</h6>
            <form wire:submit.prevent="submitLogin" class="pt-3">
            <div class="form-group">
                <input type="email" class="form-control form-control-lg" placeholder="Email address" wire:model="email" wire:keyup="checkEmail">
                <div class="d-flex justify-content-between">
                    @error('email') <span class="error text-danger ">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-lg" placeholder="Password" wire:model.defer="password" autocomplete="off">
                @error('password') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="mt-3">
                <button type="submit"  wire:loading.attr="disabled" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                    {{ trans('global.login') }}
                    <span wire:loading wire:target="submitLogin">
                        <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                    </span>
                </button>
            </div>
            </form>
            <div class="my-2 d-flex justify-content-between align-items-center">
                <div class="form-check">
                <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input" wire:model.defer="remember_me">
                    Keep me signed in
                </label>
                </div>
                <a href="#" class="auth-link text-black">{{__('global.forgot_password_title')}}</a>
            </div>
          
        </div>
        </div>
    </div>
</div>
