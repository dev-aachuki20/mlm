@extends('layouts.front')
@section('title','About Us')

@section('styles')
@stop

@section('content')

    <section class="other-page-banner bg-light-orange">
        <div class="container">
            <div class="row justify-content-between">
            <div class="col-lg-6 col-sm-12 align-self-center">
                <div class="other-page-text">
                <h1>About Us</h1>
                <div class="section-text body-size-normal">
                    <p>The vision of MyFutureBiz is to develop entrepreneurial mindset and create financially independent person's excellent.</p>
                </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12 align-self-end">
                <div class="other-page-img">
                <img src="{{ asset('images/contact-img.png') }}">
                </div>
            </div>
            </div>
        </div>
    </section>

    @livewire('frontend.sections.about-myfuture')

    @livewire('frontend.sections.services')

    @livewire('frontend.sections.why-myfuturebiz')

    @livewire('frontend.sections.work-section')

    @livewire('frontend.sections.teams')

    @livewire('frontend.sections.about-packages')

    @livewire('frontend.sections.testimonials')

    @livewire('frontend.sections.get-in-touch')

@stop

@section('script')
@stop