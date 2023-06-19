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
            <p>Find your login detail below & on your mail.</p>
            <ul>
              <li><span>Username : </span>XXXXXXXXX</li>
              <li><span>Password : </span>XXXXXXXXX</li>
            </ul>
          </div>
          <div class="go-back mb-0">
            <a class="btn w-100 text-center back-login" href="{{ route('auth.login') }}">login Now</a>
          </div>
        </div>
      </div>
    </section>
</div>
