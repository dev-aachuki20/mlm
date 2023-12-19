@extends('auth.admin.layout')
@section('title','Payment Success')

@section('content')

  {{-- @if(isset($phonePeObject))
     
  @dd(isset($phonePeObject),$phonePeObject,$input);

  @else --}}
     @livewire('auth.payment-success')
   {{-- @endif  --}}

@stop
