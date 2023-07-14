<section class="ptb-120 meet-team">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-sm-12">
          <div class="other-sec-head">
            <h2>Founders & Management Team</h2>
            <div class="section-text body-size-normal">
              <p>It Is An E-Learning Platform Where You Can Learn Different Type Of Skills That Will Be Helpful To Create A Better Future For You.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-sm-12">
          <div class="d-flex justify-content-end">
            <div class="button-group">
              <a href="{{ route('front.teams') }}" class="btn fill">Learn More 
                <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8 11L13 6L8 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M1 11L6 6L1 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-7 col-sm-12">
          <div class="founder-details">
            <div class="founder-img">
              <img src="{{ $ceoUserDetail->profile_image_url ? $ceoUserDetail->profile_image_url : asset(config('constants.default_user_logo')) }}">
            </div>
            <div class="founder-about">
              <label class="color-orange body-size-normal">Founder</label>
              <h4>{{ ucwords($ceoUserDetail->name) }}</h4>
              <div class="section-text">
                <p>{!! getSetting('founder_description') !!}</p>
              </div>
              <div class="founder-social">
                <ul>
                  <li>
                    <a href="{{ getSetting('youtube') }}">
                      <div class="social-icon">
                        <img src="{{ asset('images/youtube.svg') }}">
                      </div>
                      <div class="social-type">
                        <h6 class="color-dark-blue"><span class="color-dark-gray">My Channel On</span>Youtube</h6>                        
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="{{ getSetting('instagram') }}">
                      <div class="social-icon">
                        <img src="{{ asset('images/instagram.svg') }}">
                      </div>
                      <div class="social-type">
                        <h6 class="color-dark-blue"><span class="color-dark-gray">Follow Me On</span>Instagram</h6>                        
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-sm-12">
          <div class="our-team-slider">
            <div id="team-slider" class="owl-carousel">

                @if($managementTeams)
                @foreach($managementTeams as $team)
                  <div class="owl-slide team-member-details bg-light-orange">
                    <div class="team-member">
                      <img src="{{ $team->profile_image_url }}">
                    </div>
                    <div class="team-member-data">
                      <h6>{{ ucwords($team->name) }}</h6>
                      <p>{{ $team->roles()->first()->title }}</p>
                    </div>
                  </div>
                @endforeach
                @endif
                
            </div>
            <div class="custom-nav owl-nav"></div>
          </div>
        </div>
      </div>
    </div>
</section>