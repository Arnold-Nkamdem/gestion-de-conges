@extends('layouts.master')
@section('title')
    Dashboard 
@endsection
@section('content')
    {{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') 
                Apps 
            @endslot
            @slot('title') 
                Dashboard
            @endslot
        @endcomponent
    @endsection

<div class="row">
    <div class="col-xl-12">
        <div class="card dash-header-box">
            <div class="card-body pb-2">
                <div class="row row-cols-xxl-6 row-cols-md-3 row-cols-1 g-0">
                    <div class="col align">
                        <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                            <h5 class="text-muted mb-2">Users</h5>
                            <h3 class="fw-semibold mb-0">{{ $users }}</h3>
                        </div>
                    </div>

                    <div class="col align">
                        <div class="mt-3 mt-lg-0 py-3 px-4 mx-2">
                            <h5 class="text-muted mb-2">Admin users</h5>
                            <h3 class="fw-semibold mb-0">1</h3>
                        </div>
                    </div>

                    <div class="col align">
                        <div class="mt-md-0 py-3 px-4 mx-2">
                            <h5 class="text-muted mb-2">Holiday Demands</h5>
                            <h3 class="fw-semibold mb-0">{{ $holidayDemands }}</h3>
                        </div>
                    </div>

                    <div class="col align">
                        <div class="mt-3 mt-lg-0 py-3 px-4 mx-2">
                            <h5 class="text-muted mb-2">Pending Holiday</h5>
                            <h3 class="fw-semibold mb-0">{{ $pendingHolidays }}</h3>
                        </div>
                    </div>

                    <div class="col align">
                        <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                            <h5 class="text-muted mb-2">Approuved Holiday</h5>
                            <h3 class="fw-semibold mb-0">{{ $approuvedHolidays }}</h3>
                        </div>
                    </div>

                    <div class="col align">
                        <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                            <h5 class="text-muted mb-2">Rejected Holiday</h5>
                            <h3 class="fw-semibold mb-0">{{ $rejectedHolidays }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body pb-2">
                <div class="d-flex align-items-start mb-4 mb-xl-0">
                    <div class="flex-grow-1">
                        <h5 class="card-title">Holiday Overview</h5>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold">Sort By:</span> <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Yearly</a>
                                <a class="dropdown-item" href="#">Monthly</a>
                                <a class="dropdown-item" href="#">Weekly</a>
                                <a class="dropdown-item" href="#">Today</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-xl-4">
                        <div class="card bg-light mb-0">
                            <div class="card-body">
                                <div class="py-2">
                                    <h5>Total Holiday Demands:</h5>
                                    <h2 class="mt-4 pt-1 mb-1">60</h2>
                                    <p class="text-muted font-size-15 text-truncate">Since Jan 01,2024</p>

                                    <div class="d-flex mt-4 align-items-center">
                                        <div id="mini-1" data-colors='["--bs-success"]' class="apex-charts"></div>
                                        <div class="ms-3">
                                            <span class="badge bg-danger"><i class="mdi mdi-arrow-down me-1"></i>16.3%</span>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col">
                                            <div class="d-flex mt-2">
                                                <i class="mdi mdi-square-rounded font-size-10 text-success mt-1"></i>
                                                <div class="flex-grow-1 ms-2 ps-1">
                                                    <h5 class="mb-1">15</h5>
                                                    <p class="text-muted text-truncate mb-0">Net Approuved</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex mt-2">
                                                <i class="mdi mdi-square-rounded font-size-10 text-primary mt-1"></i>
                                                <div class="flex-grow-1 ms-2 ps-1">
                                                    <h5 class="mb-1">45</h5>
                                                    <p class="text-muted text-truncate mb-0">Net Rejected</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div>
                            <div id="column_chart" data-colors='["--bs-primary", "--bs-primary-rgb, 0.2"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-2">Holiday Request Stats</h5>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Monthly<i class="mdi mdi-chevron-down ms-1"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Yearly</a>
                                <a class="dropdown-item" href="#">Monthly</a>
                                <a class="dropdown-item" href="#">Weekly</a>
                                <a class="dropdown-item" href="#">Today</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="chart-donut" data-colors='["--bs-primary", "--bs-success","--bs-danger"]' class="apex-charts" dir="ltr"></div>

                <div class="mt-1 px-2">
                    <div class="order-wid-list d-flex justify-content-between border-bottom">
                        <p class="mb-0"><i class="mdi mdi-square-rounded font-size-10 text-primary me-2"></i>Approuved Holiday</p>
                        <div>
                            <span class="pe-5">56,236</span>
                            <span class="badge bg-primary"> + 0.2% </span>
                        </div>
                    </div>
                    <div class="order-wid-list d-flex justify-content-between border-bottom">
                        <p class="mb-0"><i class="mdi mdi-square-rounded font-size-10 text-success me-2"></i>Pending Holiday</p>
                        <div>
                            <span class="pe-5">12,596</span>
                            <span class="badge bg-success"> - 0.7% </span>
                        </div>
                    </div>
                    <div class="order-wid-list d-flex justify-content-between">
                        <p class="mb-0"><i class="mdi mdi-square-rounded font-size-10 text-danger me-2"></i>Rejected Holiday</p>
                        <div>
                            <span class="pe-5">1,568</span>
                            <span class="badge bg-danger"> + 0.4% </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div><!-- end row-->

@endsection

@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- swiper js -->
<script src="{{ URL::asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
