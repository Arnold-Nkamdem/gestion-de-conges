@extends('layouts.master')
@section('title') Holiday List @endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Apps @endslot
            @slot('title') Holidays List @endslot
        @endcomponent
    @endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Button Create New Holiday Demand -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <a href="{{ route('holidays.create') }}" class="btn btn-primary">
                                <i class="uil uil-plus me-1"></i> 
                                Create New Holiday Demand
                            </a>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-md-9">
                        <div class="d-flex flex-wrap align-items-start justify-content-md-end gap-2 mb-3">
                            <div class="search-box ">
                                <div class="position-relative">
                                    <input type="text" class="form-control bg-light border-light rounded" placeholder="Search...">
                                    <i class="uil uil-search search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="mt-2">
                    <ul class="nav nav-tabs nav-tabs-custom mb-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#list-all" role="tab">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#list-in-progress">In Progress</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#list-approuved">Approuved</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#list-rejected">Rejected</a>
                        </li>
                    </ul><!-- end ul -->
                </div>

                <!-- Tab content -->
                <div class="tab-content">
                    <div class="tab-pane active" id="list-all" role="tabpanel">
                        <div>
                            <div>
                                @foreach ($holidays as $holiday)
                                    @foreach ($demands as $demand)
                                        @foreach ($users as $user)
                                            @if ((Auth::user()->roles->pluck('name')[0] == 'user') && ($demand->holiday_id == $holiday->id) && ($demand->user_id == Auth::user()->id))
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="avatar">
                                                                @if(Auth::user()->photo)
                                                                    <img src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                @else
                                                                    <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                @endif
                                                            </div>
                                                            <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                <h5 class="font-size-16 mb-0">
                                                                    <!-- <a href="#" class="text-reset"></a> -->
                                                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                                                </h5>
                                                                <p class="badge badge-soft-primary mb-0">
                                                                    @foreach ($functions as $function)
                                                                        @if (Auth::user()->position_id == $function->id)
                                                                            {{ $function->position_name }}
                                                                        @endif
                                                                    @endforeach
                                                                </p>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <div class="d-flex gap-2">
                                                                    <div class="dropdown">
                                                                        <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                            <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                            <li><a class="dropdown-item text-primary" data-bs-toggle="modal" href="#updateHolidayDemand-{{ $holiday->id }}">Edit</a></li>
                                                                            <li><a class="dropdown-item text-danger" data-bs-toggle="modal" href="#deleteHolidayDemand-{{ $holiday->id }}">Delete</a></li>
                                                                            <!-- <li>
                                                                                <hr class="dropdown-divider">
                                                                            </li>
                                                                            <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end card body -->
                                                    <div class="">
                                                        <div class="row g-0 border-top">
                                                            <div class="col-xl-3 col-sm-6">
                                                                <div class="border-end p-3 h-100">
                                                                    <div>
                                                                        <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                        <div class="badge badge-soft-info font-size-12">
                                                                            @foreach ($holidaysType as $holidayType)
                                                                                @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                    {{ $holidayType->holiday_label }}
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-sm-6">
                                                                <div class="border-end p-3 h-100">
                                                                    <div>
                                                                        <p class="text-muted font-size-13 mb-2">Period</p>
                                                                        <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-sm-6">
                                                                <div class="border-end p-3 h-100">
                                                                    @if ($demand->status == "pending")
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-warning font-size-12">In Progress</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($demand->status == "approuved")
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-primary font-size-12">Approuved</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($demand->status == "rejected")
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-danger font-size-12">Rejected</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-sm-6">
                                                                <div class="border-end p-3 h-100">
                                                                    <div>
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                            <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end col -->
                                                        </div><!-- end row -->
                                                    </div>
                                                </div>
                                                <!-- end card -->
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'admin') && ($demand->holiday_id == $holiday->id) && ($demand->user_id == Auth::user()->id))
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="avatar">
                                                                @if(Auth::user()->photo)
                                                                    <img src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                @else
                                                                    <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                @endif
                                                            </div>
                                                            <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                <h5 class="font-size-16 mb-0">
                                                                    <!-- <a href="#" class="text-reset"></a> -->
                                                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                                                </h5>
                                                                <p class="badge badge-soft-primary mb-0">
                                                                    @foreach ($functions as $function)
                                                                        @if (Auth::user()->position_id == $function->id)
                                                                            {{ $function->position_name }}
                                                                        @endif
                                                                    @endforeach
                                                                </p>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <div class="d-flex gap-2">
                                                                    <div class="dropdown">
                                                                        <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                            <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                            <li><a class="dropdown-item text-primary" data-bs-toggle="modal" href="#updateHolidayDemand-{{ $holiday->id }}">Edit</a></li>
                                                                            <li><a class="dropdown-item text-danger" data-bs-toggle="modal" href="#deleteHolidayDemand-{{ $holiday->id }}">Delete</a></li>
                                                                            <!-- <li>
                                                                                <hr class="dropdown-divider">
                                                                            </li>
                                                                            <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end card body -->
                                                    <div class="">
                                                        <div class="row g-0 border-top">
                                                            <div class="col-xl-3 col-sm-6">
                                                                <div class="border-end p-3 h-100">
                                                                    <div>
                                                                        <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                        <div class="badge badge-soft-info font-size-12">
                                                                            @foreach ($holidaysType as $holidayType)
                                                                                @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                    {{ $holidayType->holiday_label }}
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-sm-6">
                                                                <div class="border-end p-3 h-100">
                                                                    <div>
                                                                        <p class="text-muted font-size-13 mb-2">Period</p>
                                                                        <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-sm-6">
                                                                <div class="border-end p-3 h-100">
                                                                    @if ($demand->status == "pending")
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-warning font-size-12">In Progress</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($demand->status == "approuved")
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-primary font-size-12">Approuved</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($demand->status == "rejected")
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-danger font-size-12">Rejected</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-sm-6">
                                                                <div class="border-end p-3 h-100">
                                                                    <div>
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                            <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end col -->
                                                        </div><!-- end row -->
                                                    </div>
                                                </div>
                                                <!-- end card -->
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'admin') && ($demand->holiday_id == $holiday->id) && ($demand->user_id !== Auth::user()->id))
                                                @if (($demand->holiday_id == $holiday->id) && ($demand->user_id == $user->id))
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="avatar">
                                                                    @if($user->photo)
                                                                        <img src="{{ $user->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @else
                                                                        <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @endif
                                                                </div>
                                                                <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                    <h5 class="font-size-16 mb-0">
                                                                        <!-- <a href="#" class="text-reset"></a> -->
                                                                        {{ $user->first_name }} {{ $user->last_name }}
                                                                    </h5>
                                                                    <p class="badge badge-soft-primary mb-0">
                                                                        @foreach ($functions as $function)
                                                                            @if ($user->position_id == $function->id)
                                                                                {{ $function->position_name }}
                                                                            @endif
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <div class="d-flex gap-2">
                                                                        <div class="dropdown">
                                                                            <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li class="dropdown-item">Nothing to do</li>
                                                                                <!-- <li>
                                                                                    <hr class="dropdown-divider">
                                                                                </li>
                                                                                <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                        <div class="">
                                                            <div class="row g-0 border-top">
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                            <div class="badge badge-soft-info font-size-12">
                                                                                @foreach ($holidaysType as $holidayType)
                                                                                    @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                        {{ $holidayType->holiday_label }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Period</p>
                                                                            <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        @if ($demand->status == "pending")
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                    <span class="badge bg-warning font-size-12">In Progress</span>
                                                                                </p>
                                                                            </div>

                                                                            <div class="progress mt-3" style="height: 6px;">
                                                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                                </div>
                                                                            </div>
                                                                        @elseif ($demand->status == "approuved")
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                    <span class="badge bg-primary font-size-12">Approuved</span>
                                                                                </p>
                                                                            </div>

                                                                            <div class="progress mt-3" style="height: 6px;">
                                                                                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                                </div>
                                                                            </div>
                                                                        @elseif ($demand->status == "rejected")
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                    <span class="badge bg-danger font-size-12">Rejected</span>
                                                                                </p>
                                                                            </div>

                                                                            <div class="progress mt-3" style="height: 6px;">
                                                                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end col -->
                                                            </div><!-- end row -->
                                                        </div>
                                                    </div>
                                                    <!-- end card -->
                                                @endif
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'moderator') && ($demand->holiday_id == $holiday->id) && ($demand->user_id == Auth::user()->id))
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="avatar">
                                                                @if(Auth::user()->photo)
                                                                    <img src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                @else
                                                                    <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                @endif
                                                            </div>
                                                            <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                <h5 class="font-size-16 mb-0">
                                                                    <!-- <a href="#" class="text-reset"></a> -->
                                                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                                                </h5>
                                                                <p class="badge badge-soft-primary mb-0">
                                                                    @foreach ($functions as $function)
                                                                        @if (Auth::user()->position_id == $function->id)
                                                                            {{ $function->position_name }}
                                                                        @endif
                                                                    @endforeach
                                                                </p>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <div class="d-flex gap-2">
                                                                    <div class="dropdown">
                                                                        <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                            <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                            <li><a class="dropdown-item text-primary" data-bs-toggle="modal" href="#updateHolidayDemand-{{ $holiday->id }}">Edit</a></li>
                                                                            <li><a class="dropdown-item text-danger" data-bs-toggle="modal" href="#deleteHolidayDemand-{{ $holiday->id }}">Delete</a></li>
                                                                            <!-- <li>
                                                                                <hr class="dropdown-divider">
                                                                            </li>
                                                                            <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end card body -->
                                                    <div class="">
                                                        <div class="row g-0 border-top">
                                                            <div class="col-xl-3 col-sm-6">
                                                                <div class="border-end p-3 h-100">
                                                                    <div>
                                                                        <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                        <div class="badge badge-soft-info font-size-12">
                                                                            @foreach ($holidaysType as $holidayType)
                                                                                @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                    {{ $holidayType->holiday_label }}
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-sm-6">
                                                                <div class="border-end p-3 h-100">
                                                                    <div>
                                                                        <p class="text-muted font-size-13 mb-2">Period</p>
                                                                        <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-sm-6">
                                                                <div class="border-end p-3 h-100">
                                                                    @if ($demand->status == "pending")
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-warning font-size-12">In Progress</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($demand->status == "approuved")
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-primary font-size-12">Approuved</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($demand->status == "rejected")
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-danger font-size-12">Rejected</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-sm-6">
                                                                <div class="border-end p-3 h-100">
                                                                    <div>
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                            <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end col -->
                                                        </div><!-- end row -->
                                                    </div>
                                                </div>
                                                <!-- end card -->
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'moderator') && ($demand->holiday_id == $holiday->id) && ($demand->user_id !== Auth::user()->id))
                                                @if (($demand->holiday_id == $holiday->id) && ($demand->user_id == $user->id))
                                                    @if ($demand->status == "pending")
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="avatar">
                                                                        @if($user->photo)
                                                                            <img src="{{ $user->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @else
                                                                            <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @endif
                                                                    </div>
                                                                    <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                        <h5 class="font-size-16 mb-0">
                                                                            <!-- <a href="#" class="text-reset"></a> -->
                                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                                        </h5>
                                                                        <p class="badge badge-soft-primary mb-0">
                                                                            @foreach ($functions as $function)
                                                                                @if ($user->position_id == $function->id)
                                                                                    {{ $function->position_name }}
                                                                                @endif
                                                                            @endforeach
                                                                        </p>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                    <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                                    <li class="dropdown-item">Nothing to do</li>
                                                                                    <!-- <li>
                                                                                        <hr class="dropdown-divider">
                                                                                    </li>
                                                                                    <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                            <div class="">
                                                                <div class="row g-0 border-top">
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                                <div class="badge badge-soft-info font-size-12">
                                                                                    @foreach ($holidaysType as $holidayType)
                                                                                        @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                            {{ $holidayType->holiday_label }}
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Period</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                    <span class="badge bg-warning font-size-12">In Progress</span>
                                                                                </p>
                                                                            </div>

                                                                            <div class="progress mt-3" style="height: 6px;">
                                                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                    <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Actions</p>
                                                                                    <a class="btn btn-primary btn-sm" data-bs-toggle="modal" href="#approuvedHolidayDemand-{{ $demand->id }}">Approuved</a>
                                                                                    <a class="btn btn-danger btn-sm" data-bs-toggle="modal" href="#rejectedHolidayDemand-{{ $demand->id }}">Rejected</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                </div><!-- end row -->
                                                            </div>
                                                        </div>
                                                        <!-- end card -->
                                                        {{-- @foreach ($services as $service)
                                                            @foreach ($functions as $function)
                                                                @if ((Auth::user()->position_id == $function->id) && ($function->service_id == $service->id == &user->)
                                                                @endif
                                                            @endforeach
                                                        @endforeach --}}
                                                    @elseif ($demand->status == "approuved")
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="avatar">
                                                                        @if($user->photo)
                                                                            <img src="{{ $user->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @else
                                                                            <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @endif
                                                                    </div>
                                                                    <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                        <h5 class="font-size-16 mb-0">
                                                                            <!-- <a href="#" class="text-reset"></a> -->
                                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                                        </h5>
                                                                        <p class="badge badge-soft-primary mb-0">
                                                                            @foreach ($functions as $function)
                                                                                @if ($user->position_id == $function->id)
                                                                                    {{ $function->position_name }}
                                                                                @endif
                                                                            @endforeach
                                                                        </p>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                    <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                                    <li class="dropdown-item">Nothing to do</li>
                                                                                    <!-- <li>
                                                                                        <hr class="dropdown-divider">
                                                                                    </li>
                                                                                    <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                            <div class="">
                                                                <div class="row g-0 border-top">
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                                <div class="badge badge-soft-info font-size-12">
                                                                                    @foreach ($holidaysType as $holidayType)
                                                                                        @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                            {{ $holidayType->holiday_label }}
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Period</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                    <span class="badge bg-primary font-size-12">Approuved</span>
                                                                                </p>
                                                                            </div>

                                                                            <div class="progress mt-3" style="height: 6px;">
                                                                                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                    <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Actions</p>
                                                                                    <button type="button" class="btn btn-primary btn-sm" disabled data-bs-toggle="modal" data-bs-target="#approuvedHolidayDemand-{{ $demand->id }}">Approuved</button>
                                                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectedHolidayDemand-{{ $demand->id }}">Rejected</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                </div><!-- end row -->
                                                            </div>
                                                        </div>
                                                        <!-- end card -->
                                                        {{-- @foreach ($services as $service)
                                                            @foreach ($functions as $function)
                                                                @if ((Auth::user()->position_id == $function->id) && ($function->service_id == $service->id == &user->)
                                                                @endif
                                                            @endforeach
                                                        @endforeach --}}
                                                    @elseif ($demand->status == "rejected")
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="avatar">
                                                                        @if($user->photo)
                                                                            <img src="{{ $user->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @else
                                                                            <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @endif
                                                                    </div>
                                                                    <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                        <h5 class="font-size-16 mb-0">
                                                                            <!-- <a href="#" class="text-reset"></a> -->
                                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                                        </h5>
                                                                        <p class="badge badge-soft-primary mb-0">
                                                                            @foreach ($functions as $function)
                                                                                @if ($user->position_id == $function->id)
                                                                                    {{ $function->position_name }}
                                                                                @endif
                                                                            @endforeach
                                                                        </p>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                    <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                                    <li class="dropdown-item">Nothing to do</li>
                                                                                    <!-- <li>
                                                                                        <hr class="dropdown-divider">
                                                                                    </li>
                                                                                    <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                            <div class="">
                                                                <div class="row g-0 border-top">
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                                <div class="badge badge-soft-info font-size-12">
                                                                                    @foreach ($holidaysType as $holidayType)
                                                                                        @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                            {{ $holidayType->holiday_label }}
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Period</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                    <span class="badge bg-danger font-size-12">Rejected</span>
                                                                                </p>
                                                                            </div>

                                                                            <div class="progress mt-3" style="height: 6px;">
                                                                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                    <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Actions</p>
                                                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#approuvedHolidayDemand-{{ $demand->id }}">Approuved</button>
                                                                                    <button type="button" class="btn btn-danger btn-sm" disabled data-bs-toggle="modal" data-bs-target="#rejectedHolidayDemand-{{ $demand->id }}">Rejected</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                </div><!-- end row -->
                                                            </div>
                                                        </div>
                                                        <!-- end card -->
                                                        {{-- @foreach ($services as $service)
                                                            @foreach ($functions as $function)
                                                                @if ((Auth::user()->position_id == $function->id) && ($function->service_id == $service->id == &user->)
                                                                @endif
                                                            @endforeach
                                                        @endforeach --}}
                                                    @endif
                                                @endif
                                            @endif

                                            <!-- Approuved Holiday Demand Modal -->
                                            <div class="modal fade" id="approuvedHolidayDemand-{{ $demand->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-2" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-2">Approuved Holiday Demand</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('holidays-update-status', $demand->id) }}">
                                                                @csrf
                                                                @method('patch')

                                                                <div class="text-center mt-5 mb-5">
                                                                    <p class="text-center">
                                                                        Are you sure you want to approuve this holiday demand?
                                                                    </p>
                                                                    <input type="hidden" value="approuved" id="input-status" name="status">
                                                                </div>
                                                                <div class="text-end">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Rejected Holiday Demand Modal -->
                                            <div class="modal fade" id="rejectedHolidayDemand-{{ $demand->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-3" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-3">Rejected Holiday Demand</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('holidays-update-status', $demand->id) }}">
                                                                @csrf
                                                                @method('patch')

                                                                <div class="text-center mt-5 mb-5">
                                                                    <p class="text-center">
                                                                        Are you sure you want to reject this holiday demand?
                                                                    </p>
                                                                    <input type="hidden" value="rejected" id="input-status" name="status">
                                                                </div>
                                                                <div class="text-end">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Holiday Demand Modal -->
                                            <div class="modal fade" id="deleteHolidayDemand-{{ $holiday->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-4" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-4">Delete Holiday Demand</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('holidays.destroy', $holiday->id) }}">
                                                                @csrf
                                                                @method('patch')

                                                                <div class="text-center mt-5 mb-5">
                                                                    <p class="text-center">
                                                                        Are you sure you want to delete this holiday demand?
                                                                    </p>
                                                                    <input type="hidden" value="rejected" id="input-status" name="status">
                                                                </div>
                                                                <div class="text-end">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </div>

                            {{-- <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <!-- Previous Page Link -->
                                    @if ($user->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-hidden="true">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $user->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    @endif

                                    <!-- Pagination Elements -->
                                    @foreach ($user->getUrlRange(1, $user->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $user->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Next Page Link -->
                                    @if ($user->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $user->nextPageUrl() }}" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-hidden="true">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav> --}}
                            <!-- end row -->
                        </div>
                    </div>
                    <!-- end tab pane -->
                            
                    <div class="tab-pane" id="list-in-progress" role="tabpanel">
                        <div>
                            <div>
                                @foreach ($holidays as $holiday)
                                    @foreach ($demands as $demand)
                                        @foreach ($users as $user)
                                            @if ((Auth::user()->roles->pluck('name')[0] == 'user') && ($demand->holiday_id == $holiday->id) && ($demand->user_id == Auth::user()->id))
                                                @if ($demand->status == "pending")
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="avatar">
                                                                    @if(Auth::user()->photo)
                                                                        <img src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @else
                                                                        <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @endif
                                                                </div>
                                                                <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                    <h5 class="font-size-16 mb-0">
                                                                        <!-- <a href="#" class="text-reset"></a> -->
                                                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                                                    </h5>
                                                                    <p class="badge badge-soft-primary mb-0">
                                                                        @foreach ($functions as $function)
                                                                            @if (Auth::user()->position_id == $function->id)
                                                                                {{ $function->position_name }}
                                                                            @endif
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <div class="d-flex gap-2">
                                                                        <div class="dropdown">
                                                                            <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li><a class="dropdown-item text-primary" data-bs-toggle="modal" href="#updateHolidayDemandIp-{{ $holiday->id }}">Edit</a></li>
                                                                                <li><a class="dropdown-item text-danger" data-bs-toggle="modal" href="#deleteHolidayDemandIp-{{ $holiday->id }}">Delete</a></li>
                                                                                <!-- <li>
                                                                                    <hr class="dropdown-divider">
                                                                                </li>
                                                                                <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                        <div class="">
                                                            <div class="row g-0 border-top">
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                            <div class="badge badge-soft-info font-size-12">
                                                                                @foreach ($holidaysType as $holidayType)
                                                                                    @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                        {{ $holidayType->holiday_label }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Period</p>
                                                                            <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-warning font-size-12">In Progress</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end col -->
                                                            </div><!-- end row -->
                                                        </div>
                                                    </div>
                                                    <!-- end card -->
                                                @endif
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'admin') && ($demand->holiday_id == $holiday->id) && ($demand->user_id == Auth::user()->id))
                                                @if ($demand->status == "pending")
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="avatar">
                                                                    @if(Auth::user()->photo)
                                                                        <img src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @else
                                                                        <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @endif
                                                                </div>
                                                                <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                    <h5 class="font-size-16 mb-0">
                                                                        <!-- <a href="#" class="text-reset"></a> -->
                                                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                                                    </h5>
                                                                    <p class="badge badge-soft-primary mb-0">
                                                                        @foreach ($functions as $function)
                                                                            @if (Auth::user()->position_id == $function->id)
                                                                                {{ $function->position_name }}
                                                                            @endif
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <div class="d-flex gap-2">
                                                                        <div class="dropdown">
                                                                            <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li><a class="dropdown-item text-primary" data-bs-toggle="modal" href="#updateHolidayDemandIp-{{ $holiday->id }}">Edit</a></li>
                                                                                <li><a class="dropdown-item text-danger" data-bs-toggle="modal" href="#deleteHolidayDemandIp-{{ $holiday->id }}">Delete</a></li>
                                                                                <!-- <li>
                                                                                    <hr class="dropdown-divider">
                                                                                </li>
                                                                                <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                        <div class="">
                                                            <div class="row g-0 border-top">
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                            <div class="badge badge-soft-info font-size-12">
                                                                                @foreach ($holidaysType as $holidayType)
                                                                                    @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                        {{ $holidayType->holiday_label }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Period</p>
                                                                            <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-warning font-size-12">In Progress</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end col -->
                                                            </div><!-- end row -->
                                                        </div>
                                                    </div>
                                                    <!-- end card -->
                                                @endif
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'admin') && ($demand->holiday_id == $holiday->id) && ($demand->user_id !== Auth::user()->id))
                                            @if (($demand->holiday_id == $holiday->id) && ($demand->user_id == $user->id))
                                                    @if ($demand->status == "pending")
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="avatar">
                                                                        @if($user->photo)
                                                                            <img src="{{ $user->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @else
                                                                            <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @endif
                                                                    </div>
                                                                    <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                        <h5 class="font-size-16 mb-0">
                                                                            <!-- <a href="#" class="text-reset"></a> -->
                                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                                        </h5>
                                                                        <p class="badge badge-soft-primary mb-0">
                                                                            @foreach ($functions as $function)
                                                                                @if ($user->position_id == $function->id)
                                                                                    {{ $function->position_name }}
                                                                                @endif
                                                                            @endforeach
                                                                        </p>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                    <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                                    <li class="dropdown-item">Nothing to do</li>
                                                                                    <!-- <li>
                                                                                        <hr class="dropdown-divider">
                                                                                    </li>
                                                                                    <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                            <div class="">
                                                                <div class="row g-0 border-top">
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                                <div class="badge badge-soft-info font-size-12">
                                                                                    @foreach ($holidaysType as $holidayType)
                                                                                        @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                            {{ $holidayType->holiday_label }}
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Period</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                    <span class="badge bg-warning font-size-12">In Progress</span>
                                                                                </p>
                                                                            </div>

                                                                            <div class="progress mt-3" style="height: 6px;">
                                                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                    <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                </div><!-- end row -->
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'moderator') && ($demand->holiday_id == $holiday->id) && ($demand->user_id == Auth::user()->id))
                                                @if ($demand->status == "pending")
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="avatar">
                                                                    @if(Auth::user()->photo)
                                                                        <img src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @else
                                                                        <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @endif
                                                                </div>
                                                                <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                    <h5 class="font-size-16 mb-0">
                                                                        <!-- <a href="#" class="text-reset"></a> -->
                                                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                                                    </h5>
                                                                    <p class="badge badge-soft-primary mb-0">
                                                                        @foreach ($functions as $function)
                                                                            @if (Auth::user()->position_id == $function->id)
                                                                                {{ $function->position_name }}
                                                                            @endif
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <div class="d-flex gap-2">
                                                                        <div class="dropdown">
                                                                            <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li><a class="dropdown-item text-primary" data-bs-toggle="modal" href="#updateHolidayDemandIp-{{ $holiday->id }}">Edit</a></li>
                                                                                <li><a class="dropdown-item text-danger" data-bs-toggle="modal" href="#deleteHolidayDemandIp-{{ $holiday->id }}">Delete</a></li>
                                                                                <!-- <li>
                                                                                    <hr class="dropdown-divider">
                                                                                </li>
                                                                                <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                        <div class="">
                                                            <div class="row g-0 border-top">
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                            <div class="badge badge-soft-info font-size-12">
                                                                                @foreach ($holidaysType as $holidayType)
                                                                                    @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                        {{ $holidayType->holiday_label }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Period</p>
                                                                            <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-warning font-size-12">In Progress</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end col -->
                                                            </div><!-- end row -->
                                                        </div>
                                                    </div>
                                                    <!-- end card -->
                                                @endif
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'moderator') && ($demand->holiday_id == $holiday->id) && ($demand->user_id !== Auth::user()->id))
                                                @if (($demand->holiday_id == $holiday->id) && ($demand->user_id == $user->id))
                                                    @if ($demand->status == "pending")
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="avatar">
                                                                        @if($user->photo)
                                                                            <img src="{{ $user->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @else
                                                                            <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @endif
                                                                    </div>
                                                                    <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                        <h5 class="font-size-16 mb-0">
                                                                            <!-- <a href="#" class="text-reset"></a> -->
                                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                                        </h5>
                                                                        <p class="badge badge-soft-primary mb-0">
                                                                            @foreach ($functions as $function)
                                                                                @if ($user->position_id == $function->id)
                                                                                    {{ $function->position_name }}
                                                                                @endif
                                                                            @endforeach
                                                                        </p>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                    <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                                    <li class="dropdown-item">Nothing to do</li>
                                                                                    <!-- <li>
                                                                                        <hr class="dropdown-divider">
                                                                                    </li>
                                                                                    <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                            <div class="">
                                                                <div class="row g-0 border-top">
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                                <div class="badge badge-soft-info font-size-12">
                                                                                    @foreach ($holidaysType as $holidayType)
                                                                                        @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                            {{ $holidayType->holiday_label }}
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Period</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                    <span class="badge bg-warning font-size-12">In Progress</span>
                                                                                </p>
                                                                            </div>

                                                                            <div class="progress mt-3" style="height: 6px;">
                                                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                    <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Actions</p>
                                                                                    <a class="btn btn-primary btn-sm" data-bs-toggle="modal" href="#approuvedHolidayDemandIp-{{ $demand->id }}">Approuved</a>
                                                                                    <a class="btn btn-danger btn-sm" data-bs-toggle="modal" href="#rejectedHolidayDemandIp-{{ $demand->id }}">Rejected</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                </div><!-- end row -->
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif
                                            <!-- @if ($demand->status == "pending")
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p>No holidays demand in progress.</p>
                                                    </div>
                                                </div>
                                            @endif -->

                                            <!-- Approuved Holiday Demand Modal -->
                                            <div class="modal fade" id="approuvedHolidayDemandIp-{{ $demand->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-2" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-2">Approuved Holiday Demand</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('holidays-update-status', $demand->id) }}">
                                                                @csrf
                                                                @method('patch')

                                                                <div class="text-center mt-5 mb-5">
                                                                    <p class="text-center">
                                                                        Are you sure you want to approuve this holiday demand?
                                                                    </p>
                                                                    <input type="hidden" value="approuved" id="input-status" name="status">
                                                                </div>
                                                                <div class="text-end">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Rejected Holiday Demand Modal -->
                                            <div class="modal fade" id="rejectedHolidayDemandIp-{{ $demand->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-3" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-3">Rejected Holiday Demand</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('holidays-update-status', $demand->id) }}">
                                                                @csrf
                                                                @method('patch')

                                                                <div class="text-center mt-5 mb-5">
                                                                    <p class="text-center">
                                                                        Are you sure you want to reject this holiday demand?
                                                                    </p>
                                                                    <input type="hidden" value="rejected" id="input-status" name="status">
                                                                </div>
                                                                <div class="text-end">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Holiday Demand Modal -->
                                            <div class="modal fade" id="deleteHolidayDemandIp-{{ $holiday->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-4" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-4">Delete Holiday Demand</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('holidays.destroy', $holiday->id) }}">
                                                                @csrf
                                                                @method('patch')

                                                                <div class="text-center mt-5 mb-5">
                                                                    <p class="text-center">
                                                                        Are you sure you want to delete this holiday demand?
                                                                    </p>
                                                                    <input type="hidden" value="rejected" id="input-status" name="status">
                                                                </div>
                                                                <div class="text-end">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </div>

                            {{-- <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <!-- Previous Page Link -->
                                    @if ($user->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-hidden="true">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $user->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    @endif

                                    <!-- Pagination Elements -->
                                    @foreach ($user->getUrlRange(1, $user->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $user->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Next Page Link -->
                                    @if ($user->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $user->nextPageUrl() }}" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-hidden="true">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav> --}}
                        </div>
                    </div>
                    <!-- end tab pane -->

                    <div class="tab-pane" id="list-approuved" role="tabpanel">
                        <div>
                            <div>
                                @foreach ($holidays as $holiday)
                                    @foreach ($demands as $demand)
                                        @foreach ($users as $user)
                                            @if ((Auth::user()->roles->pluck('name')[0] == 'user') && ($demand->holiday_id == $holiday->id) && ($demand->user_id == Auth::user()->id))
                                                @if ($demand->status == "approuved")
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="avatar">
                                                                    @if(Auth::user()->photo)
                                                                        <img src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @else
                                                                        <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @endif
                                                                </div>
                                                                <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                    <h5 class="font-size-16 mb-0">
                                                                        <!-- <a href="#" class="text-reset"></a> -->
                                                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                                                    </h5>
                                                                    <p class="badge badge-soft-primary mb-0">
                                                                        @foreach ($functions as $function)
                                                                            @if (Auth::user()->position_id == $function->id)
                                                                                {{ $function->position_name }}
                                                                            @endif
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <div class="d-flex gap-2">
                                                                        <div class="dropdown">
                                                                            <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li><a class="dropdown-item text-primary" data-bs-toggle="modal" href="#updateHolidayDemandA-{{ $holiday->id }}">Edit</a></li>
                                                                                <li><a class="dropdown-item text-danger" data-bs-toggle="modal" href="#deleteHolidayDemandA-{{ $holiday->id }}">Delete</a></li>
                                                                                <!-- <li>
                                                                                    <hr class="dropdown-divider">
                                                                                </li>
                                                                                <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                        <div class="">
                                                            <div class="row g-0 border-top">
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                            <div class="badge badge-soft-info font-size-12">
                                                                                @foreach ($holidaysType as $holidayType)
                                                                                    @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                        {{ $holidayType->holiday_label }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Period</p>
                                                                            <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-primary font-size-12">Approuved</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end col -->
                                                            </div><!-- end row -->
                                                        </div>
                                                    </div>
                                                    <!-- end card -->
                                                @endif
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'admin') && ($demand->holiday_id == $holiday->id) && ($demand->user_id == Auth::user()->id))
                                                @if ($demand->status == "approuved")
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="avatar">
                                                                    @if(Auth::user()->photo)
                                                                        <img src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @else
                                                                        <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @endif
                                                                </div>
                                                                <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                    <h5 class="font-size-16 mb-0">
                                                                        <!-- <a href="#" class="text-reset"></a> -->
                                                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                                                    </h5>
                                                                    <p class="badge badge-soft-primary mb-0">
                                                                        @foreach ($functions as $function)
                                                                            @if (Auth::user()->position_id == $function->id)
                                                                                {{ $function->position_name }}
                                                                            @endif
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <div class="d-flex gap-2">
                                                                        <div class="dropdown">
                                                                            <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li><a class="dropdown-item text-primary" data-bs-toggle="modal" href="#updateHolidayDemandA-{{ $holiday->id }}">Edit</a></li>
                                                                                <li><a class="dropdown-item text-danger" data-bs-toggle="modal" href="#deleteHolidayDemandA-{{ $holiday->id }}">Delete</a></li>
                                                                                <!-- <li>
                                                                                    <hr class="dropdown-divider">
                                                                                </li>
                                                                                <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                        <div class="">
                                                            <div class="row g-0 border-top">
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                            <div class="badge badge-soft-info font-size-12">
                                                                                @foreach ($holidaysType as $holidayType)
                                                                                    @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                        {{ $holidayType->holiday_label }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Period</p>
                                                                            <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-primary font-size-12">Approuved</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end col -->
                                                            </div><!-- end row -->
                                                        </div>
                                                    </div>
                                                    <!-- end card -->
                                                @endif
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'admin') && ($demand->holiday_id == $holiday->id) && ($demand->user_id !== Auth::user()->id))
                                            @if (($demand->holiday_id == $holiday->id) && ($demand->user_id == $user->id))
                                                    @if ($demand->status == "approuved")
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="avatar">
                                                                        @if($user->photo)
                                                                            <img src="{{ $user->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @else
                                                                            <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @endif
                                                                    </div>
                                                                    <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                        <h5 class="font-size-16 mb-0">
                                                                            <!-- <a href="#" class="text-reset"></a> -->
                                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                                        </h5>
                                                                        <p class="badge badge-soft-primary mb-0">
                                                                            @foreach ($functions as $function)
                                                                                @if ($user->position_id == $function->id)
                                                                                    {{ $function->position_name }}
                                                                                @endif
                                                                            @endforeach
                                                                        </p>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                    <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                                    <li class="dropdown-item">Nothing to do</li>
                                                                                    <!-- <li>
                                                                                        <hr class="dropdown-divider">
                                                                                    </li>
                                                                                    <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                            <div class="">
                                                                <div class="row g-0 border-top">
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                                <div class="badge badge-soft-info font-size-12">
                                                                                    @foreach ($holidaysType as $holidayType)
                                                                                        @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                            {{ $holidayType->holiday_label }}
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Period</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                    <span class="badge bg-primary font-size-12">Approuved</span>
                                                                                </p>
                                                                            </div>

                                                                            <div class="progress mt-3" style="height: 6px;">
                                                                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                    <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                </div><!-- end row -->
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'moderator') && ($demand->holiday_id == $holiday->id) && ($demand->user_id == Auth::user()->id))
                                                @if ($demand->status == "approuved")
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="avatar">
                                                                    @if(Auth::user()->photo)
                                                                        <img src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @else
                                                                        <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @endif
                                                                </div>
                                                                <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                    <h5 class="font-size-16 mb-0">
                                                                        <!-- <a href="#" class="text-reset"></a> -->
                                                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                                                    </h5>
                                                                    <p class="badge badge-soft-primary mb-0">
                                                                        @foreach ($functions as $function)
                                                                            @if (Auth::user()->position_id == $function->id)
                                                                                {{ $function->position_name }}
                                                                            @endif
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <div class="d-flex gap-2">
                                                                        <div class="dropdown">
                                                                            <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li><a class="dropdown-item text-primary" data-bs-toggle="modal" href="#updateHolidayDemandA-{{ $holiday->id }}">Edit</a></li>
                                                                                <li><a class="dropdown-item text-danger" data-bs-toggle="modal" href="#deleteHolidayDemandA-{{ $holiday->id }}">Delete</a></li>
                                                                                <!-- <li>
                                                                                    <hr class="dropdown-divider">
                                                                                </li>
                                                                                <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                        <div class="">
                                                            <div class="row g-0 border-top">
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                            <div class="badge badge-soft-info font-size-12">
                                                                                @foreach ($holidaysType as $holidayType)
                                                                                    @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                        {{ $holidayType->holiday_label }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Period</p>
                                                                            <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-primary font-size-12">Approuved</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end col -->
                                                            </div><!-- end row -->
                                                        </div>
                                                    </div>
                                                    <!-- end card -->
                                                @endif
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'moderator') && ($demand->holiday_id == $holiday->id) && ($demand->user_id !== Auth::user()->id))
                                                @if (($demand->holiday_id == $holiday->id) && ($demand->user_id == $user->id))
                                                    @if ($demand->status == "approuved")
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="avatar">
                                                                        @if($user->photo)
                                                                            <img src="{{ $user->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @else
                                                                            <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @endif
                                                                    </div>
                                                                    <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                        <h5 class="font-size-16 mb-0">
                                                                            <!-- <a href="#" class="text-reset"></a> -->
                                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                                        </h5>
                                                                        <p class="badge badge-soft-primary mb-0">
                                                                            @foreach ($functions as $function)
                                                                                @if ($user->position_id == $function->id)
                                                                                    {{ $function->position_name }}
                                                                                @endif
                                                                            @endforeach
                                                                        </p>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                    <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                                    <li class="dropdown-item">Nothing to do</li>
                                                                                    <!-- <li>
                                                                                        <hr class="dropdown-divider">
                                                                                    </li>
                                                                                    <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                            <div class="">
                                                                <div class="row g-0 border-top">
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                                <div class="badge badge-soft-info font-size-12">
                                                                                    @foreach ($holidaysType as $holidayType)
                                                                                        @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                            {{ $holidayType->holiday_label }}
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Period</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                    <span class="badge bg-primary font-size-12">Approuved</span>
                                                                                </p>
                                                                            </div>

                                                                            <div class="progress mt-3" style="height: 6px;">
                                                                                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                    <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Actions</p>
                                                                                    <button type="button" class="btn btn-primary btn-sm" disabled data-bs-toggle="modal" data-bs-target="#approuvedHolidayDemandA-{{ $demand->id }}">Approuved</button>
                                                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectedHolidayDemandA-{{ $demand->id }}">Rejected</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                </div><!-- end row -->
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif
                                            <!-- @if ($demand->status == "approuved")
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p>No holidays demand in progress.</p>
                                                    </div>
                                                </div>
                                            @endif -->

                                            <!-- Approuved Holiday Demand Modal -->
                                            <div class="modal fade" id="approuvedHolidayDemandA-{{ $demand->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-2" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-2">Approuved Holiday Demand</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('holidays-update-status', $demand->id) }}">
                                                                @csrf
                                                                @method('patch')

                                                                <div class="text-center mt-5 mb-5">
                                                                    <p class="text-center">
                                                                        Are you sure you want to approuve this holiday demand?
                                                                    </p>
                                                                    <input type="hidden" value="approuved" id="input-status" name="status">
                                                                </div>
                                                                <div class="text-end">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Rejected Holiday Demand Modal -->
                                            <div class="modal fade" id="rejectedHolidayDemandA-{{ $demand->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-3" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-3">Rejected Holiday Demand</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('holidays-update-status', $demand->id) }}">
                                                                @csrf
                                                                @method('patch')

                                                                <div class="text-center mt-5 mb-5">
                                                                    <p class="text-center">
                                                                        Are you sure you want to reject this holiday demand?
                                                                    </p>
                                                                    <input type="hidden" value="rejected" id="input-status" name="status">
                                                                </div>
                                                                <div class="text-end">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Holiday Demand Modal -->
                                            <div class="modal fade" id="deleteHolidayDemandA-{{ $holiday->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-4" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-4">Delete Holiday Demand</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('holidays.destroy', $holiday->id) }}">
                                                                @csrf
                                                                @method('patch')

                                                                <div class="text-center mt-5 mb-5">
                                                                    <p class="text-center">
                                                                        Are you sure you want to delete this holiday demand?
                                                                    </p>
                                                                    <input type="hidden" value="rejected" id="input-status" name="status">
                                                                </div>
                                                                <div class="text-end">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </div>

                            {{-- <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <!-- Previous Page Link -->
                                    @if ($user->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-hidden="true">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $user->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    @endif

                                    <!-- Pagination Elements -->
                                    @foreach ($user->getUrlRange(1, $user->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $user->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Next Page Link -->
                                    @if ($user->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $user->nextPageUrl() }}" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-hidden="true">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav> --}}
                            <!-- end row -->
                        </div>
                    </div>
                    <!-- end tab pane -->

                    <div class="tab-pane" id="list-rejected" role="tabpanel">
                        <div>
                            <div>
                                @foreach ($holidays as $holiday)
                                    @foreach ($demands as $demand)
                                        @foreach ($users as $user)
                                            @if ((Auth::user()->roles->pluck('name')[0] == 'user') && ($demand->holiday_id == $holiday->id) && ($demand->user_id == Auth::user()->id))
                                                @if ($demand->status == "rejected")
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="avatar">
                                                                    @if(Auth::user()->photo)
                                                                        <img src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @else
                                                                        <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @endif
                                                                </div>
                                                                <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                    <h5 class="font-size-16 mb-0">
                                                                        <!-- <a href="#" class="text-reset"></a> -->
                                                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                                                    </h5>
                                                                    <p class="badge badge-soft-primary mb-0">
                                                                        @foreach ($functions as $function)
                                                                            @if (Auth::user()->position_id == $function->id)
                                                                                {{ $function->position_name }}
                                                                            @endif
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <div class="d-flex gap-2">
                                                                        <div class="dropdown">
                                                                            <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li><a class="dropdown-item text-primary" data-bs-toggle="modal" href="#updateHolidayDemandR-{{ $holiday->id }}">Edit</a></li>
                                                                                <li><a class="dropdown-item text-danger" data-bs-toggle="modal" href="#deleteHolidayDemandR-{{ $holiday->id }}">Delete</a></li>
                                                                                <!-- <li>
                                                                                    <hr class="dropdown-divider">
                                                                                </li>
                                                                                <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                        <div class="">
                                                            <div class="row g-0 border-top">
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                            <div class="badge badge-soft-info font-size-12">
                                                                                @foreach ($holidaysType as $holidayType)
                                                                                    @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                        {{ $holidayType->holiday_label }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Period</p>
                                                                            <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-danger font-size-12">Rejected</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end col -->
                                                            </div><!-- end row -->
                                                        </div>
                                                    </div>
                                                    <!-- end card -->
                                                @endif
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'admin') && ($demand->holiday_id == $holiday->id) && ($demand->user_id == Auth::user()->id))
                                                @if ($demand->status == "rejected")
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="avatar">
                                                                    @if(Auth::user()->photo)
                                                                        <img src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @else
                                                                        <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @endif
                                                                </div>
                                                                <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                    <h5 class="font-size-16 mb-0">
                                                                        <!-- <a href="#" class="text-reset"></a> -->
                                                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                                                    </h5>
                                                                    <p class="badge badge-soft-primary mb-0">
                                                                        @foreach ($functions as $function)
                                                                            @if (Auth::user()->position_id == $function->id)
                                                                                {{ $function->position_name }}
                                                                            @endif
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <div class="d-flex gap-2">
                                                                        <div class="dropdown">
                                                                            <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li><a class="dropdown-item text-primary" data-bs-toggle="modal" href="#updateHolidayDemandR-{{ $holiday->id }}">Edit</a></li>
                                                                                <li><a class="dropdown-item text-danger" data-bs-toggle="modal" href="#deleteHolidayDemandR-{{ $holiday->id }}">Delete</a></li>
                                                                                <!-- <li>
                                                                                    <hr class="dropdown-divider">
                                                                                </li>
                                                                                <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                        <div class="">
                                                            <div class="row g-0 border-top">
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                            <div class="badge badge-soft-info font-size-12">
                                                                                @foreach ($holidaysType as $holidayType)
                                                                                    @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                        {{ $holidayType->holiday_label }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Period</p>
                                                                            <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-danger font-size-12">Rejected</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end col -->
                                                            </div><!-- end row -->
                                                        </div>
                                                    </div>
                                                    <!-- end card -->
                                                @endif
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'admin') && ($demand->holiday_id == $holiday->id) && ($demand->user_id !== Auth::user()->id))
                                            @if (($demand->holiday_id == $holiday->id) && ($demand->user_id == $user->id))
                                                    @if ($demand->status == "rejected")
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="avatar">
                                                                        @if($user->photo)
                                                                            <img src="{{ $user->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @else
                                                                            <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @endif
                                                                    </div>
                                                                    <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                        <h5 class="font-size-16 mb-0">
                                                                            <!-- <a href="#" class="text-reset"></a> -->
                                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                                        </h5>
                                                                        <p class="badge badge-soft-primary mb-0">
                                                                            @foreach ($functions as $function)
                                                                                @if ($user->position_id == $function->id)
                                                                                    {{ $function->position_name }}
                                                                                @endif
                                                                            @endforeach
                                                                        </p>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                    <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                                    <li class="dropdown-item">Nothing to do</li>
                                                                                    <!-- <li>
                                                                                        <hr class="dropdown-divider">
                                                                                    </li>
                                                                                    <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                            <div class="">
                                                                <div class="row g-0 border-top">
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                                <div class="badge badge-soft-info font-size-12">
                                                                                    @foreach ($holidaysType as $holidayType)
                                                                                        @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                            {{ $holidayType->holiday_label }}
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Period</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                    <span class="badge bg-danger font-size-12">Rejected</span>
                                                                                </p>
                                                                            </div>

                                                                            <div class="progress mt-3" style="height: 6px;">
                                                                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                    <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                </div><!-- end row -->
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'moderator') && ($demand->holiday_id == $holiday->id) && ($demand->user_id == Auth::user()->id))
                                                @if ($demand->status == "rejected")
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="avatar">
                                                                    @if(Auth::user()->photo)
                                                                        <img src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @else
                                                                        <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                    @endif
                                                                </div>
                                                                <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                    <h5 class="font-size-16 mb-0">
                                                                        <!-- <a href="#" class="text-reset"></a> -->
                                                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                                                    </h5>
                                                                    <p class="badge badge-soft-primary mb-0">
                                                                        @foreach ($functions as $function)
                                                                            @if (Auth::user()->position_id == $function->id)
                                                                                {{ $function->position_name }}
                                                                            @endif
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <div class="d-flex gap-2">
                                                                        <div class="dropdown">
                                                                            <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li><a class="dropdown-item text-primary" data-bs-toggle="modal" href="#updateHolidayDemandR-{{ $holiday->id }}">Edit</a></li>
                                                                                <li><a class="dropdown-item text-danger" data-bs-toggle="modal" href="#deleteHolidayDemandR-{{ $holiday->id }}">Delete</a></li>
                                                                                <!-- <li>
                                                                                    <hr class="dropdown-divider">
                                                                                </li>
                                                                                <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                        <div class="">
                                                            <div class="row g-0 border-top">
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                            <div class="badge badge-soft-info font-size-12">
                                                                                @foreach ($holidaysType as $holidayType)
                                                                                    @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                        {{ $holidayType->holiday_label }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2">Period</p>
                                                                            <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                <span class="badge bg-danger font-size-12">Rejected</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="progress mt-3" style="height: 6px;">
                                                                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-sm-6">
                                                                    <div class="border-end p-3 h-100">
                                                                        <div>
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end col -->
                                                            </div><!-- end row -->
                                                        </div>
                                                    </div>
                                                    <!-- end card -->
                                                @endif
                                            @elseif ((Auth::user()->roles->pluck('name')[0] == 'moderator') && ($demand->holiday_id == $holiday->id) && ($demand->user_id !== Auth::user()->id))
                                                @if (($demand->holiday_id == $holiday->id) && ($demand->user_id == $user->id))
                                                    @if ($demand->status == "rejected")
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="avatar">
                                                                        @if($user->photo)
                                                                            <img src="{{ $user->photo }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @else
                                                                            <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar rounded-circle">
                                                                        @endif
                                                                    </div>
                                                                    <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                                                        <h5 class="font-size-16 mb-0">
                                                                            <!-- <a href="#" class="text-reset"></a> -->
                                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                                        </h5>
                                                                        <p class="badge badge-soft-primary mb-0">
                                                                            @foreach ($functions as $function)
                                                                                @if ($user->position_id == $function->id)
                                                                                    {{ $function->position_name }}
                                                                                @endif
                                                                            @endforeach
                                                                        </p>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                    <i class="icon-xs" data-feather="more-horizontal"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                                    <li class="dropdown-item">Nothing to do</li>
                                                                                    <!-- <li>
                                                                                        <hr class="dropdown-divider">
                                                                                    </li>
                                                                                    <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                            <div class="">
                                                                <div class="row g-0 border-top">
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Holiday Type</p>
                                                                                <div class="badge badge-soft-info font-size-12">
                                                                                    @foreach ($holidaysType as $holidayType)
                                                                                        @if ($holidayType->id == $holiday->holiday_type_id)
                                                                                            {{ $holidayType->holiday_label }}
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2">Period</p>
                                                                                <h5 class="font-size-12 mb-0">{{ $holiday->start_date }}  to  {{ $holiday->end_date }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <p class="text-muted font-size-13 mb-2 d-flex justify-content-between">Status
                                                                                    <span class="badge bg-danger font-size-12">Rejected</span>
                                                                                </p>
                                                                            </div>

                                                                            <div class="progress mt-3" style="height: 6px;">
                                                                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Created at</p>
                                                                                    <h5 class="font-size-12 mb-0">{{ $holiday->created_at }}</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                    <div class="col-xl-2 col-sm-5">
                                                                        <div class="border-end p-3 h-100">
                                                                            <div>
                                                                                <div>
                                                                                    <p class="text-muted font-size-13 mb-2">Actions</p>
                                                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#approuvedHolidayDemandR-{{ $demand->id }}">Approuved</button>
                                                                                    <button type="button" class="btn btn-danger btn-sm" disabled data-bs-toggle="modal" data-bs-target="#rejectedHolidayDemandR-{{ $demand->id }}">Rejected</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end col -->
                                                                </div><!-- end row -->
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif
                                            <!-- @if ($demand->status == "rejected")
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p>No holidays demand in progress.</p>
                                                    </div>
                                                </div>
                                            @endif -->

                                            <!-- Approuved Holiday Demand Modal -->
                                            <div class="modal fade" id="approuvedHolidayDemandR-{{ $demand->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-2" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-2">Approuved Holiday Demand</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('holidays-update-status', $demand->id) }}">
                                                                @csrf
                                                                @method('patch')

                                                                <div class="text-center mt-5 mb-5">
                                                                    <p class="text-center">
                                                                        Are you sure you want to approuve this holiday demand?
                                                                    </p>
                                                                    <input type="hidden" value="approuved" id="input-status" name="status">
                                                                </div>
                                                                <div class="text-end">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Rejected Holiday Demand Modal -->
                                            <div class="modal fade" id="rejectedHolidayDemandR-{{ $demand->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-3" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-3">Rejected Holiday Demand</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('holidays-update-status', $demand->id) }}">
                                                                @csrf
                                                                @method('patch')

                                                                <div class="text-center mt-5 mb-5">
                                                                    <p class="text-center">
                                                                        Are you sure you want to reject this holiday demand?
                                                                    </p>
                                                                    <input type="hidden" value="rejected" id="input-status" name="status">
                                                                </div>
                                                                <div class="text-end">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Holiday Demand Modal -->
                                            <div class="modal fade" id="deleteHolidayDemandR-{{ $holiday->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-4" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-4">Delete Holiday Demand</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('holidays.destroy', $holiday->id) }}">
                                                                @csrf
                                                                @method('patch')

                                                                <div class="text-center mt-5 mb-5">
                                                                    <p class="text-center">
                                                                        Are you sure you want to delete this holiday demand?
                                                                    </p>
                                                                    <input type="hidden" value="rejected" id="input-status" name="status">
                                                                </div>
                                                                <div class="text-end">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </div>

                            {{-- <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <!-- Previous Page Link -->
                                    @if ($user->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-hidden="true">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $user->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    @endif

                                    <!-- Pagination Elements -->
                                    @foreach ($user->getUrlRange(1, $user->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $user->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Next Page Link -->
                                    @if ($user->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $user->nextPageUrl() }}" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-hidden="true">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav> --}}
                            <!-- end row -->
                        </div>
                    </div>
                    <!-- end tab pane -->
                </div>
                <!-- end tab content -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
