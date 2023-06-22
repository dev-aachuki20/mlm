<section class="ptb-120 bg-dark-blue our-testimonial">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
          <div class="other-sec-head text-center">
            <h2 class="text-white">Testimonial</h2>
            <div class="section-text body-size-normal text-white">
              <p>It Is An E-Learning Platform Where You Can Learn Different Type Of Skills That Will Be Helpful To Create A Better Future For You.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <div class="testimonial-slider-outer">
            <div id="testimonial-slider" class="owl-carousel">
              @if($allTestimonial)
                 @foreach($allTestimonial as $testimonial)
                 <div class="owl-slide testimonial-details bg-white">
                    <div class="testimonial-img">
                      <img src="{{ $testimonial->image_url }}">
                    </div>
                    <div class="author-name body-size-large">{{ ucwords($testimonial->name) }}</div>
                      <div class="author-rating d-flex">
                        @php
                           $rating = (int)$testimonial->rating;
                        @endphp
                        @for($i=1; $i<=5; $i++)
                            @if($i <= $rating)
                              <img src="{{ asset('images/Star.svg') }}">
                            @else
                              <img src="{{ asset('images/Star-Border.svg') }}">
                            @endif
                        @endfor
                        
                      </div>
                    <div class="testimonial-dis">
                      {!! $testimonial->description !!}
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