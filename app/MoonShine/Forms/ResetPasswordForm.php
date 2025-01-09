<?php

declare(strict_types=1);

namespace App\MoonShine\Forms;

use MoonShine\Fields\Email;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\Password;
use MoonShine\Components\FormBuilder;

final class ResetPasswordForm
{
    public function __invoke(): FormBuilder
    {
        return FormBuilder::make()
            ->customAttributes([
                'class' => 'authentication-form',
            ])
            ->action(route('admin.password.update'))
            ->fields([
                Hidden::make('Token', 'token')
                    ->default(request()->token),

                Email::make(__('Correo electrónico'), 'email')
                    ->default(request()->email)
                    ->readonly()
                    ->required()
                    ->customAttributes([
                        'autofocus' => true,
                        'autocomplete' => 'email',
                    ]),

                Password::make(__('Contraseña'), 'password')
                    ->required()
                    ->eye(),

                Password::make(__('Confirmar contraseña'), 'password_confirmation')
                    ->required()
                    ->eye(),
            ])->submit(__('Restablecer contraseña'), [
                'class' => 'btn-primary btn-lg w-full',
            ]);
    }
}
