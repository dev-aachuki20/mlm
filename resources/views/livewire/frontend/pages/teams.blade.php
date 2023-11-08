<div>
    <section class="other-page-banner bg-light-orange">
        <div class="container">
          <div class="row justify-content-between">
            <div class="col-lg-7 col-sm-12 align-self-center">
              <div class="other-page-text">
                <h1>{{ $pageDetail ? ucwords($pageDetail->title) : 'Title' }}</h1>
                <div class="section-text body-size-normal">
                  <p>{{  $pageDetail ? $pageDetail->sub_title : '' }}</p>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-sm-12 align-self-end">
              <div class="other-page-img">
                <img src="{{  $pageDetail ? $pageDetail->slider_image_url : asset(config('constants.no_image_url'))  }}">
              </div>
            </div>
          </div>
        </div>
    </section>

    <section class="ptb-120 meet-team">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-sm-12">
              <div class="founder-details plr-68">
                <div class="align-self-center founder-meet">
                  <h3>Meet Our Founder</h3>
                  <div class="section-text">
                    <p>The vision of {{config('constants.app_name')}} is to develop entrepreneurial mindset & create financially independent.</p>
                  </div>
                </div>
                <div class="founder-details-outer">
                  <div class="founder-img">
                    <img src="{{ $ceoUserDetail->profile_image_url }}">
                  </div>
                  <div class="founder-about">
                    <label class="color-orange body-size-normal">Founder</label>
                    <h4>{{ ucwords($ceoUserDetail->name) }}</h4>
                    <div class="section-text">
                      <p>He Is An Entreprenuer, Trainer & Youtuber. He Has 3 Years Plus Experience In Sales And Marketing.</p>
                    </div>
                    <div class="founder-social">
                      <ul>
                        <li>
                          <a href="#">
                            <div class="social-icon">
                              <img src="{{asset('images/youtube.svg')}}">
                            </div>
                            <div class="social-type">
                              <h6 class="color-dark-blue"><span class="color-dark-gray">My Channel On</span>Youtube</h6>
                            </div>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="social-icon">
                              <img src="{{ asset('images/instagram.svg')}}">
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
            </div>
          </div>
        </div>
      </section>
      <section class="management-team pb-120">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-sm-12">
              <div class="other-sec-head text-center">
                <h2>Management Team</h2>
                <div class="section-text body-size-normal">
                  <p>The vision of {{config('constants.app_name')}} is to develop entrepreneurial mindset and create financially independent person's excellent.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="management-team-outer">
            <div class="row">

                @if($managementTeams)
                @foreach($managementTeams as $team)
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="team-member-details bg-light-orange">
                      <div class="team-member">
                        <img src="{{ $team->profile_image_url }}">
                      </div>
                      <div class="team-member-data">
                        <h6>{{ ucwords($team->name) }}</h6>
                        <p>{{ $team->roles()->first()->title }}</p>
                      </div>
                    </div>
                  </div>
                @endforeach
                @endif


            </div>
          </div>
        </div>
      </section>
</div>
