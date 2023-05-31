<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="" />
  <meta name="keywords" content="">
  <meta name="author" content="HIPL" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ trans('global.login') }}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin/custom.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />

  @livewireStyles
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        @livewire('auth.admin.login')
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('assets/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script> 

  @livewireScripts

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script> 

  <x-livewire-alert::flash />
  
</body>

</html>
