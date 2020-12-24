<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@hasSection('title')@yield('title') - @endif{{ config('app.name', 'Laravel') }}</title>
    @stack('head.scripts')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="layout-fixed layout-navbar-fixed">
    <div class="wrapper" @hasSection('x-data') x-data="@yield('x-data')" @endif>
        @yield('content')
        <script src="{{ mix('/js/manifest.js') }}"></script>
        <script src="{{ mix('/js/vendor.js') }}"></script>
        <script src="{{ mix('/js/app.js') }}"></script>
        @stack('body.scripts')
    </div>  

    <div class="py-2 text-center">
        <p>Hubungi via WA: <a href="https://wa.me/6287879720004" rel="nofollow" target="_blank">087879720004</a></p>
    </div>
</body>
</html>
