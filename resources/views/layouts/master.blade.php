<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> @yield('title')| GesCongApp</title>
    <meta content="GesCongApp Admin & Dashboard App" name="description" />
    <meta content="AN Design" name="author" />
        
    <!-- Favicons -->
    <link href="{{ URL::asset('assets/images/logo-w.png')}}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    @include('layouts.head')
</head>
<body data-layout="vertical" data-topbar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- Left sidebar -->
        @include('layouts.sidebar')
        
        <!-- Header -->
        @include('layouts.header')

        <!-- ============================================================== -->
        <!-- Start right Content -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <!-- Start content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- End content -->
            </div>
            @include('layouts.footer')
            <a href="javascript:void(0)" class="back-to-top d-flex align-items-center justify-content-center">
                <i class="bi bi-arrow-up-short"></i>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Right content -->
        <!-- ============================================================== -->
    </div>

    <!-- Right sidebar -->
    @include('layouts.right-sidebar')

    @include('layouts.vendor-script')
</body>

</html>
