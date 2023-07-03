<nav class="sidebar sidebar-offcanvas" id="sidebar">
<ul class="nav">
    <li class="nav-item {{ request()->is('user/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.dashboard') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">{{__('global.dashboard')}}</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('user/kyc') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.kyc') }}">
            <i class="fa fa-address-card icon-grid menu-icon"></i>
            <span class="menu-title">KYC</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('user/myteam') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.myteam') }}">
            <i class="fa fa-users icon-grid menu-icon"></i>
            <span class="menu-title">MyTeam</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('user/leaderboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.leaderboard') }}">
            <i class="fa fa-server icon-grid menu-icon"></i>
            <span class="menu-title">Leaderboard</span>
        </a>
    </li>

    @livewire('auth.admin.sidebar-logout')
</ul>
</nav>