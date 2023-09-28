<section class="ptb-120 faq-sec">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7 col-sm-12">
          <div class="other-sec-head text-center">
            <h2>frequently asked questions</h2>
            <div class="section-text body-size-normal">
              <p>It is an e-learning platform where you can learn different type of skills that will be helpful to create a better future for you.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-10 col-sm-12">
          <div class="faq-accordion">
            <div class="accordion" id="accordionExample">
              @if($allFaqs)
                @foreach($allFaqs as $faq_key=>$faq)
                  <div class="accordion-item">
                    <a href="javascript:void(0);" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$faq->id}}" aria-expanded="true" aria-controls="collapse-{{$faq->id}}">
                      {{ $faq->question }}
                    </a>
                    <div id="collapse-{{$faq->id}}" class="accordion-collapse collapse {{($faq_key == 0) ? 'show':''}}" data-bs-parent="#accordionExample">
                      <div class="accordion-body">

                        {!! $faq->answer !!}

                      </div>
                    </div>
                    <div class="bacdrops"></div>
                  </div>
                @endforeach
              @endif
    
            </div>
          </div>
        </div>
      </div>
    </div>
</section>