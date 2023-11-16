<section class="ptb-120 bg-dark-blue our-services">
<div class="container">
    <div class="our-services-head">
    <div class="row">
        <div class="col-lg-7 col-sm-12">
        <div class="other-sec-head">
            <h2 class="text-white">Our Services</h2>
        </div>
        </div>
    </div>
    </div>
    <div class="our-services-list">
    <div class="row">
        @foreach ($services as $service)
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="our-services-box">
                <div class="services-icon">
                <img src="{{ $service->image_url }}">
                </div>
                <h4 class="text-white">{{ ucwords($service->title)}}</h4>
                <div class="section-text">
                <p>{{ ucwords($service->sub_title)}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>
</div>
</section>
