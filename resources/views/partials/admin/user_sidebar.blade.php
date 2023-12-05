<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->is('user/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.dashboard') }}">
                <img src="{{ asset('images/icons/dash.svg') }}" alt="dashboard">
                <span class="menu-title">{{__('global.dashboard')}}</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('user/kyc') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.kyc') }}">
                <img src="{{ asset('images/icons/kyc.svg') }}" alt="kyc">
                <span class="menu-title">KYC</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('user/myteam') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.myteam') }}">
                <img src="{{ asset('images/icons/my-team.svg') }}" alt="my team">
                <span class="menu-title">MyTeam</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('user/statement') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.statement') }}">
                <img src="{{ asset('images/icons/my-team.svg') }}" alt="my team">
                <span class="menu-title">Statements</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('user/leaderboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.leaderboard') }}">
                <img src="{{ asset('images/icons/leaderboard.svg') }}" alt="leader board">
                <span class="menu-title">Leaderboard</span>
            </a>
        </li>

        @if(getDynamicPages(4)->count() > 0)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic-growth" aria-expanded="false" aria-controls="ui-basic-growth">
                <img src="{{ asset('images/icons/growth-panel.svg') }}" alt="growth-panel">
                <span class="menu-title">Growth Panel</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic-growth">
                <ul class="nav flex-column sub-menu">
                    @foreach(getDynamicPages(4) as $page)
                    <li class="nav-item {{ request()->is('user/'.$page->slug) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('user.page',$page->slug) }}">
                            <!-- <i class="icon-grid menu-icon ti-package"></i> -->
                            <span class="menu-title">{{ ucwords($page->title) }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </li>
        @endif

        @if(getDynamicPages(5)->count() > 0)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic-reward" aria-expanded="false" aria-controls="ui-basic-reward">
                <img src="{{ asset('images/icons/rewards.svg') }}" alt="rewards">
                <span class="menu-title">Rewards</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic-reward">
                <ul class="nav flex-column sub-menu">
                    @foreach(getDynamicPages(5) as $page)
                    <li class="nav-item {{ request()->is('user/'.$page->slug) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('user.page',$page->slug) }}">
                            <!-- <i class="icon-grid menu-icon ti-package"></i> -->
                            <span class="menu-title">{{ ucwords($page->title) }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </li>
        @endif

        <li class="nav-item {{ request()->is('user/webinar') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.webinar') }}">
                <img src="{{ asset('images/icons/webinar.svg') }}" alt="webinar">
                <span class="menu-title">Webinar</span>
            </a>
        </li>


        <li class="nav-item {{ request()->is('user/invoice') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.invoice') }}">
                <img src="{{ asset('images/icons/invoice.svg') }}" alt="invoice">
                <span class="menu-title">Invoice</span>
            </a>
        </li>


        <li class="nav-item {{ request()->is('user/referral-link') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.referral-link') }}">
                <img src="{{ asset('images/icons/referral-link.svg') }}" alt="referral link">
                <span class="menu-title">Referral Link</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('user/customer-support') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.customer-support') }}">
                <img src="{{ asset('images/icons/customer-support.svg') }}" alt="customer support">
                <span class="menu-title">Customer Support</span>
            </a>
        </li>

        @livewire('auth.admin.sidebar-logout')
    </ul>
</nav>