@extends('layouts.admin')
@section('title','Course')

@section('styles')
@stop

@section('content')

    @livewire('admin.video-group.index',['course_id'=>$course_id])

@stop

@section('script')
@stop