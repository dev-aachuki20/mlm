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
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    
    @include('partials.admin.css')    

    @livewireStyles

    @yield('styles') 
</head>
<body>
    <div class="container-scroller">
    
            @include('partials.admin.header')

        <div class="container-fluid page-body-wrapper">

         @include('partials.admin.admin_sidebar')

        <div class="main-panel">
            <!-- content-wrapper start -->
                @yield('content')
            <!-- content-wrapper ends -->

            <!-- partial:partials/_footer -->
            <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">©{{ date('Y') }} {{ config('constants.app_name') }}, LLC. All Rights Reserved. 
                 <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Developed by <i class="ti-heart text-danger ml-1"></i> HIPL</span>
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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script> 

    <x-livewire-alert::flash />
    
    @yield('scripts') 

</body>
</html>
<!-- new -->

