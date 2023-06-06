
<div class="content-wrapper d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo">
            <img src="{{ asset('admin/images/logo.svg') }}" alt="logo">
            </div>
            <h4>{{ __('Forgot Password') }}</h4>
            <h6 class="font-weight-light">Input your email and we will send you reset password link.</h6>
            <form wire:submit.prevent="submit" class="pt-3">
            <div class="form-group">
                <input type="email" class="form-control form-control-lg" placeholder="Email address" wire:model="email">
                <div class="d-flex justify-content-between">
                    @error('email') <span class="error text-danger ">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="mt-3">
                <button type="submit"  wire:loading.attr="disabled" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                    {{__('global.send')}}
                    <span wire:loading wire:target="submit">
                        <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                    </span>
                </button>
            </div>
            </form>
           
        </div>
        </div>
    </div>
</div>
