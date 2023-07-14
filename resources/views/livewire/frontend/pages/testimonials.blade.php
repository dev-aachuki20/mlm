<div>
    <section class="other-page-banner bg-light-orange">
        <div class="container">
          <div class="row justify-content-between">
            <div class="col-lg-6 col-sm-12 align-self-center">
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

    @if(auth()->check() && (!auth()->user()->testimonial()->exists()))
    <section class="contact-form ptb-120 bg-white">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="contact-form-inner">
                <div class="other-sec-head">
                  <h2>Write a   <span class="color-orange">Review!</span></h2>
                  <div class="section-text">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                  </div>
                </div>
                <form class="form" wire:submit.prevent="storeReview">            
                  <div class="form-outer">
                    <div class="form-group mb-20">
                      <span class="label">Overall rating</span>
                      <div class="stars">
                        <label class="rate">
                          <input type="radio" wire:model.defer="rating" name="radio1" id="star1" value="1">
                          <i class="far fa-star star one-star"></i>
                        </label>
                        <label class="rate">
                          <input type="radio" wire:model.defer="rating" name="radio1" id="star2" value="2">
                          <i class="far fa-star star two-star"></i>
                        </label>
                        <label class="rate">
                          <input type="radio" wire:model.defer="rating" name="radio1" id="star3" value="3">
                          <i class="far fa-star star three-star"></i>
                        </label>
                        <label class="rate">
                          <input type="radio" wire:model.defer="rating" name="radio1" id="star4" value="4">
                          <i class="far fa-star star four-star"></i>
                        </label>
                        <label class="rate">
                          <input type="radio" wire:model.defer="rating" name="radio1" id="star5" value="5">
                          <i class="far fa-star star five-star"></i>
                          {{-- <i class="far fa-star star five-star star-over"></i> --}}
                        </label>
                      </div>
                      @error('rating') <span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <div class="input-form">
                        <label class="form-label">Review Here</label>
                        <textarea class="form-control" wire:model="description"  placeholder="Write Your Review" ></textarea>
                        @error('description') <span class="error text-danger">{{ $message }}</span>@enderror

                      </div>
                    </div>
                  </div>
                  <div class="submit-btn">
                    <button type="submit" class="btn fill" wire:loading.attr="disabled">Submit review 
                      <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 11L13 6L8 1" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round" />
                        <path d="M1 11L6 6L1 1" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round" />
                      </svg>

                        <span wire:loading wire:target="storeReview">
                            <i class="ml-1 fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                        </span>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </section>
    @endif

    <section class="all-testimonial-sec ptb-120">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-sm-12">
              <div class="other-sec-head text-center">
                <h2>Testimonials</h2>
                <div class="section-text body-size-normal">
                  <p>It Is An E-Learning Platform Where You Can Learn Different Type Of Skills That Will Be Helpful To Create A Better Future For You.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row testimonial-outer">
            @foreach ($testimonials as $testimonial)
         
            @if(auth()->check() && auth()->user()->testimonial()->exists() && auth()->user()->testimonial()->first()->status == 0)
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="testimonial-details bg-white">
                <div class="testimonial-img">
                  <img src="{{ $testimonial->user->profile_image_url ? $testimonial->user->profile_image_url : asset(config('constants.default_user_logo')) }}">
                </div>
                <div class="author-name body-size-large">{{ ucfirst($testimonial->user->name) }}</div>
                <div class="author-rating">
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
                  <p>{{ $testimonial->description }}</p>
                    <span class="badge bg-secondary float-right">Pending</span>
                </div>
              </div>
            </div>
            @elseif($testimonial->status)
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="testimonial-details bg-white">
                <div class="testimonial-img">
                  <img src="{{ $testimonial->user->profile_image_url ? $testimonial->user->profile_image_url : asset(config('constants.default_user_logo')) }}">
                </div>
                <div class="author-name body-size-large">{{ ucfirst($testimonial->user->name) }}</div>
                <div class="author-rating">
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
                  <p>{{ $testimonial->description }}</p>
                </div>
              </div>
            </div>
            @endif

            @endforeach
          </div>

          @if ($testimonials->hasMorePages())
          <div class="row justify-content-center">
            <div class="col-lg-4">
              <div class="button-group mt-60 justify-content-center">
                <a href="javascript:void(0);" wire:click="loadMore" class="btn fill" wire:loading.attr="disabled">
                  View More
                  <span wire:loading wire:target="loadMore">
                      <i class="ml-1 fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>
          @endif
          
        </div>
    </section>

</div>
@push('scripts')
<script type="text/javascript">
    $(function() {
     
       $(document).on({
         mouseover: function(event) {
           $(this).find('.far').addClass('star-over');
           $(this).prevAll().find('.far').addClass('star-over');
         },
         mouseleave: function(event) {
           $(this).find('.far').removeClass('star-over');
           $(this).prevAll().find('.far').removeClass('star-over');
         }
       }, '.rate');
   
   
       $(document).on('click', '.rate', function() {
         if ( !$(this).find('.star').hasClass('rate-active') ) {
           $(this).siblings().find('.star').addClass('far').removeClass('fas rate-active');
           $(this).find('.star').addClass('rate-active fas').removeClass('far star-over');
           $(this).prevAll().find('.star').addClass('fas').removeClass('far star-over');
         } else {
        //    console.log('has');
         }
       });
       
    });
</script>
@endpush
