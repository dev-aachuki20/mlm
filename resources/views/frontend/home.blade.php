@extends('layouts.front')
@section('title','Home')

@section('styles')
@stop

@section('content')

    @livewire('frontend.sections.slider')

    @livewire('frontend.sections.about-myfuture')

    @livewire('frontend.sections.about-packages')

    @livewire('frontend.sections.work-section')

    @livewire('frontend.sections.why-myfuturebiz')

    @livewire('frontend.sections.teams')

    @livewire('frontend.sections.testimonials')

    @livewire('frontend.sections.faq')

    @livewire('frontend.sections.get-in-touch')

@stop

@section('script')
@stop