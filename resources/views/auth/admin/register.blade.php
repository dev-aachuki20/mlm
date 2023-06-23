@extends('auth.admin.layout')
@section('title','Sign Up')

@section('content')

    @php 
      $referralId = '';
      if(isset($referral_id)){
        $referralId = $referral_id;
      }
      
      $packageUUID = '';
      if(isset($package_uuid)){
        $packageUUID = $package_uuid;
      }
    @endphp

    @livewire('auth.admin.register',['referralId'=>$referralId,'packageUUID'=>$packageUUID])

@stop
