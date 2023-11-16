<section class="ptb-120 bg-dark-blue our-work-sec">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12 align-self-center">
          <div class="other-sec-head">
            <h2 class="text-white">How <span class="color-orange">{{config('constants.app_name')}}</span> Works?</h2>
            <div class="section-text body-size-normal text-white">
              <p>Influencing traffic to buy your products or services comes with a promise of quality.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12">
          <div class="our-works">
            <ul>
              <li>
                <div class="our-works-box">
                  <div class="our-works-icon">
                    <img src="{{ asset('images/icon-1.svg') }}">
                  </div>
                  <div class="our-works-text">
                    <h5 class="text-white">Join Program</h5>
                    <a href="{{ getSetting('join_program_link') }}" target="_blank" class="text-white">Enroll yourself with any suitable course package.</a>
                  </div>
                </div>
                <div class="our-works-count">
                  <span class="outline-text">01</span>
                </div>
              </li>
              <li>
                <div class="our-works-box">
                  <div class="our-works-icon">
                    <img src="{{ asset('images/icon-2.svg') }}">
                  </div>
                  <div class="our-works-text">
                    <h5 class="text-white">Promote Links</h5>
                    <a href="{{ getSetting('promote_link') }}" target="_blank" class="text-white">Enroll yourself with any suitable course package.</a>
                  </div>
                </div>
                <div class="our-works-count">
                  <span class="outline-text">02</span>
                </div>
              </li>
              <li>
                <div class="our-works-box">
                  <div class="our-works-icon">
                    <img src="{{ asset('images/icon-3.svg') }}">
                  </div>
                  <div class="our-works-text">
                    <h5 class="text-white">Earn Money</h5>
                    <a href="{{ getSetting('earn_money_link') }}" target="_blank" class="text-white">Enroll yourself with any suitable course package.</a>
                  </div>
                </div>
                <div class="our-works-count">
                  <span class="outline-text">03</span>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
</section>
