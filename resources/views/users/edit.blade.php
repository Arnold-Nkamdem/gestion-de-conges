@extends('layouts.master')
@section('title')
    Edit User
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            User
        @endslot
        @slot('title')
            Edit User
        @endslot
    @endcomponent
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('users.update', $user->id) }}" class="mt-4 pt-2">
                    @csrf
                    @method('put')

                    <!-- First name flied -->
                    <div class="form-floating form-floating-custom mb-3">
                        <input type="text" id="input-first_name" placeholder="Enter first name"
                            class="form-control @error('first_name') is-invalid @enderror" name="first_name" 
                            value="{{ $user->first_name }}" required autocomplete="first_name" required autofocus>
                        <label for="input-first_name">{{ __('First Name') }}</label>
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating-icon">
                            <i class="uil uil-users-alt"></i>
                        </div>
                    </div>

                    <!-- Last name flied -->
                    <div class="form-floating form-floating-custom mb-3">
                        <input type="text" id="input-last_name" placeholder="Enter last name"
                            class="form-control @error('last_name') is-invalid @enderror" name="last_name" 
                            value="{{ $user->last_name }}" required autocomplete="name" required>
                        <label for="input-last_name">{{ __('Last Name') }}</label>
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating-icon">
                            <i class="uil uil-users-alt"></i>
                        </div>
                    </div>

                    <!-- Email flied -->
                    <div class="form-floating form-floating-custom mb-3">
                        <input type="email" id="input-email" placeholder="Enter email address" required=""
                            class="form-control @error('email') is-invalid @enderror" name="email" 
                            value="{{ $user->email }}" required autocomplete="email" required>
                        <div class="invalid-feedback">
                            Please Enter Email
                        </div>
                        <label for="input-email">{{ __('Email Address') }}</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating-icon">
                            <i class="uil uil-envelope-alt"></i>
                        </div>
                    </div>

                    <!-- Phone number flied -->
                    <div class="form-floating form-floating-custom mb-3">
                        <input type="text" id="input-phone_number" placeholder="Enter phone number"
                            class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" 
                            value="{{ $user->phone_number }}" required autocomplete="phone_number" required autofocus>
                        <label for="input-phone_number">{{ __('Phone Number') }}</label>
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating-icon">
                            <i class="uil uil-phone-alt"></i>
                        </div>
                    </div>

                    <!-- Function flied -->
                    <div class="form-floating form-floating-custom mb-3">
                        <input type="number" id="input-function" placeholder="Enter function"
                            class="form-control @error('function') is-invalid @enderror" name="function" 
                            value="{{ $user->position_id }}" required autocomplete="position_id" required autofocus>
                        <label for="input-function">{{ __('Function') }}</label>
                        @error('function')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating-icon">
                            <i class="bx bx-briefcase-alt"></i>
                        </div>
                    </div>

                    <!-- Role flied -->
                    <div class="form-floating form-floating-custom mb-3">
                        <select class="form-control" name="role" id="role">
                            <option value="{{ $user->roles->pluck('name')[0] }}">{{ $user->roles->pluck('name')[0] }}</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                        <label for="input-email">{{ __('Role') }}</label>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating-icon">
                            <i class="uil uil-lock-alt"></i>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form><!-- end form -->
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<!-- plugin js -->
<script src="{{ URL::asset('assets/libs/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/calendar.init.js') }}"></script>
@endsection
