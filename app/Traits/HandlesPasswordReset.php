<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

trait HandlesPasswordReset
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => "required|email|exists:{$this->table},email",
        ], $this->getAuthValidationMessages());

        $response = Password::broker($this->broker)->sendResetLink(
            $request->only('email')
        );

        return $response === Password::RESET_LINK_SENT
            ? back()->with('success', 'Enlace de restablecimiento de contraseña enviado!')
            : back()->withErrors(['email' => 'No se pudo enviar el enlace de restablecimiento.']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'email' => "required|email|exists:{$this->table},email",
            'token' => 'required',
        ], $this->getAuthValidationMessages());

        $response = Password::broker($this->broker)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $response === Password::PASSWORD_RESET
            ? redirect()->route($this->loginRoute)->with('success', 'Contraseña restablecida correctamente')
            : back()->withErrors(['email' => 'El enlace de restablecimiento ha expirado o es inválido.']);
    }
}
