<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title')</title>
    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Our Base Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Oswald:wght@200..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/bootstrap.js'])
    <script src='{{ asset('js/jquery.js') }}'></script>
    <script src="{{ asset('js/inquiry.js') }}"></script>

    <!-- FullCalendar CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.0/main.min.css" rel="stylesheet">

    <!-- FullCalendar JavaScript -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script src="{{ asset('js/calendar.js') }}"></script>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- @if ($theme_color == null)
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/default.css') }}"> --}}
    @auth
        @if (Auth::user()->theme_color == 1)
            <link rel="stylesheet" href="{{ asset('css/style.css') }}">
            <link rel="stylesheet" href="{{ asset('css/default.css') }}">
        @elseif (Auth::user()->theme_color == 2)
            <link rel="stylesheet" href="{{ asset('css/style-green.css') }}">
            <link rel="stylesheet" href="{{ asset('css/green.css') }}">
        @elseif (Auth::user()->theme_color == 3)
            <link rel="stylesheet" href="{{ asset('css/style-blue.css') }}">
            <link rel="stylesheet" href="{{ asset('css/blue.css') }}">
        @elseif (Auth::user()->theme_color == 4)
            <link rel="stylesheet" href="{{ asset('css/style-pink.css') }}">
            <link rel="stylesheet" href="{{ asset('css/pink.css') }}">
        @elseif (Auth::user()->theme_color == 5)
            <link rel="stylesheet" href="{{ asset('css/style-yellow.css') }}">
            <link rel="stylesheet" href="{{ asset('css/yellow.css') }}">
        @elseif (Auth::user()->theme_color == 6)
            <link rel="stylesheet" href="{{ asset('css/style-dark.css') }}">
            <link rel="stylesheet" href="{{ asset('css/dark.css') }}">
        @endif
    @endauth


    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>

</html>
