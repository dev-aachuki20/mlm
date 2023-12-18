@extends('auth.admin.layout')
@section('title','Payment Success')

@section('content')

  @if(isset($phonePeObject))
      @dd($phonePeObject);
   @else
     @livewire('auth.payment-success')
   @endif 

@stop
