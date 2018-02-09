<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- <link rel="icon" type="image/x-icon" href="{{asset('img/sweet.ico')}}"> -->
        <title> @yield('page_title')- Happy Perks</title>
        <!-- Styles -->
        @include('inc.styles')
    </head>
    <!--<body style="background:url('/img/sweets-bg2.jpg') no-repeat;background-size: cover;">-->
    <body class="sidebar-mini">
        <div class="wrapper">
            @include('inc.sidebar')

            <div class="main-panel">
                @include('inc.header')
                <div class="content">
                    @include('inc.messages')
                    @yield('content')
                </div>
            </div>
        </div>
        @include('inc.scripts')
        @yield('component_specific_js')
    </body>
</html>
