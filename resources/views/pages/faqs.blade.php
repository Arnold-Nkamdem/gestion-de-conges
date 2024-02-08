@extends('layouts.master')
@section('title')FAQs @endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Apps @endslot
            @slot('li_2') Pages @endslot
            @slot('title') FAQs @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card bg-light overflow-hidden">
                            <div class="card-body">
                                <div class="faq-icon">
                                    <i class="bx bx-help-circle text-primary"></i>
                                </div>
                                <h5 class="text-primary">01.</h5>
                                <h5 class="faq-title mt-3">What is Lorem Ipsum?</h5>
                                <p class="faq-ans text-muted mt-2 mb-0">The point of using Lorem Ipsum is that it
                                    has a more-or-less normal they distribution of letters content here.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card bg-light overflow-hidden">
                            <div class="card-body">
                                <div class="faq-icon">
                                    <i class="bx bx-help-circle text-primary"></i>
                                </div>
                                <h5 class="text-primary">02.</h5>
                                <h5 class="faq-title mt-3">Why use Lorem Ipsum?</h5>
                                <p class="faq-ans text-muted mt-2 mb-0">If several languages coalesce, the grammar resulting language is more simple and regular than individual languages.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card bg-light overflow-hidden">
                            <div class="card-body">
                                <div class="faq-icon">
                                    <i class="bx bx-help-circle text-primary"></i>
                                </div>
                                <h5 class="text-primary">03.</h5>
                                <h5 class="faq-title mt-3">How many variations exist?</h5>
                                <p class="faq-ans text-muted mt-2 mb-0">The point of using Lorem Ipsum is that it has a more-or-less normal they distribution of letters content here.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card bg-light overflow-hidden">
                            <div class="card-body">
                                <div class="faq-icon">
                                    <i class="bx bx-help-circle text-primary"></i>
                                </div>
                                <h5 class="text-primary">04.</h5>
                                <h5 class="faq-title mt-3">Is safe use Lorem Ipsum?</h5>
                                <p class="faq-ans text-muted mt-2 mb-0">The point of using Lorem Ipsum is that it has a more-or-less normal they distribution of letters content here.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card bg-light overflow-hidden">
                            <div class="card-body">
                                <div class="faq-icon">
                                    <i class="bx bx-help-circle text-primary"></i>
                                </div>
                                <h5 class="text-primary">05.</h5>
                                <h5 class="faq-title mt-3">Is safe use Lorem Ipsum?</h5>
                                <p class="faq-ans text-muted mt-2 mb-0">The point of using Lorem Ipsum is that it has a more-or-less normal they distribution of letters content here.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card bg-light overflow-hidden">
                            <div class="card-body">
                                <div class="faq-icon">
                                    <i class="bx bx-help-circle text-primary"></i>
                                </div>
                                <h5 class="text-primary">06.</h5>
                                <h5 class="faq-title mt-3">Is safe use Lorem Ipsum?</h5>
                                <p class="faq-ans text-muted mt-2 mb-0">If several languages coalesce, the grammar resulting language is more simple and regular than individual languages.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card bg-light overflow-hidden">
                            <div class="card-body">
                                <div class="faq-icon">
                                    <i class="bx bx-help-circle text-primary"></i>
                                </div>
                                <h5 class="text-primary">07.</h5>
                                <h5 class="faq-title mt-3">What is Lorem Ipsum?</h5>
                                <p class="faq-ans text-muted mt-2 mb-0">If several languages coalesce, the grammar resulting language is more simple and regular than individual languages.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card bg-light overflow-hidden">
                            <div class="card-body">
                                <div class="faq-icon">
                                    <i class="bx bx-help-circle text-primary"></i>
                                </div>
                                <h5 class="text-primary">08.</h5>
                                <h5 class="faq-title mt-3">How many variations exist?</h5>
                                <p class="faq-ans text-muted mt-2 mb-0">The point of using Lorem Ipsum is that it has a more-or-less normal they distribution of letters content here.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card bg-light overflow-hidden">
                            <div class="card-body">
                                <div class="faq-icon">
                                    <i class="bx bx-help-circle text-primary"></i>
                                </div>
                                <h5 class="text-primary">09.</h5>
                                <h5 class="faq-title mt-3">Is safe use Lorem Ipsum?</h5>
                                <p class="faq-ans text-muted mt-2 mb-0">The point of using Lorem Ipsum is that it has a more-or-less normal they distribution of letters content here.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

<!-- Countdown -->
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
