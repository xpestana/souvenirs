<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#aad8eb">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HiCitty</title>
    <link rel="icon" type="image/x-icon" href="{{asset('vendor_asset/img/logo/hifavicon.png')}}"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Style preloader -->
    <style type="text/css">
        .preloader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #a0cae1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .preloader__logo{
            width: 15%;
            position: fixed;
            top: 4rem;
            margin: auto;
        }
        .preloader__loader{
            position: fixed;
            text-align: center;
        }
        .spinner{
          width: 118.6px;
          height: 118.6px;
          border-radius: 50%;
          box-shadow: 1px 5px 2px #fff;
          animation: spinner 2s linear infinite;
        }
        @keyframes spinner {
            0%{
                transform: rotate(0deg);
            }
            50%{
                transform: rotate(180deg);
            }
            100%{
                transform: rotate(360deg);
                
            }
        }

        .preloader__loader > h1{
            font-size: 1.5rem;
            color: #fff;
            margin-top: 2rem;
            font-family: 'Monserrat', sans;
            text-align: center;
        }
        @media (max-width: 767px){
            .preloader__logo{
                width: 48%;
            }
        }
    </style>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/all.css') }}">
        <!--<link rel="stylesheet" href="{{ asset('vendor_asset/css/preloader.css') }}">-->

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
        <!-- Preloader -->
        <div id="preloaders" class="preloader">
            <img class="preloader__logo" src="{{ asset('/vendor_asset/img/collaborator/logocompleto.svg') }}" alt="logo">
            <div class="preloader__loader">
                <div class="spinner"></div>
                <h1>Cargando...</h1>
            </div>
        </div>

        @inertia
        <script src="{{ mix('js/app.js') }}" defer></script>
        
        <!-- Modernizer js -->
    	<script src="{{ asset('vendor_asset/js/vendor/modernizr-3.5.0.min.js') }}" defer></script>
        <!-- Countdown js -->
        <script src="{{ asset('vendor_asset/js/jquery.countdown.min.js') }}" defer></script>
        <!-- Mobile menu js
        <script src="vendor_asset/js/jquery.meanmenu.min.js" defer></script>-->
        <!-- ScrollUp js -->
        {{-- <script src="{{ asset('vendor_asset/js/jquery.scrollUp.js') }}" defer></script> --}}
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
        <!-- CDN jquery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <!-- Js preloader -->
        <script type="text/javascript">
            $(window).on('load',function() 
            {          
                $("#preloaders").fadeOut(100);
            });
        </script>
        
    </body>
</html>
