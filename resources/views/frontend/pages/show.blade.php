@extends('layouts.front')
@section('title',ucwords($page->title))

@section('styles')
@stop

@section('content')

    <section class="other-page-banner bg-light-orange">
        <div class="container">
            <div class="row justify-content-between">
            <div class="col-lg-6 col-sm-12 align-self-center">
                <div class="other-page-text">
                <h1>{{ ucwords($page->title) }}</h1>
                <div class="section-text body-size-normal">
                    <p>{{ $page->sub_title ?? ''}}</p>
                </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12 align-self-end">
                <div class="other-page-img">
                  <img src="{{  $page ? $page->slider_image_url : asset(config('constants.no_image_url'))  }}">
                </div>
            </div>
            </div>
        </div>
    </section>

  
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 col-sm-12">
            <div class="other-sec-head">
              <div class="section-text body-size-normal mt-5">

                {!! $page->description !!}

              </div>
            </div>
          </div>
        </div>
    </div>
    

    @livewire('frontend.sections.get-in-touch')

@stop

@section('script')
@stop