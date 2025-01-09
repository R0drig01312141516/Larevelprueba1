@extends('layouts.auth')

@section('title', 'Iniciar sesión')

@section('welcome-content')
    <p class="mb-4">¿No tienes una cuenta?</p>
    <a href="{{ route('cliente.register') }}" class="btn btn-outline-light">Regístrate</a>
@endsection

@section('form-title', 'Iniciar sesión')

@section('form-content')
    <form method="POST" action="{{ route('cliente.login.submit') }}" id="loginForm" class="needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" required>
            <div class="invalid-feedback">
                @error('email')
                    {{ $message }}
                @else
                    Ingresar correo válido
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <div class="input-group has-validation">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" minlength="8" required>
                <button class="btn btn-outline-primary" type="button" id="togglePassword">
                    <i class="bi bi-eye" id="toggleIcon"></i>
                </button>
                <div class="invalid-feedback">
                    @error('password')
                        {{ $message }}
                    @else
                        Ingresar contraseña
                    @enderror
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
    </form>
    <div class="mt-3 text-end">
        <a href="{{ route('cliente.password.request') }}" class="text-decoration-none forgot-password">¿Olvidó su
            contraseña?</a>
    </div>
@endsection
