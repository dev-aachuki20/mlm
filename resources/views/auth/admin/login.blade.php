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
  <link rel="stylesheet" href="{{ asset('admin/assets/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('admin/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  
  <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}" />


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
  <script src="{{ asset('admin/assets/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin/js/template.js') }}"></script>
  <script src="{{ asset('admin/vendor/livewire-alert/livewire-alert.js') }}"></script> 

  @livewireScripts

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script src="{{ asset('admin/vendor/livewire-alert/livewire-alert.js') }}"></script> 

  <x-livewire-alert::flash />
  
</body>

</html>
