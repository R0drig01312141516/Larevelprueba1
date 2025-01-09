<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title', 'Autenticación')</title>

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"
        integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
        integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Global --}}
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">

    {{-- Auth --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
</head>

<body>
    <div class="container max-w-4xl" >
        <div class="card">
            <div class="row g-0">
                <div class="col-md-6 ">
                    <div class="welcome-container p-sm-4 p-0">
                        <a href="{{ route('inicio') }}" class="header-logo font-bold text-4xl">
                            <img src="{{ asset('Europa/logoooo.jpeg') }}" alt="Logo" class="logo-img img-fluid" style="width: 100%; height: 250.5px;">
                    </a>
            
                        <h2 class="mb-2 text-center text-2xl font-bold">Bienvenido</h2>
                        @yield('welcome-content')
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body p-4 p-sm-4">
                        <h2 class="card-title mb-4 text-center text-2xl font-bold">@yield('form-title')</h2>
                        @if (session('success'))
                            <x-alert :message="session('success')" />
                        @endif

                        @if (session('error'))
                            <x-alert-error :message="session('error')" />
                        @endif
                        @yield('form-content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="loader-wrapper">
        <span class="loader"></span>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"
        integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/loader.js') }}"></script>
    <script src="{{ asset('js/auth.js') }}"></script>
</body>

</html>
