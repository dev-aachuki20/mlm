@extends('layouts.front')
@section('title','User License Agreement')

@section('styles')
@stop

@section('content')

    <section class="other-page-banner bg-light-orange">
        <div class="container">
            <div class="row justify-content-between">
            <div class="col-lg-6 col-sm-12 align-self-center">
                <div class="other-page-text">
                <h1>User License Agreement</h1>
                <div class="section-text body-size-normal">
                    <p></p>
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

    @livewire('frontend.pages.other.license-agreement')

    @livewire('frontend.sections.get-in-touch')

@stop

@section('script')
@stop