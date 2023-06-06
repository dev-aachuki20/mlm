
<div class="content-wrapper d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo">
            <img src="{{ asset('admin/images/logo.svg') }}" alt="logo">
            </div>
            <h4>{{ trans('global.reset_password') }}</h4>
            <form wire:submit.prevent="submit" class="pt-3">
                <div class="form-group">
                    <div class="input-wrap d-flex">
                        <div class="input-group show_hide_password">
                            <input  wire:model.defer="password" type="password" class="form-control" placeholder="Password" id="password" autocomplete="off">
                            <div class="input-group-addon">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    @error('password') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <div class="input-wrap d-flex">
                        <div class="input-group show_hide_password">
                            <input  wire:model.defer="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" id="password_confirmation" autocomplete="off">
                            <div class="input-group-addon">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    @error('password_confirmation') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="mt-3">
                    <button type="submit"  wire:loading.attr="disabled" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                        {{__('global.submit')}}
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
