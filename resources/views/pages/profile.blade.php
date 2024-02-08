@extends('layouts.master')
@section('title') Profile @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
@endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Apps @endslot
            @slot('li_2') Pages @endslot
            @slot('title') Profile @endslot
        @endcomponent
    @endsection
    
<div class="row">
    <div class="col-xxl-3 col-lg-4">
        <div class="card">
            <div class="card-body p-0">
                <div class="user-profile-img">
                    <img src="{{URL::asset('assets/images/pattern-bg.jpg')}}" class="profile-img profile-foreground-img rounded-top" style="height: 120px;" alt="cover">
                    <div class="overlay-content rounded-top">
                        <div>
                            <div class="user-nav p-3">
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal font-size-20 text-white"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Change photo</a></li>
                                            <li><a class="dropdown-item" href="#">Change cover</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end user-profile-img -->

                <div class="mt-n5 position-relative">
                    <div class="text-center">
                        @if(Auth::user()->photo)
                            <img class="rounded-circle header-profile-user" src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar-xl rounded-circle img-thumbnail">
                        @else
                            <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar-xl rounded-circle img-thumbnail">
                        @endif

                        <div class="mt-3">
                            <h5 class="mb-1">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                            <h6 class="mb-1">{{ Auth::user()->email }}</h6>
                            <div>
                                {{-- <a href="#" class="badge bg-success-subtle text-success m-1">{{ Auth::user()->position }}</a> --}}
                                <a href="#" class="badge bg-success-subtle text-success m-1">Function here</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="p-3 mt-3 border-bottom">
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <div class="p-1">
                                <h5 class="mb-1">5</h5>
                                <p class="text-muted mb-0">Holiday Balance</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-1">
                                <h5 class="mb-1">3</h5>
                                <p class="text-muted mb-0">Current Balance</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 mt-2">
                    <h5 class="font-size-16">Infos:</h5>

                    <div class="mt-4">
                        <p class="text-muted mb-1">First Name:</p>
                        <h5 class="font-size-14 text-truncate">{{ Auth::user()->first_name }}</h5>
                    </div>

                    <div class="mt-4">
                        <p class="text-muted mb-1">Last Name:</p>
                        <h5 class="font-size-14 text-truncate">{{ Auth::user()->last_name }}</h5>
                    </div>

                    <div class="mt-4">
                        <p class="text-muted mb-1">E-mail:</p>
                        <h5 class="font-size-14 text-truncate">{{ Auth::user()->email }}</h5>
                    </div>

                    <div class="mt-4">
                        <p class="text-muted mb-1">Phone Number:</p>
                        <h5 class="font-size-14 text-truncate">{{ Auth::user()->phone_number }}</h5>
                    </div>

                    <div class="mt-4">
                        <p class="text-muted mb-1">Functions:</p>
                        <h5 class="font-size-14 text-truncate">Function here</h5>
                        {{-- <h5 class="font-size-14 text-truncate">{{ Auth::user()->position }}</h5> --}}
                    </div>
                </div>

            </div>
            <!-- end card body -->
        </div>
    </div>
    <!-- end col -->

    <div class="col-xxl-9 col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Personal Informations</h5>
                <form>
                    <div class="card border shadow-none mb-5">
                        <div class="card-header d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                    <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                        01
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title">General Information</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="gen-info-name-input">First Name</label>
                                            <input type="text" class="form-control" id="gen-info-name-input" placeholder="Enter your first name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="gen-info-name-input">Last Name</label>
                                            <input type="text" class="form-control" id="gen-info-name-input" placeholder="Enter your last name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label for="choices-multiple-skill-input" class="form-label">Functions</label>
                                    <select class="form-control" name="choices-multiple-skill-input" id="choices-multiple-skill-input" multiple>
                                        <option value="Database Administrator" selected>Database Administrator</option>
                                        <option value="Java Developer" selected>Java Developer</option>
                                        <option value="Project Manager">Project Manager</option>
                                        <option value="Community Manager">Community Manager</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <div class="card border shadow-none mb-5">
                        <div class="card-header d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                    <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                        02
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title">Contact Information</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="contact-info-email-input">E-mail :</label>
                                <input type="email" class="form-control" id="contact-info-email-input" placeholder="Enter your email address">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-md-0">
                                        <label for="contact-info-phonenumber-input" class="form-label">Phone Number</label>
                                        <input type="number" class="form-control" placeholder="Enter your phone number" id="contact-info-phonenumber-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <div class="card border shadow-none">
                        <div class="card-header d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                    <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                        03
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title">Change passowrd</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-lg-0">
                                        <label for="current-password-input" class="form-label">Current password</label>
                                        <input type="password" class="form-control" placeholder="Enter your current password" id="current-password-input">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-lg-0">
                                        <label for="new-password-input" class="form-label">New password</label>
                                        <input type="password" class="form-control" placeholder="Enter your new password" id="new-password-input">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-lg-0">
                                        <label for="confirm-password-input" class="form-label">Confirm password</label>
                                        <input type="password" class="form-control" placeholder="Confirm your password" id="confirm-password-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary w-sm">Submit</button>
                    </div>
                </form>
                <!-- end form -->
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection
@section('script')

<!-- plugins -->
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<!-- init js -->
<script src="{{ URL::asset('assets/js/pages/user-settings.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
