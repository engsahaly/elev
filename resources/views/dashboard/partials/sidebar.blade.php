<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
    <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
    <!-- nav bar -->
    <div class="w-100 mb-4 d-flex">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('admin.index') }}">
            <img src="{{ asset('assets') }}/images/logo.png" alt="Dahsboard Logo" width="50">
        </a>
    </div>

    {{-- SYSTEM MANAGEMENT --}}
    <p class="text-muted nav-heading mt-4 mb-1">
        <span>{{ __('lang.system_management') }}</span>
    </p>

    <ul class="navbar-nav flex-fill w-100 mb-2">
        @if (permission('list_roles') || permission('list_admins'))
        <li class="nav-item dropdown">
            <a href="#system_management" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">{{ __('lang.system_management') }}</span><span class="sr-only">(current)</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100" id="system_management">
                @if (permission('list_roles'))
                    <li class="nav-item @yield('roles_active')">
                    <a class="nav-link pl-3" href="{{ route('admin.roles.index') }}"><span class="ml-1 item-text">{{ __('lang.roles') }}</span></a>
                    </li>
                @endif
                @if (permission('list_admins'))
                    <li class="nav-item @yield('admins_active')">
                    <a class="nav-link pl-3" href="{{ route('admin.admins.index') }}"><span class="ml-1 item-text">{{ __('lang.admins') }}</span></a>
                    </li>
                @endif
            </ul>
        </li>
        @endif

        {{-- USERS --}}
        @if (permission('list_users'))
        <li class="nav-item w-100 @yield('users_active')">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">{{ __('lang.users') }}</span>
            </a>
        </li>
        @endif
    </ul>

    </nav>
</aside>