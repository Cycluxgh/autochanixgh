<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>{{ $title ?? 'Autochanix' }} | {{ config('app.name') ?? 'Autochanix' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact Management System."/>
    <meta name="author" content="Shikaconnect"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

</head>

<body data-menu-color="dark" data-sidebar="default">

<!-- Begin page -->
<div id="app-layout">

    <!-- Topbar Start -->
    <livewire:layout.top-bar/>
    <!-- end Topbar -->

    <!-- Left Sidebar Start -->
    <livewire:layout.sidebar/>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-xxl">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">{{ $page_title }}</h4>
                    </div>
                </div>

                {{ $slot }}

            </div> <!-- container-fluid -->
        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col fs-13 text-muted text-center">
                        &copy; <script>document.write(new Date().getFullYear())</script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="https://shikaconnect.com/" class="text-reset fw-semibold">ShikaConnect</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->

<!-- Vendor -->
<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>

<!-- Apexcharts JS -->
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- for basic area chart -->
<script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>

<!-- Widgets Init Js -->
<script src="{{asset('assets/js/pages/analytics-dashboard.init.js')}}"></script>

<!-- App js-->
<script src="{{asset('assets/js/app.js')}}"></script>

<script>
    function onOldPasswordVisible() {
        const oldPassword = document.getElementById('oldPassword');
        const lockIcon = document.getElementById('old-lock-icon');

        if (oldPassword.getAttribute('type') === 'password') {
            oldPassword.setAttribute('type', 'text');
            lockIcon.classList.remove("mdi-lock-outline");
            lockIcon.classList.add("mdi-lock-open-outline");
        } else {
            oldPassword.setAttribute('type', 'password');
            lockIcon.classList.remove("mdi-lock-open-outline");
            lockIcon.classList.add("mdi-lock-outline");
        }
    }

    function onNewPasswordVisible() {
        const newPassword = document.getElementById('newPassword');
        const lockIcon = document.getElementById('new-lock-icon');

        if (newPassword.getAttribute('type') === 'password') {
            newPassword.setAttribute('type', 'text');
            lockIcon.classList.remove("mdi-lock-outline");
            lockIcon.classList.add("mdi-lock-open-outline");
        } else {
            newPassword.setAttribute('type', 'password');
            lockIcon.classList.remove("mdi-lock-open-outline");
            lockIcon.classList.add("mdi-lock-outline");
        }
    }

    function onConfirmPasswordVisible() {
        const confirmPassword = document.getElementById('confirmPassword');
        const lockIcon = document.getElementById('confirm-lock-icon');

        if (confirmPassword.getAttribute('type') === 'password') {
            confirmPassword.setAttribute('type', 'text');
            lockIcon.classList.remove("mdi-lock-outline");
            lockIcon.classList.add("mdi-lock-open-outline");
        } else {
            confirmPassword.setAttribute('type', 'password');
            lockIcon.classList.remove("mdi-lock-open-outline");
            lockIcon.classList.add("mdi-lock-outline");
        }
    }
</script>

</body>
</html>
