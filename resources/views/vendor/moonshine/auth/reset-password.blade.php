@extends('moonshine::layouts.login')

@section('content')
<div class="authentication">
    <div class="authentication-logo">
        <a href="{{ route('moonshine.login') }}" rel="home">
            <h1 class="text-2xl font-bold text-white">{{ config('moonshine.title') }}</h1>
        </a>
    </div>

    <div class="authentication-content">
        <div class="authentication-header">
            <h1 class="title">
                Restablecer Contraseña
            </h1>

            <p class="description">
                Ingresa tu nueva contraseña para acceder a tu cuenta
            </p>

            @if (session('success'))
                <div class="alert alert-success">
                    <x-moonshine::icon icon="heroicons.bell-alert" class="alert-icon" />
                    <p class="alert-content">{{ session('success') }}</p>
                </div>
            @endif

        </div>

        {!! $form() !!}

        <p class="text-center text-2xs">
            {!! config('moonshine.auth.footer', '') !!}
        </p>

        <div class="authentication-footer">
            @include('moonshine::ui.social-auth', [
    'title' => trans('moonshine::ui.login.or_socials'),
])
        </div>
    </div>
</div>
@endsection
