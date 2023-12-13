@extends('layouts.admin')
@section('title','Lectures')

@section('styles')
@stop

@section('content')

    @livewire('user.my-courses.lectures',['package_uuid'=>$package_uuid,'slug'=>$slug])

@stop

@section('scripts')
@stop