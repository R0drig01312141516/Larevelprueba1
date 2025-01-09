<!DOCTYPE html>
<html   class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title', 'Europa - Store')</title>

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-grid.min.css" />

      {{-- slick --}}
      <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    {{-- Vite --}}
    @vite('resources/css/app.css', 'resources/js/app.js')

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Global --}}
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">

    {{-- App --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    @stack('styles')

    {{-- footer --}}
    <link rel="stylesheet" href="{{ asset('css/Footer1.css') }}">


</head>

<body>

    @include('partials.header')

    @include('partials.sidebar')

    <main class="site-main">
        @yield('content')
    </main>

    @include('partials.footer')

    <div class="loader-wrapper">
        <span class="loader"></span>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/loader.js') }}"></script>
    <script src="{{ asset('js/app1.js') }}"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    {{-- agregado --}}
    <script src="{{ asset('js/mensaje.js') }}"></script>

    {{--  agregado--}}
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

{{-- slick --}}
   
    @stack('scripts')
</body>

</html>
