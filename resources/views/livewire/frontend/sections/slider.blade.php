<section class="home-banner">
<div class="home-banner-outer">
    <div id="banner-slider" class="slider owl-carousel">

        @if($allBannerSlider)
         @foreach($allBannerSlider as $slider)
            <div class="owl-slide"> 
                <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-12 col-sm-12">
                    <div class="banner-img">
                        <img src="{{ $slider->image_url}}" alt="{{ $slider->name }}">
                    </div>
                    </div>
                </div>
                </div>
            </div>
         @endforeach
        @endif
    
    </div>
    <div id="counter" class="slider-counter"></div>  
    <div class="custom-nav owl-nav"></div>      
</div>
</section>
@push('scripts')
<script type="text/javascript">

</script>
@endpush