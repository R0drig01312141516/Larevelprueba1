<?php

declare(strict_types=1);

namespace App\MoonShine\Forms;

use MoonShine\Fields\Text;
use MoonShine\Components\Link;
use MoonShine\Fields\Password;
use MoonShine\Fields\Switcher;
use MoonShine\Components\FormBuilder;

final class LoginForm
{
    public function __invoke(): FormBuilder
    {
        return FormBuilder::make()
            ->customAttributes([
                'class' => 'authentication-form',
            ])
            ->action(moonshineRouter()->to('authenticate'))
            ->fields([
                Text::make(__('moonshine::ui.login.username'), 'username')
                    ->required()
                    ->customAttributes([
                        'autofocus' => true,
                        'autocomplete' => 'username',
                    ]),

                Password::make(__('moonshine::ui.login.password'), 'password')
                    ->required()
                    ->eye(),

                Switcher::make(__('moonshine::ui.login.remember_me'), 'remember'),

                Link::make(route('admin.password.request'), 'Olvidaste tu contraseña?',),
            ])->submit(__('moonshine::ui.login.login'), [
                'class' => 'btn-primary btn-lg w-full',
            ]);
    }
}
