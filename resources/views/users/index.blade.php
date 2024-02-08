@extends('layouts.master')
@section('title')
    Users
@endsection
@section('content')
    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            Apps
        @endslot
        @slot('li_2')
            Users
        @endslot
        @slot('title')
            Users List
        @endslot
    @endcomponent
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p class="mb-0">{{ $message }}</p>
                    </div>
                @endif
                <div class="row d-flex align-items-center justify-content-between mb-5">
                    <div class="col-6">
                        <a class="btn btn-warning" href="{{ URL::previous() }}"><i class='bx bx-left-arrow-alt'></i> Back</a>
                        @can('role-list')
                            <a class="btn btn-success" href="{{ route('show-roles') }}"> Roles List</a>
                        @endcan
                    </div>

                    <!-- Button trigger modal -->
                    <div class="col-6 d-flex align-items-end justify-content-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewUser">
                            Add New User
                        </button>
                    </div>
                </div>

                <!-- Add User Modal -->
                <div class="modal fade" id="addNewUser" tabindex="-1" aria-labelledby="exampleModalLabel-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel-1">Create New User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" class="mt-4 pt-2">
                                    @csrf

                                    <!-- First name flied -->
                                    <div class="form-floating form-floating-custom mb-3">
                                        <input type="text" id="input-first_name" placeholder="Enter first name"
                                            class="form-control @error('first_name') is-invalid @enderror" name="first_name" required autofocus>
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
                                            class="form-control @error('last_name') is-invalid @enderror" name="last_name" required>
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
                                            class="form-control @error('email') is-invalid @enderror" name="email" required>
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
                                            class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" required autofocus>
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
                                        <select class="form-control @error('function') is-invalid @enderror" name="function" id="input-function" required>
                                            <option>Define function</option>
                                            @foreach ($functions as $function)
                                                <option value="{{ $function->id }}">{{ $function->position_name }}</option>
                                            @endforeach
                                        </select>
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
                                        <select class="form-control" name="role" id="input-role">
                                            <option>Add role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}">{{ $role }}</option>
                                            @endforeach
                                        </select>
                                        <label for="input-role">{{ __('Role') }}</label>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-floating-icon">
                                            <i class="uil uil-lock-alt"></i>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                </form>
                                <!-- end form -->
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table border table-striped mb-5">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Function</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = 1;
                        ?>
                        @foreach ($users as $key => $data)
                            <tr class="@if ($data->email === Auth::user()->email) border border-warning-subtle @endif">
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $data->first_name }}</td>
                                <td>{{ $data->last_name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->phone_number }}</td>
                                <td>
                                    @foreach ($functions as $function)
                                        @if ($data->position_id == $function->id)
                                            {{ $function->position_name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($data->roles as $v)
                                        <label class="label label-success">{{ $v->name }}</label>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($data->roles->pluck('name')[0] !== 'admin')
                                        {{-- <a class="btn btn-primary btn-sm" data-bs-toggle="modal" href="{{ route(users.edit), $data->id }}">Edit</a> --}}
                                        <a class="btn btn-primary btn-sm" data-bs-toggle="modal" href="#updateUser-{{ $data->id }}">Edit</a>
                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal" href="#deleteUser-{{ $data->id }}">Delete</a>
                                    @else
                                        Not Editable
                                    @endif
                                </td>
                            </tr>

                            <!-- Update User Modal -->
                            <div class="modal fade" id="updateUser-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel-2">Update User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('users.update', $data->id) }}" enctype="multipart/form-data" class="mt-4 pt-2">
                                                @csrf
                                                @method('put')

                                                <!-- First name flied -->
                                                <div class="form-floating form-floating-custom mb-3">
                                                    <input type="text" id="input-first_name" placeholder="Enter first name"
                                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name" 
                                                        value="{{ $data->first_name }}" required autocomplete="first_name" required autofocus>
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
                                                        value="{{ $data->last_name }}" required autocomplete="name" required>
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
                                                        value="{{ $data->email }}" required autocomplete="email" required>
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
                                                        value="{{ $data->phone_number }}" required autocomplete="phone_number" required autofocus>
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
                                                    <select class="form-control @error('function') is-invalid @enderror" name="function" id="input-function" required>
                                                        @foreach ($functions as $function)
                                                            @if ($function->id == $data->position_id)
                                                                <option value="{{ $function->id }}">{{ $function->position_name }}</option>
                                                            @endif
                                                        @endforeach
                                                        @foreach ($functions as $function)
                                                            <option value="{{ $function->id }}">{{ $function->position_name }}</option>
                                                        @endforeach
                                                    </select>
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
                                                        <option value="{{ $data->roles->pluck('name')[0] }}">{{ $data->roles->pluck('name')[0] }}</option>
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
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                            <!-- end form -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete User Modal -->
                            <div class="modal fade" id="deleteUser-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-3" aria-hidden="true" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel-3">Delete User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('users.destroy', $data->id) }}">
                                                @csrf
                                                @method('delete')

                                                <div class="text-center mt-5 mb-5">
                                                    <p class="text-center">Are you sure you want to detele the user N°
                                                        <span class="text-success">{{ $data->id }}</span>
                                                        <span class="text-primary">{{ $data->first_name }} {{ $data->last_name }}</span>?
                                                    </p>
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
                    </tbody>
                </table>
                
                <!-- Navigation -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($users->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link" aria-hidden="true">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($users->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link" aria-hidden="true">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
