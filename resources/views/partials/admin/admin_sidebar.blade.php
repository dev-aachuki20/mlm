<nav class="sidebar sidebar-offcanvas" id="sidebar">
<ul class="nav">
    <li class="nav-item {{ request()->is('admin/index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/icons/dash.svg') }}" alt="dashboard">
            <span class="menu-title">{{__('global.dashboard')}}</span>
        </a>
    </li>

    @if(auth()->user()->is_super_admin)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <img src="{{ asset('images/icons/growth-panel.svg') }}" alt="master">
                <span class="menu-title">Master</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    @can('package_access')
                    <li class="nav-item {{ request()->is('admin/packages') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.package') }}">
                            <!-- <i class="icon-grid menu-icon ti-package"></i> -->
                            <span class="menu-title">{{__('cruds.package.title')}}</span>
                        </a>
                    </li>
                    @endcan

                    @can('testimonial_access')
                    <li class="nav-item {{ request()->is('admin/testimonials') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.testimonial') }}">
                            <!-- <i class="icon-grid menu-icon ti-comment-alt"></i> -->
                            <span class="menu-title">{{__('cruds.testimonial.title')}}</span>
                        </a>
                    </li>
                    @endcan

                    @can('slider_access')
                    <li class="nav-item {{ request()->is('admin/sliders') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.slider') }}">
                            <!-- <i class="icon-grid menu-icon ti-help-alt"></i> -->
                            <span class="menu-title">{{__('cruds.slider.title')}}</span>
                        </a>
                    </li>
                    @endcan

                    @can('faq_access')
                    <li class="nav-item {{ request()->is('admin/faqs') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.faq') }}">
                            <!-- <i class="icon-grid menu-icon ti-help-alt"></i> -->
                            <span class="menu-title">{{__('cruds.faq.title')}}</span>
                        </a>
                    </li>
                    @endcan

                    @can('webinar_access')
                    <li class="nav-item {{ request()->is('admin/webinars') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.webinar') }}">
                            <span class="menu-title">Webinars</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
        </li> 

        @can('course_access')
        <li class="nav-item {{ request()->is('admin/courses') || request()->is('admin/courses/*')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.course') }}">
                <img src="{{ asset('images/icons/courses.svg') }}" alt="courses">
                <span class="menu-title">Courses</span>
            </a>
        </li>
        @endcan

        @can('team_access')
        <li class="nav-item {{ request()->is('admin/teams') || request()->is('admin/teams/*')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.team') }}">
                <img src="{{ asset('images/icons/team-management.svg') }}" alt="team management">
                <span class="menu-title">Team Management</span>
            </a>
        </li>
        @endcan

        @can('page_access')
        <li class="nav-item {{ request()->is('admin/page-manage') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.page-manage') }}">
                <img src="{{ asset('images/icons/page-management.svg') }}" alt="page management">
                <span class="menu-title">Page Management</span>
            </a>
        </li>
        @endcan

        @can('user_access')
        <li class="nav-item {{ request()->is('admin/user-manage') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.user-manage') }}">
                <img src="{{ asset('images/icons/team-management.svg') }}" alt="user management">
                <span class="menu-title">User Management</span>
            </a>
        </li>
        @endcan

        <li class="nav-item {{ request()->is('admin/kyc') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.kyc') }}">
                <img src="{{ asset('images/icons/kyc.svg') }}" alt="kyc">
                <span class="menu-title">Kyc</span>
            </a>
        </li>

        @can('sales_report_access')
        <li class="nav-item {{ request()->is('admin/sales-report') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.sales-report') }}">
                <img src="{{ asset('images/icons/growth-panel.svg') }}" alt="sales-report">
                <span class="menu-title">Sales Report</span>
            </a>
        </li>
        @endcan

    @endif

    @can('setting_access')
    <li class="nav-item {{ request()->is('admin/settings') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.setting') }}">
            <img src="{{ asset('images/icons/settings.svg') }}" alt="settings">
            <span class="menu-title">Settings</span>
        </a>
    </li>
    @endcan

    @livewire('auth.admin.sidebar-logout')
    
    <!-- <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">UI Elements</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
        </ul>
    </div>
    </li> -->
</ul>
</nav>