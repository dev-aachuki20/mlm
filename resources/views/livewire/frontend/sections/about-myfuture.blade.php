<section class="ptb-120 pb-227 about-myfuture bg-white">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-sm-12">
          <div class="about-img">
            @if($section->image1_url)
            <img src="{{ $section->image1_url }}"/>
            @else
            <img src="{{ asset('images/about.png') }}">
            @endif
            <div class="about-experience bg-dark-blue text-white">
              <h2 class="text-white">
                <span class="outline-text">{{ $section->year_experience?? '' }}</span>
                Year’s
                <span class="f-39">Experience</span>
              </h2>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12">
          <div class="home-about-text">
            <h2>{!! ucwords($section->name) !!}</h2>
            <div class="section-text ">
                {!! $section->description !!}
            </div>
            <ul class="list large-list">
                {!! ucwords($section->features) !!}
            </ul>
          </div>
        </div>
      </div>
    </div>
</section>
