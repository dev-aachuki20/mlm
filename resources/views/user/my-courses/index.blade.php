@extends('layouts.admin')
@section('title','My Courses')

@section('styles')
@stop

@section('content')

    @livewire('user.my-courses.index',['uuid'=>$uuid])

@stop

@section('scripts')
@stop
