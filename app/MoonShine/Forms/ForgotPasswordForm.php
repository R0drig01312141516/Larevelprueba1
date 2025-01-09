<?php

declare(strict_types=1);

namespace App\MoonShine\Forms;

use MoonShine\Fields\Text;
use MoonShine\Components\Link;
use MoonShine\Components\FormBuilder;

final class ForgotPasswordForm
{
    public function __invoke(): FormBuilder
    {
        return FormBuilder::make()
            ->customAttributes([
                'class' => 'authentication-form',
            ])
            ->action(route('admin.password.email'))
            ->fields([
                Text::make(__('Email'), 'email')
                    ->required()
                    ->customAttributes([
                        'autofocus' => true,
                        'autocomplete' => 'email',
                    ])
            ])->submit(__('Enviar enlace de restablecimiento'), [
                'class' => 'btn-primary btn-lg w-full',
            ]);
    }
}
