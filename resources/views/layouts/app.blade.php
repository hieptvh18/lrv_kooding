<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('page-title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    {{-- fontawesome --}}
    <link rel="stylesheet" href="{{ asset('assets/css/lib/font-awesome.min.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/layout/kooding-app-icon.ico') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <a href="homepage">
                                    <img src="{{ asset('assets/images/layout/logo-main.png') }}" alt="logo">
                                </a>
                            </div>
                            
                            @yield('content')

                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="./public/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/jsadmin/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/jsadmin/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/jsadmin/template.js') }}"></script>
    <script src="{{ asset('assets/js/jsadmin/settings.js') }}"></script>
    <script src="{{ asset('assets/js/jsadmin/todolist.js') }}"></script>
    <!-- endinject -->
</body>

</html>
