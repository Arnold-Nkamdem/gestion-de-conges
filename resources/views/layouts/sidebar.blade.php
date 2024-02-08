
<div class="vertical-menu">
    <!-- Logo -->
    <div class="navbar-brand px-1 mt-2">
        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-w.png') }}" alt="logo" height="52">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-w.png') }}" alt="logo" height="52"> 
                <span class="logo-txt">AN Digital</span>
            </span>
        </a>

        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-b.png') }}" alt="logo" height="52">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-b.png') }}" alt="logo" height="52"> 
                <span class="logo-txt">AN Digital</span>
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 mt-2 font-size-16 header-item vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">
        <!--- Side Menu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="bx bx-home-circle nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                @if(Auth::user()->roles->pluck('name')[0] == 'admin')
                    <li>
                        <a href="{{ route('users.index') }}">
                            <i class="mdi mdi-account-circle nav-icon"></i>
                            <span class="menu-item">Users</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('show-roles') }}">
                            <i class="bx bx-lock-open nav-icon"></i>
                            <span class="menu-item">Roles</span>
                        </a>
                    </li>
                @endif
                
                <li>
                    <a href="{{ route('holidays.index') }}">
                        <i class="bx bx-briefcase-alt-2 nav-icon"></i>
                        <span class="menu-item" data-key="t-projects">Holidays request</span>
                    </a>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-briefcase-alt-2 nav-icon"></i>
                        <span class="menu-item" data-key="t-projects">Holiday request</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('holidays.holiday-demand') }}" data-key="t-create-new">New Holiday Demand</a></li>
                        <li><a href="{{ url('holidays.index') }}" data-key="t-p-list">My Demands</a></li>
                    </ul>
                </li> --}}

                @if(Auth::user()->roles->pluck('name')[0] == 'admin' || Auth::user()->roles->pluck('name')[0] == 'moderator')
                    <li>
                        <a href="{{ url('pages.calendar') }}">
                            <i class="bx bx-calendar-alt nav-icon"></i>
                            <span class="menu-item" data-key="t-calendar">Calendar</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('pages.file-manager') }}">
                            <i class="bx bx-folder nav-icon"></i>
                            <span class="menu-item" data-key="t-filemanager">File Manager</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>