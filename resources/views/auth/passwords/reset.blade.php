
@extends('layouts.master-without-nav')
@section('title')Forgot Password @endsection
@section('content')

<div class="auth-bg-basic d-flex align-items-center min-vh-100">
    <div class="bg-overlay bg-light"></div>
    <div class="container">
        <div class="d-flex flex-column py-5 px-3">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="text-center text-muted mb-2">
                        <div class="pb-3">
                            <a href="{{ url('index') }}">
                                <span class="logo-lg">
                                    <img src="{{URL::asset('assets/images/logo-b.png')}}" alt="" height="120">
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center my-auto">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-transparent shadow-none border-0">
                        <div class="card-body">
                            <div class="py-3">
                                <div class="text-center">
                                    <h5 class="mb-0">Forgot Password</h5>
                                    <p class="text-muted mt-2">Forgot Your Password?</p>
                                </div>
                                <form class="mt-4 pt-2" method="POST" action="{{ route('password.update') }}">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-floating form-floating-custom mb-3">
                                        <input type="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        <label for="email">{{ __('Email Address') }}</label>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="form-floating-icon">
                                            <i class="uil uil-padlock"></i>
                                        </div>
                                    </div>

                                    <div class="form-floating form-floating-custom mb-3">
                                        <input type="password" id="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        <label for="newpassword">{{ __('Password') }}</label>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="form-floating-icon">
                                            <i class="uil uil-padlock"></i>
                                        </div>
                                    </div>

                                    <div class="form-floating form-floating-custom mb-3">
                                        <input type="password" id="confirmpassword" placeholder="Password"  class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        <label for="input-confirmpassword">{{ __('Confirm Password') }}</label>
                                        <div class="form-floating-icon">
                                            <i class="uil uil-check-circle"></i>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-100">{{ __('Reset Password') }} </button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="text-muted mb-0">Remember It ? <a href="auth-signin-basic" class="fw-semibold text-decoration-underline"> Sign In </a> </p>
                                    </div>

                                </form><!-- end form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="mt-4 mt-md-5 text-center">
                        <p class="mb-0">
                            © <script>
                                document.write(new Date().getFullYear())

                            </script> AN Digital. Crafted with <i class="mdi mdi-heart text-danger"></i> by AN Design</p>
                    </div>
                </div>
            </div> <!-- end row -->
        </div>
    </div>
    <!-- end container fluid -->
</div>
<!-- end authentication section -->
@endsection
