<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo mr-2" href="{{ route('front.home') }}">

        @if(getSetting('site_logo'))
        <img src="{{ getSetting('site_logo') }}"  alt="logo"/>
        @else
        <img src="{{ asset(config('constants.default.logo')) }}"  alt="logo"/>
        @endif

      </a>
      <a class="navbar-brand brand-logo-mini" href="{{ route('front.home') }}">
        @if(getSetting('short_logo'))
        <img src="{{ getSetting('short_logo') }}" alt="logo-mini"/>
        @else
        <img src="{{ asset(config('constants.default.short_logo')) }}" alt="logo-mini"/>
        @endif
    </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
      <ul class="navbar-nav m-auto menubar">
        @if(!(auth()->user()->is_super_admin || auth()->user()->is_admin))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('front.home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('front.about-us') }}">About us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);">My Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('front.testimonials') }}">Testimonials</a>
        </li>
        @endif
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            <span class="profile-img">

                @if($profileImageUrlUpdated)
                    <img src="{{ isset(auth()->user()->profile_image_url) ? auth()->user()->profile_image_url : asset(config('constants.default.profile_image')) }}" class="usericon img-fluid" alt="profile">
                @else
                    <img src="{{ isset(auth()->user()->profile_image_url) && !empty(auth()->user()->profile_image_url) ? auth()->user()->profile_image_url : asset(config('constants.default.profile_image')) }}" alt="profile"/>
                @endif
                
            </span>
            <div class="profile-name">
                @php
                    $profileRoute = '';
                    if(auth()->user()->is_super_admin || auth()->user()->is_admin){
                        $profileRoute = 'auth.admin-profile';
                    }else if(auth()->user()->is_user){
                        $profileRoute = 'auth.user-profile';
                    }
                @endphp
              <span>welcome</span>
              <h5>{{ ucwords(auth()->user()->name) }}</h5>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

            @if(auth()->user()->is_super_admin)
            <a class="dropdown-item" href="{{ route('admin.setting') }}">
                <i class="ti-settings text-primary"></i> Setting
            </a>
            @endif

            @livewire('auth.admin.logout')
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
      </button>
    </div>
</nav>

