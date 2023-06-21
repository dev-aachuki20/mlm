<div>
    <section class="login d-flex flex-wrap">
      <div class="login-left bg-white">
        <div class="login-left-inner">
            <div class="login-quote">
              <h4>Grow Your Skill With FutureBiz</h4>
              <p>it is an e-learning platform where you can learn different type of skills that will be helpful to create a better future for you.it is an e-learning platform where you can learn.</p>
            </div>
            <div class="login-img-left">
              <img src="{{ asset('images/login-left.png') }}" alt="login img">
            </div>
        </div>
      </div>
      <div class="login-right bg-light-orange">
        <div class="login-form">
          <div class="form-head mb-0">
            <div class="icon-head">
              <img src="{{ asset('images/icons/completed.svg') }}">
            </div>
            <h3>Payment Successful!</h3>
            <p> Here is your login detail below.</p>
            <ul>
              <li><span>Email : </span>{{ $email }}</li>
              <li><span>Password : </span>{{ $password }}</li>
            </ul>
          </div>
          <div class="go-back mb-0">
            <button class="btn w-100 text-center back-login " wire:click="submitLogin" wire:loading.attr="disabled">login Now
                    <span wire:loading wire:target="submitLogin">
                        <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                    </span>
            </button>
          </div>
        </div>
      </div>
    </section>
</div>
