<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="HIPL" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset(config('constants.default.favicon')) }}" type="image/x-icon">
    
    @include('partials.frontend.css')    

    @livewireStyles

    @stack('styles')
</head>
<body>
    @livewire('frontend.partials.header')

        @yield('content')

    @livewire('frontend.partials.footer')

    @include('partials.frontend.js')

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script> 

    <x-livewire-alert::flash />

    @stack('scripts')
    
</body>
</html>