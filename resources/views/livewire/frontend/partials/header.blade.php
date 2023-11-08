<header class="header-main">
    <div class="header-top">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 col-sm-6 col-8">
            <div class="logo">
              <a href="{{ route('front.home') }}">
                @if(getSetting('site_logo'))
                <img src="{{ getSetting('site_logo') }}" class="mr-2" alt="logo"/>
                @else
                <img src="{{ asset(config('constants.default.logo')) }}" class="mr-2" alt="logo"/>
                @endif
              </a>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-4">
            <div class="login-signup button-group justify-content-end desktop-login">

                @if(auth()->check())
                    @if(auth()->user()->is_user)
                        <a href="{{ route('user.dashboard') }}" class="btn fill">Dashboard</a>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="btn fill">Dashboard</a>
                    @endif

                    <a href="javascript:void(0)" wire:click.prevent="authLogout" class="btn fill">Logout!</a>
                @else
                    <a href="{{ route('auth.login') }}" class="btn fill">Login Now!</a>
                    <a href="{{ route('auth.register') }}" class="btn outline-btn">Join Now!</a>
                @endif

            </div>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav m-auto">
            <li class="nav-item">
               <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="{{ route('front.home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}" href="{{ route('front.about-us') }}">About us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('how-biz-shiksha-works') ? 'active' : '' }}" href="{{ route('front.how-myfuturebiz-works') }}">how {{config('constants.app_name')}} Works</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('teams') ? 'active' : '' }}" href="{{ route('front.teams') }}">Founder & Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('testimonials') ? 'active' : '' }}" href="{{ route('front.testimonials') }}">Testimonials</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}" href="{{ route('front.contact-us') }}">Get in Touch</a>
            </li>
          </ul>
          <div class="login-signup button-group justify-content-end mobile-login">
                @if(auth()->check())
                    @if(auth()->user()->is_user)
                        <a href="{{ route('user.dashboard') }}" class="btn fill">Dashboard</a>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="btn fill">Dashboard</a>
                    @endif

                    <a href="javascript:void(0)" wire:click.prevent="authLogout" class="btn fill">Logout!</a>
                @else
                    <a href="{{ route('auth.login') }}" class="btn fill">Login Now!</a>
                    <a href="{{ route('auth.register') }}" class="btn outline-btn">Join Now!</a>
                @endif
          </div>
        </div>
      </div>
    </nav>
  </header>
