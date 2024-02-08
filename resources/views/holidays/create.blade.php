@extends('layouts.master')
@section('title') Create New Holiday Demand @endsection
@section('css')

<!-- dropzone css -->
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<!-- flatpickr css -->
<link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    {{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Apps @endslot
            @slot('li_2') Holidays @endslot
            @slot('title') New Holiday Demand @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h5 class="card-title mb-3">Holiday's Information</h5>
                    <ul class="wizard-nav">
                        <li class="wizard-list-item">
                            <div class="list-item">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="General Info">
                                    <i class="uil uil-clipboard-notes"></i>
                                </div>
                            </div>
                        </li>

                        <li class="wizard-list-item">
                            <div class="list-item">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Attached Files">
                                    <i class="uil uil-paperclip"></i>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- wizard-nav -->
                    <p class="card-title-desc">Fill all flieds below</p>
                </div>

                <!-- From -->
                <form method="POST" action="{{ route('holidays.store') }}" enctype="multipart/form-data">
                    @csrf

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
                            <div class="avatar">
                                <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                    <span class="step-icon"><i class="uil uil-clipboard-notes"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="row">
                                    <!-- Holiday type flied -->
                                    <div class="mb-3">
                                        <label class="form-label" for="input-holidayType">Holiday type</label>
                                        <select class="form-select" id="input-holidayType" name="holidayType">
                                            <option>Select holiday</option>
                                            @foreach($holidaysType as $holidayType)
                                                <option value="{{ $holidayType->id }}">{{ $holidayType->holiday_label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mt-4">
                                    <!-- Start date flied -->
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label" for="input-startDate">Start Date</label>
                                        <input class="form-control" type="date" value="" id="input-startDate" name="startDate">
                                    </div>
                                    
                                    <!-- End date flied -->
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label" for="input-endDate">End Date</label>
                                        <input class="form-control" type="date" value="" id="input-endDate" name="endDate">
                                    </div>
                                    
                                    <!-- User Id flied -->
                                    <div class="col-lg-6">
                                        <input class="form-control" type="hidden" value="{{ Auth::user()->id }}" id="input-userId" name="user_id">
                                    </div>
                                </div>
                                <!-- end row -->
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
                                <h5 class="card-title">Attached Files</h5>
                            </div>
                            <div class="avatar">
                                <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                    <span class="step-icon"><i class="uil uil-paperclip"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h5>Upload Credential Files</h5>
                            </div>

                            <!-- Credential flied -->
                            <div class="dropzone">
                                <div class="fallback">
                                    <input type="file" id="input-credential" name="credential"/>
                                </div>

                                <div class="dz-message needsclick w-100">
                                    <div class="mb-3 w-100">
                                        <img id="image_preview" name="credential_image" class="rounded-md h-25 w-25" 
                                            src="{{ URL::asset('assets/images/upload-icon.png') }}" alt="Credential preview"/>
                                    </div>
                                    @error('credential-image')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror

                                    <!-- <div class="mb-3">
                                        <i class="display-4 text-light uil uil-upload-alt"></i>
                                    </div>

                                    <h5 class="font-size-16">Drop files here or click to upload.</h5> -->

                                    {{-- @if (srcImage == "")
                                    @else
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <div class="text-end">
                        <button type="reset" class="btn btn-secondary w-sm">Cancel</button>
                        <button type="submit" class="btn btn-primary w-sm">Submit</button>
                    </div>
                </form>
                <!-- end form -->
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <div class="col-lg-1"></div>
</div>

@endsection

@section('script')
    <!-- flatpickr js -->
    <script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <!-- dropzone plugin -->
    <script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ URL::asset('assets/js/pages/project-create.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    <script>
        // Create onchange event listener for credential image
        document.getElementById('input-credential').onchange = function(e) {
            const [file] = this.files;
            if (file) {
                // if there is an image, create a preview in image_preview
                document.getElementById('image_preview').src = URL.createObjectURL(file);
                document.getElementById('image_preview').className = "w-100";
            }
        }
    </script>
@endsection
