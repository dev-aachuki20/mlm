<nav class="sidebar sidebar-offcanvas" id="sidebar">
<ul class="nav">
    <li class="nav-item {{ request()->is('admin/index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">{{__('global.dashboard')}}</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('admin/package') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.package') }}">
            <i class="icon-grid menu-icon ti-package"></i>
            <span class="menu-title">{{__('cruds.package.title_singular')}}</span>
        </a>
    </li>
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