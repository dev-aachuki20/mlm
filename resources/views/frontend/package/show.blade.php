@extends('layouts.front')
@section('title','Package')

@section('styles')
@stop

@section('content')

    @livewire('frontend.pages.package.show',['uuid'=>$uuid])

    @livewire('frontend.sections.get-in-touch')

@stop

@section('script')
@stop