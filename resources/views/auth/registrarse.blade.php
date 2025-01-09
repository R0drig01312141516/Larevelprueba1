@extends('layouts.auth')

@section('title', 'Registrarse')

@section('welcome-content')
    <p class="mb-4">¿Ya tienes una cuenta?</p>
    <a href="{{ route('cliente.login') }}" class="btn btn-outline-light">Iniciar sesión</a>
@endsection

@section('form-title', 'Registrarse')

@section('form-content')
    <form method="POST" action="{{ route('cliente.register.submit') }}" id="registerForm" class="needs-validation" novalidate>
        @csrf
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-sm-0">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                <div class="invalid-feedback">
                    Ingrese su nombre.
                </div>
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
                <div class="invalid-feedback">
                    Ingrese sus apellidos.
                </div>
                @error('apellidos')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                <div class="invalid-feedback">
                    Ingrese un correo válido.
                </div>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
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

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <div class="input-group has-validation">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    id="password_confirmation" name="password_confirmation" minlength="8" required>
                <button class="btn btn-outline-primary" type="button" id="togglePasswordConfirmation">
                    <i class="bi bi-eye" id="toggleIconConfirmation"></i>
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

        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
    </form>
@endsection
