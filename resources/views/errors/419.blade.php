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
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->


        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/all.css') }}">


        <!-- Responsive css -->
        <link rel="stylesheet" href="{{ asset('vendor_asset/css/responsive.css') }}">
        <script src="https://kit.fontawesome.com/186f069b67.js" crossorigin="anonymous"></script>

    </head>
    <body>
        <style>
            body{
                background-color:#aacfe4;
            }
            .caja{
                height: 80vh;
            }
        </style>

        <div class="container bg-light shadow-lg m-md-5 rounded-lg">
            <div class="row caja justify-content-center aligns-items-center min-h-3/4 my-14 md:my-0">
                <div class="col-12 col-md-8 my-auto text-center">
                    <img class="mx-auto w-48 md:w-96" src="/vendor_asset/img/logo/hilogo.png" alt="logo">
                    <h1 class="text-5xl font-weight-bolder mt-2">ERROR 419</h1>
                    <p class="text-xl my-2">The page expired</p>
                    <a href="{{route('home')}}" class="btn btn-azulc rounded-pill text-white my-4">back to Home</a>

                </div>
            </div>
        </div>


        <script src="{{ mix('js/app.js') }}" defer></script>        
    </body>
</html>