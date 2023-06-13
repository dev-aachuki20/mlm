@extends('auth.admin.layout')
@section('title','Sign Up')

@section('content')

    @php 
      $referralId = '';
      if(isset($referral_id)){
        $referralId = $referral_id;
      }
    @endphp

    @livewire('auth.admin.register',['referralId'=>$referralId])

@stop
