@extends('layouts.auth')

@section('title', 'Restablecer Contraseña')

@section('form-title', 'Restablecer Contraseña')

@section('form-content')
    <form method="POST" action="{{ route('cliente.password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') ?? $email }}" required readonly>
            <div class="invalid-feedback">
                @error('email')
                    {{ $message }}
                @else
                    Ingresar correo electrónico
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nueva Contraseña</label>
            <div class="input-group has-validation">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" minlength="8" required autofocus>
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
            <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
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

        <button type="submit" class="btn btn-primary w-100">Restablecer Contraseña</button>
    </form>
@endsection
