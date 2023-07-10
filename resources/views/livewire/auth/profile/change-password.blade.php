
<div class="content-wrapper">
    {{-- <div wire:loading wire:target="updatePassword" class="loader"></div> ---}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-body">
                <p class="card-title mb-40">{{ trans('global.change_password') }}</p>
                <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                    <div class="card-body pt-4 pb-4">
                        <form class="form" wire:submit.prevent="updatePassword">            
                        <div class="form-outer">
                            <div class="form-group">                  
                                <div class="input-form">
                                    <div class="login-icon"><img src="{{ asset('images/icons/password.svg') }}"></div>
                                    <label for="old-password" class="form-label">Old Password</label>
                                    <input id="old-password" type="password" class="form-control" placeholder="Enter Your Old Password" wire:model.defer="old_password" autocomplete="off">
                                    <span toggle="#old-password" class="fa-eye field-icon toggle-password">
                                        <img src="{{ asset('images/icons/view-password.svg') }}" alt="view-password" class="view-password">
                                        <img src="{{ asset('images/icons/hide-password.svg') }}" alt="hide-password" class="hide-password">
                                    </span>
                                </div>
                                @error('old_password') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">                  
                                <div class="input-form">
                                    <div class="login-icon"><img src="{{ asset('images/icons/password.svg') }}"></div>
                                    <label for="new-password" class="form-label">New Password</label>
                                    <input id="new-password" type="password" class="form-control" wire:model.defer="new_password" placeholder="Enter Your New Password" autocomplete="off">
                                    <span toggle="#new-password" class="fa-eye field-icon toggle-password">
                                        <img src="{{ asset('images/icons/view-password.svg') }}" alt="view-password" class="view-password">
                                        <img src="{{ asset('images/icons/hide-password.svg') }}" alt="hide-password" class="hide-password">
                                    </span>
                                </div>
                                @error('new_password') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <div class="input-form">
                                    <div class="login-icon"><img src="{{ asset('images/icons/password.svg') }}"></div>
                                    <label for="confirm-password" class="form-label">Confirm password</label>
                                    <input id="confirm-password" type="password" class="form-control" wire:model.defer="confirm_password" placeholder="Enter Your Confirm Password" autocomplete="off">
                                    <span toggle="#confirm-password" class="fa-eye field-icon toggle-password">
                                        <img src="{{ asset('images/icons/view-password.svg') }}" alt="view-password" class="view-password">
                                        <img src="{{ asset('images/icons/hide-password.svg') }}" alt="hide-password" class="hide-password">
                                    </span>
                                </div>
                                @error('confirm_password') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="submit-btn">
                            <button type="submit" wire:loading.attr="disabled" class="btn mt-0">
                                Change Password
                                <span wire:loading wire:target="updatePassword">
                                    <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                                </span>
                            </button>
                        </div>
                        </form>                          
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(".form-group .toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
</script>
@endpush
      