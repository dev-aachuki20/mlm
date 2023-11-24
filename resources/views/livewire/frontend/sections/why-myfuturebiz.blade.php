<section class="ptb-120 why-myfuturebuz">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-sm-12">
          <div class="other-sec-head">
            <h2>{!! ucwords($section->name) !!}</h2>
            <div class="section-text body-size-small">
                {!! $section->description !!}
            </div>
            <ul class="list large-list">
                {!! ucwords($section->features) !!}
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12">
          <div class="why-fir-img">
            @if($section->image1_url)
                <img src="{{ $section->image1_url }}"/>
            @else
                <img src="{{ asset('images/why-fir.png') }}">
            @endif
            <div class="arrow-img">
              <img src="{{ asset('images/arrow-why.png')}}">
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-50">
        <div class="col-md-12 col-sm-12">
          <div class="why-myfuturebuz-counter">
            <ul id="counter">
              <li class="bg-light-orange">
                <div>
                  <div class="count-data">
                    <span class="count percent" data-count="{{ getSetting('total_trainers') }}">0</span>
                  </div>
                  <label>{{ getSettingDisplayName('total_trainers') }} </label>
                </div>
              </li>
              <li class="bg-light-orange">
                <div>
                  <div class="count-data">
                    <span class="count percent" data-count="{{ getSetting('students_enrolled') }}">0</span>
                  </div>
                  <label>{{ getSettingDisplayName('students_enrolled') }}</label>
                </div>
              </li>
              <li class="bg-light-orange">
                <div>
                  <div class="count-data">
                    <span class="count percent" data-count="{{ getSetting('live_training') }}">0</span>
                  </div>
                  <label>{{ getSettingDisplayName('live_training') }}</label>
                </div>
              </li>
              <li class="bg-light-orange">
                <div>
                  <div class="count-data">
                    <span class="count percent" data-count="{{ getSetting('community_earning') }}">0</span>
                  </div>
                  <label>{{ getSettingDisplayName('community_earning') }}</label>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
</section>
