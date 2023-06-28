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

    @livewire('frontend.sections.why-myfuturebiz')

    @livewire('frontend.sections.work-section')

</div>
