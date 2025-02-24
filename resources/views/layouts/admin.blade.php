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
    <link rel="shortcut icon" href="{{ getSetting('favicon') ? getSetting('favicon') : asset(config('constants.default.favicon')) }}" type="image/x-icon">
    
    @include('partials.admin.css')    

    
    @livewireStyles

    @stack('styles')
</head>
<body>
    <div class="container-scroller">
    
        @livewire('partials.admin.header')

        <div class="container-fluid page-body-wrapper">

        @if(auth()->user()->is_super_admin || auth()->user()->is_admin || auth()->user()->is_management)

            @include('partials.admin.admin_sidebar')

        @elseif(auth()->user()->is_user)

            @include('partials.admin.user_sidebar')

        @endif
        

        <div class="main-panel">
            <!-- content-wrapper start -->
                @yield('content')
            <!-- content-wrapper ends -->

            <!-- partial:partials/_footer -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{ date('Y') }} <a href="{{ route('front.home') }}" target="_blank">{{ config('app.name') }}</a> All rights reserved.</span>
                    
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
        
    </div>
    <!-- container-scroller -->
  
    @include('partials.admin.js')

   
    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script> 

    <x-livewire-alert::flash />

    @stack('scripts')

</body>
</html>
<!-- new -->

