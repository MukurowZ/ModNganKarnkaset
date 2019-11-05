@extends('core/core')
@section('title','มดงานการเกษตร - หน้าหลัก')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <script>window.Laravel = { csrfToken: '{{ csrf_token() }}'}</script> -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- For Facebook -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script>
    <!-- Mobirise code -->
    <link rel="stylesheet" href="/assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="/assets/tether/tether.min.css">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/assets/animatecss/animate.min.css">
    <link rel="stylesheet" href="/assets/theme/css/style.css">
    <link rel="stylesheet" href="/assets/mobirise/css/mbr-additional.css" type="text/css">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div id="app">
        <home-component></home-component>
    </div>
    <div class="mx-auto my-3">
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col-md-3 my-auto">
                    <div class="fb-page" data-href="https://www.facebook.com/modngankarnkasetthai" data-tabs="timeline" data-width="300" data-height="70" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/modngankarnkasetthai" class="fb-xfbml-parse-ignore">
                            <a href="https://www.facebook.com/modngankarnkasetthai">
                                Mod Ngan Karnkaset Thai
                            </a>
                        </blockquote>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mx-auto">
                        <img src="https://qr-official.line.me/sid/M/156xgami.png">
                        <a href="http://nav.cx/ipTIanR">
                            <img src="https://scdn.line-apps.com/n/line_add_friends/btn/th.png" alt="เพิ่มเพื่อน" height="36" border="0" style="margin-left: 2rem">
                        </a>
                    </div>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>

    <!-- Mobirise code -->
    <script src="/assets/web/assets/jquery/jquery.min.js"></script>
    <script src="/assets/popper/popper.min.js"></script>
    <script src="/assets/tether/tether.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/smoothscroll/smooth-scroll.js"></script>
    <script src="/assets/parallax/jarallax.min.js"></script>
    <script src="/assets/viewportchecker/jquery.viewportchecker.js"></script>
    <!--  -->

    <script src="/assets/theme/js/script.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <!-- <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif
    </div> -->
</body>

</html>
@endsection