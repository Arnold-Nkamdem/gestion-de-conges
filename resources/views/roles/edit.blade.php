@extends('layouts.master')
@section('title')
    Edit Role
@endsection
@section('content')
    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            Role
        @endslot
        @slot('title')
            Role Edit
        @endslot
    @endcomponent
@endsection

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p class="mb-0">{{ $message }}</p>
    </div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => ['roles.update', $role->id], 'method' => 'POST']) !!}
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Role:</label>
                            {!! Form::text('name', $role->name, ['placeholder' => 'role', 'class' => 'form-control']) !!}
                            @error('name')
                                <span class="text-sm text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="permission" class="form-label d-block">Permission:</label>
                            @foreach ($permission as $value)
                                @php
                                    $checked = $role->permissions->contains($value->id);
                                @endphp
                                <label>{{ Form::checkbox('permission[]', $value->id, $checked, ['class' => 'name']) }}
                                    {{ $value->name }}</label>
                                <br />
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
