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

    <!-- Datatables css -->
    <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Choices -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
    />

    <!-- Flatpickr Timepicker css -->
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />

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

<!-- Flatpickr Timepicker Plugin js -->
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>

<!-- for basic area chart -->
<script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>

<!-- Datatables js -->
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>

<!-- dataTables.bootstrap5 -->
<script src="{{asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>

<!-- buttons.colVis -->
<script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>

<!-- buttons.bootstrap5 -->
<script src="{{asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>

<!-- Widgets Init Js -->
<script src="{{asset('assets/js/pages/analytics-dashboard.init.js')}}"></script>

<!-- dataTables.keyTable -->
<script src="{{asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js')}}"></script>

<!-- dataTable.responsive -->
<script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>

<!-- dataTables.select -->
<script src="{{asset('assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-select-bs5/js/select.bootstrap5.min.js')}}"></script>

<!-- Datatable Demo App Js -->
<script src="{{asset('assets/js/pages/datatable.init.js')}}"></script>

<!-- App js-->
<script src="{{asset('assets/js/app.js')}}"></script>

<!-- Choices -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

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

    const customerSelect = document.querySelector('.customers-select');
    const choices = new Choices(customerSelect, {
        placeholder: ['Select a customer'],
    });
</script>

{{--<script>--}}
{{--    const vehicleNumbers = document.querySelector('.vehicle-numbers');--}}
{{--    const vehicleChoices = new Choices(vehicleNumbers, {--}}
{{--        placeholder: ['Select customer vehicle number'],--}}
{{--    });--}}
{{--</script>--}}

<script>
    const messageCustomers = document.querySelector('.message-customers');
    const customersChoices = new Choices(messageCustomers, {
        placeholder: ['Select existing customer'],
    });
</script>

<script>
    flatpickr("#manufacture-year", {
        enableTime: false,
        dateFormat: "Y",
    });
</script>

</body>
</html>


{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--    <head>--}}
{{--        <meta charset="utf-8">--}}
{{--        <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--        <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--        <title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--        <!-- Fonts -->--}}
{{--        <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}

{{--        <!-- Scripts -->--}}
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--    </head>--}}
{{--    <body class="font-sans antialiased">--}}
{{--        <div class="min-h-screen bg-gray-100">--}}
{{--            <livewire:layout.navigation />--}}

{{--            <!-- Page Heading -->--}}
{{--            @if (isset($header))--}}
{{--                <header class="bg-white shadow">--}}
{{--                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                        {{ $header }}--}}
{{--                    </div>--}}
{{--                </header>--}}
{{--            @endif--}}

{{--            <!-- Page Content -->--}}
{{--            <main>--}}
{{--                {{ $slot }}--}}
{{--            </main>--}}
{{--        </div>--}}
{{--    </body>--}}
{{--</html>--}}
