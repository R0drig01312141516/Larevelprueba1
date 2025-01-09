<?php

namespace App\Traits;

trait AuthValidationMessages
{
    protected function getAuthValidationMessages(): array
    {
        return [
            'email.required' => 'El correo electrónico es requerido.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.exists' => 'El correo electrónico no está registrado.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];
    }
} 
