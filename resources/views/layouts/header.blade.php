<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- Logo -->
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo-b.png') }}" alt="logo" height="52">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-b.png') }}" alt="logo" height="52"> 
                        <span class="logo-txt">AN Digital</span>
                    </span>
                </a>

                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo-w.png') }}" alt="logo" height="52">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-w.png') }}" alt="logo" height="52"> 
                        <span class="logo-txt">AN Digital</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 header-item vertical-menu-btn noti-icon">
                <i class="fa fa-fw fa-bars font-size-16"></i>
            </button>

            <!-- Search bar -->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="bx bx-search icon-sm"></span>
                </div>
            </form>
        </div>

        <div class="d-flex">
            <!-- Languages -->
            <div class="dropdown d-inline-block language-switch">
                <button type="button" class="btn header-item noti-icon"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img id="header-lang-img" src="{{ URL::asset('assets/images/flags/us.jpg') }}" alt="Header Language" height="16">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="eng">
                        <img src="{{ URL::asset('assets/images/flags/us.jpg') }}" alt="user-image" class="me-2" height="12"> <span class="align-middle">English</span>
                    </a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="fr">
                        <img src="{{ URL::asset('assets/images/flags/french.jpg') }}" alt="user-image" class="me-2" height="12"> <span class="align-middle">French</span>
                    </a>
                </div>
            </div>

            <!-- Notifications -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell icon-sm"></i>
                    <span class="noti-dot bg-danger rounded-pill">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-15"> Notifications </h5>
                            </div>
                            <div class="col-auto">
                                <a href="javascript:void(0);" class="small"> Mark all as read</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 250px;">
                        <h6 class="dropdown-header bg-light">New</h6>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <img src="{{URL::asset('assets/images/users/avatar-3.jpg')}}"
                                    class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Justin KAMGA</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Your task changed an issue from "In Progress" to <span class="badge badge-soft-success">Approuved</span></p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <h6 class="dropdown-header bg-light">Earlier</h6>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <img src="{{URL::asset('assets/images/users/avatar-4.jpg')}}"
                                        class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Lazare KENFACK</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Yay ! Everything worked!</p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 3 days ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                            <i class="uil-arrow-circle-right me-1"></i> <span>View More..</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle" id="right-bar-toggle">
                    <i class="bx bx-cog icon-sm"></i>
                </button>
            </div>

            <!-- User Profile -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user()->photo)
                        <img class="rounded-circle header-profile-user" src="{{ Auth::user()->photo }}" alt="Header Avatar">
                    @else
                        <img class="rounded-circle header-profile-user" src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="Header Avatar">
                    @endif
                    <span class="ms-2 d-none d-xl-inline-block user-item-desc">
                        <span class="user-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<i class="mdi mdi-chevron-down"></i></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <h6 class="dropdown-header">Hello, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
                    
                    <a class="dropdown-item" href="{{ url('pages.profile') }}">
                        <i class="bx bx-user-circle text-muted font-size-16 align-middle me-1"></i>
                        <span class="align-middle">Profile</span>
                    </a>
                    <a class="dropdown-item" href="{{ url('pages.faqs') }}">
                        <i class="mdi mdi-lifebuoy text-muted font-size-16 align-middle me-1"></i>
                        <span class="align-middle">Help</span>
                        <span class="badge badge-soft-success ms-auto">New</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ url('pages.lockscreen-cover') }}">
                        <i class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i>
                        <span class="align-middle">Lock screen</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                        @csrf
                        <button type="submit" class="dropdown-item" href="{{ url('pages.logout-cover') }}">
                            <i class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i>
                            <span class="align-middle">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div>
        <!-- start page title -->
        @yield('breadcrumb')
        <!-- end page title -->
    </div>
</header>
