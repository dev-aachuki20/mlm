@extends('layouts.admin')
@section('title','Lectures')

@section('styles')
@stop

@section('content')

    @livewire('user.my-courses.lectures',['slug'=>$slug])

@stop

@section('scripts')
@stop