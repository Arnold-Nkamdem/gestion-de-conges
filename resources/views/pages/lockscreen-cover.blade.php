@extends('layouts.master-without-nav')
@section('title')Lock Screen @endsection
@section('content')

<div class="auth-page d-flex align-items-center min-vh-100">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="d-flex flex-column h-100 py-5 px-4">
                    <div class="text-center text-muted mb-2">
                        <div class="pb-3">
                            <a href="{{ url('index') }}">
                                <span class="logo-lg">
                                    <img src="{{URL::asset('assets/images/logo-b.png')}}" alt="logo" height="120">
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="my-auto">
                        <div class="p-3 text-center">
                            <img src="{{URL::asset('assets/images/auth-img.png')}}" alt="" class="img-fluid">
                        </div>
                    </div>

                    <div class="mt-4 mt-md-5 text-center">
                        <p class="mb-0">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script> AN Digital. Crafted with <i class="mdi mdi-heart text-danger"></i> by AN Design
                        </p>
                    </div>
                </div>

                <!-- end auth full page content -->
            </div>
            <!-- end col -->

            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg bg-light py-md-5 p-4 d-flex">
                    <div class="bg-overlay-gradient"></div>
                    <!-- end bubble effect -->
                    <div class="row justify-content-center g-0 align-items-center w-100">
                        <div class="col-xl-4 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="px-3 py-3 text-center">
                                        <div class="user-thumb mb-4 mb-md-5">
                                            @if(Auth::user()->photo)
                                                <img class="rounded-circle header-profile-user" src="{{ Auth::user()->photo }}" alt="profile photo" class="avatar-xl rounded-circle img-thumbnail">
                                            @else
                                                <img src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="profile photo" class="avatar-xl rounded-circle img-thumbnail">
                                            @endif
                                            <h5 class="font-size-18 mt-3">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                                        </div>

                                        <form>
                                            <div class="form-floating form-floating-custom mb-3">
                                                <input type="password" class="form-control" id="input-password" placeholder="Enter Password">
                                                <label for="input-password">Password</label>
                                                <div class="form-floating-icon">
                                                    <i class="uil uil-padlock"></i>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="button">Unlock</button>
                                            </div>

                                            <div class="mt-4 text-center">
                                                <p class="text-muted mb-0">
                                                    Not you? Return to 
                                                    <a href="{{ url('login') }}" class="fw-semibold text-decoration-underline">
                                                        Log In page 
                                                    </a> 
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>
<!-- end authentication section -->

@endsection
