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
    <!--Plugin-->
</head>

<body
    class="{{ !$IS_AUTH ? 'g-sidenav-show' : '' }} {{ !Request::routeIs(['register', 'password.reset', 'password.request', 'verification.notice']) ? 'bg-gray-100' : '' }}">

    @if ($IS_AUTH === false)
        <x-ui-dash.aside />
    @endif
    <main
        class="main-content @if ($IS_AUTH === false) position-relative max-height-vh-100 h-100 border-radius-lg @else mt-0 ps @endif ">

        @if ($IS_AUTH === false)
            <x-ui-dash.nav />
        @endif
        @if ($IS_AUTH === false)
            <div class="container-fluid py-2">
        @endif
        {{ $slot }}
        @if ($IS_AUTH === false)
            <x-ui-dash.footer />
        @endif
        @if ($IS_AUTH === false)
            </div>
        @endif
        <!-- Alert Messages -->
        <div class="position-fixed bottom-1 end-1 z-index-2">
            @if (session('success') || session('status'))
                <x-ui-dash.ui.alert :IS_ERROR="false" :HEAD="'Success'" :TITLE="session('success').session('status')" />
            @endif
            @if ($errors->any())
                <x-ui-dash.ui.alert :IS_ERROR="true" :HEAD="'Error'">
                    <x-slot name="TITLE">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </x-slot>
                </x-ui-dash.ui.alert>
            @endif
        </div>

    </main>
    @if ($IS_AUTH === false)
        <x-ui-dash.fixed-plugin />
    @endif
    <!--   Core JS Files   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('app/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('app/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('app/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('app/assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('app/assets/js/tinymce.js') }}"></script>
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

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('app/assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
</body>

</html>
