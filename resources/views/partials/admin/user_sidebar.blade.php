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

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic-growth" aria-expanded="false" aria-controls="ui-basic-growth">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Growth Panel</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic-growth">
            <ul class="nav flex-column sub-menu">
              @if(getDynamicPages(4)->count() > 0)
                @foreach(getDynamicPages(4) as $page)
                    <li class="nav-item {{ request()->is('user/'.$page->slug) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('user.page',$page->slug) }}">
                            <!-- <i class="icon-grid menu-icon ti-package"></i> -->
                            <span class="menu-title">{{ ucwords($page->title) }}</span>
                        </a>
                    </li>
                    @endforeach
               @endif
            </ul>
        </div>
    </li> 

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic-reward" aria-expanded="false" aria-controls="ui-basic-reward">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Rewards</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic-reward">
            <ul class="nav flex-column sub-menu">
              @if(getDynamicPages(5)->count() > 0)
                @foreach(getDynamicPages(5) as $page)
                    <li class="nav-item {{ request()->is('user/'.$page->slug) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('user.page',$page->slug) }}">
                            <!-- <i class="icon-grid menu-icon ti-package"></i> -->
                            <span class="menu-title">{{ ucwords($page->title) }}</span>
                        </a>
                    </li>
                    @endforeach
               @endif
            </ul>
        </div>
    </li> 

    @livewire('auth.admin.sidebar-logout')
</ul>
</nav>