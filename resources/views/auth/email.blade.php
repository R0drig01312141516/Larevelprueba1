@extends('layouts.auth')

@section('title', 'Recuperar contraseña')

@section('form-title', 'Recuperar contraseña')

@section('form-content')
    <form method="POST" action="{{ route('cliente.password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
            <div class="invalid-feedback">
                @error('email')
                    {{ $message }}
                @else
                    Ingrese su correo para enviar el enlace de recuperación.
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Enviar enlace de recuperación</button>
        <a href="{{ route('cliente.login') }}" class="btn btn-outline-dark w-100 mt-2 ">Volver a inicio de sesión</a>
    </form>
@endsection
