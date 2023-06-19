<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('doob_template_assets/images/favicon-white.png') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('doob_template_assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('doob_template_assets/css/plugins/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('doob_template_assets/css/plugins/feature.css') }}">
    <link rel="stylesheet" href="{{ asset('doob_template_assets/css/plugins/magnify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('doob_template_assets/css/plugins/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('doob_template_assets/css/plugins/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('doob_template_assets/css/plugins/lightbox.css') }}">

    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>





    @yield('content')






    <!-- ====================== Scripts ====================== -->
    <script src="{{ asset('doob_template_assets/js/vendor/modernizr.min.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/waypoint.min.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/wow.min.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/counterup.min.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/feather.min.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/sal.min.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/masonry.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/imageloaded.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/magnify.min.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/lightbox.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/easypie.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/text-type.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/jquery.style.swicher.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/js.cookie.js') }}"></script>
    <script src="{{ asset('doob_template_assets/js/vendor/jquery-one-page-nav.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('doob_template_assets/js/main.js') }}"></script>

    <!-- App Scripts -->
    {{-- <script src="{{ asset('web/js/app.js') }}" defer></script> --}}


</body>

</html>
