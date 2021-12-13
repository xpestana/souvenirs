<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/all.css') }}">

        <link rel="shortcut icon" href="/vendor_asset/img/logo/logo.png">
        <!-- Fontawesome css -->
        <link rel="stylesheet" href="{{ asset('vendor_asset/css/font-awesome.min.css') }}">
        <!-- fontello css -->
        <link rel="stylesheet" href="{{ asset('vendor_asset/css/fontello.css') }}">
        <!-- Animate css -->
        <link rel="stylesheet" href="{{ asset('vendor_asset/css/animate.css') }}">
        <!-- Nice select css -->
        <link rel="stylesheet" href="{{ asset('vendor_asset/css/nice-select.css') }}">
        <!-- Jquery fancybox css -->
        <link rel="stylesheet" href="{{ asset('vendor_asset/css/jquery.fancybox.css') }}">
        <!-- Jquery ui price slider css -->
        <link rel="stylesheet" href="{{ asset('vendor_asset/css/jquery-ui.min.css') }}">
        <!-- Meanmenu css -->
        <link rel="stylesheet" href="{{ asset('vendor_asset/css/meanmenu.min.css') }}">
        <!-- Custom css -->
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>

        <!--<link rel="stylesheet" href="/vendor_asset/css/default.css">-->
        <!-- Main css -->
        <!--<link rel="stylesheet" href="/vendor_asset/css/style.css">-->
        <!-- Responsive css -->
        <link rel="stylesheet" href="{{ asset('vendor_asset/css/responsive.css') }}">
        <script src="https://kit.fontawesome.com/186f069b67.js" crossorigin="anonymous"></script>

        <!-- Scripts -->
        @routes
        
    </head>
    <body>
        @inertia
        <script src="{{ mix('js/app.js') }}" defer></script>
        <!-- Modernizer js -->
    	<script src="{{ asset('vendor_asset/js/vendor/modernizr-3.5.0.min.js') }}" defer></script>
        <!-- Countdown js -->
        <script src="{{ asset('vendor_asset/js/jquery.countdown.min.js') }}" defer></script>
        <!-- Mobile menu js
        <script src="vendor_asset/js/jquery.meanmenu.min.js" defer></script>-->
        <!-- ScrollUp js -->
        <script src="{{ asset('vendor_asset/js/jquery.scrollUp.js') }}" defer></script>
        <!-- Fancybox js -->
        <script src="{{ asset('vendor_asset/js/jquery.fancybox.min.js') }}" defer></script>
        <!-- Jquery nice select js -->
        <script src="{{ asset('vendor_asset/js/jquery.nice-select.min.js') }}" defer></script>
        <!-- Jquery ui price slider js 
        <script src="vendor_asset/js/jquery-ui.min.js" defer></script>-->
        <!-- Plugin js -->
        <script src="{{ asset('vendor_asset/js/plugins.js') }}" defer></script>
        <!-- Main activaion js -->
        <script src="{{ asset('vendor_asset/js/main.js') }}" defer></script>
        
        
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
      
        
    </body>
</html>
