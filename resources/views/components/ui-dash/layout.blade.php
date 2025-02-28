@props(['PAGE_TITLE' => '', 'IS_AUTH' => false])
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/ico/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/ico/favicon-32x32.png') }}">
    <title>
        {{ env('APP_NAME') . ($PAGE_TITLE ? " - {$PAGE_TITLE}" : '') }}
    </title>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('app/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('app/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Material Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('app/assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
</head>

<body class="{{ !$IS_AUTH ? 'g-sidenav-show' : '' }} {{ !Request::routeIs(['register', 'password.reset', 'password.request','verification.notice']) ? 'bg-gray-100' : '' }}">

    @if ($IS_AUTH === false)
        <x-ui-dash.aside />
    @endif
    <main
        class="main-content @if ($IS_AUTH === false) position-relative max-height-vh-100 h-100 border-radius-lg @else mt-0 @endif ">
        @if ($IS_AUTH === false)
            <x-ui-dash.nav />
        @endif
        {{ $slot }}
        @if ($IS_AUTH === false)
            <x-ui-dash.footer />
        @endif

    </main>
    @if ($IS_AUTH === false)
        <x-ui-dash.fixed-plugin />
    @endif
    <!--   Core JS Files   -->
    <script src="{{ asset('app/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('app/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('app/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    {{ $slot_script ?? '' }}
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('app/assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
</body>

</html>
