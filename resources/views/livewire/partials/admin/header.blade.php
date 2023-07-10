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
          <a class="nav-link {{ request()->is('user/my-courses') ? 'active' : '' }}" href="{{ route('user.my-courses') }}">My Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('front.testimonials') }}">Testimonials</a>
        </li>
        @endif
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown" id="profileDropdown">
            <span class="profile-img">

                @if($profileImageUrlUpdated)
                    <img src="{{ isset(auth()->user()->profile_image_url) ? auth()->user()->profile_image_url : asset(config('constants.default.profile_image')) }}" class="usericon img-fluid" alt="profile">
                @else
                    <img src="{{ isset(auth()->user()->profile_image_url) && !empty(auth()->user()->profile_image_url) ? auth()->user()->profile_image_url : asset(config('constants.default.profile_image')) }}" alt="profile"/>
                @endif
                
            </span>
            <div class="profile-name">
              <span>Welcome</span>
              <h5>{{ ucwords(auth()->user()->name) }}</h5>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            @php
                $profileRoute = '';
                $changePasswordRoute = '';
                if(auth()->user()->is_super_admin || auth()->user()->is_admin || auth()->user()->is_management || auth()->user()->is_ceo){
                    $profileRoute = 'auth.admin-profile';
                    $changePasswordRoute = 'auth.admin-change-password';
                }else if(auth()->user()->is_user){
                    $profileRoute = 'auth.user-profile';
                    $changePasswordRoute = 'auth.user-change-password';
                }
            @endphp
            <ul>
              <li>
                <a href="{{ route($profileRoute) }}" class="dropdown-item {{ (request()->is('admin/profile') || request()->is('user/profile')) ? 'active' : '' }}">
                  <img src="{{ asset('images/icons/user.svg') }}">
                  My Profile
                </a>
              </li>

              @if(auth()->user()->is_user)
              <li>
                <a href="{{ route('user.my-courses') }}" class="dropdown-item {{ request()->is('user/my-courses') ? 'active' : '' }}">
                  <img src="{{ asset('images/icons/my-course.svg') }}">
                  My Courses
                </a>
              </li>
              @endif

              <li>
                <a href="{{ route($changePasswordRoute) }}" class="dropdown-item {{ (request()->is('admin/change-password') || request()->is('user/change-password')) ? 'active' : '' }}">
                  <img src="{{ asset('images/icons/password.svg') }}">
                  Change Password
                </a>
              </li>
              <li>
                @livewire('auth.admin.logout')
              </li>
            </ul> 
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
      </button>
    </div>
</nav>

