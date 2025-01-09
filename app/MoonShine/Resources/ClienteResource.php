<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Cliente;
use MoonShine\Fields\ID;

use MoonShine\Fields\Date;
use MoonShine\Fields\Text;
use MoonShine\Fields\Field;
use MoonShine\Decorations\Tab;
use MoonShine\Fields\Password;
use Illuminate\Validation\Rule;
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Block;
use MoonShine\Fields\PasswordRepeat;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Cliente>
 */
class ClienteResource extends ModelResource
{
    protected string $model = Cliente::class;

    protected string $title = 'Clientes';

    protected bool $columnSelection = true;

    protected string $column = 'nombre';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                Tabs::make([
                    Tab::make('Información', [
                        ID::make()
                            ->sortable()
                            ->showOnExport(),
                        Text::make('Nombre', 'nombre')
                            ->required()
                            ->sortable()
                            ->showOnExport(),
                        Text::make('Apellidos', 'apellidos')
                            ->required()
                            ->sortable()
                            ->showOnExport(),
                        Text::make('Email', 'email')
                            ->required()
                            ->sortable()
                            ->showOnExport(),
                        Date::make('Email registrado en', 'email_registrado_en')
                            ->format('d/m/Y')
                            ->default(now()->toDateTimeString())
                            ->sortable()
                            ->hideOnForm()
                            ->showOnExport(),
                    ]),
                    Tab::make('Contraseña', [
                        Password::make('Password', 'password')
                            ->customAttributes(['autocomplete' => 'new-password'])
                            ->hideOnIndex()
                            ->hideOnDetail()
                            ->eye(),
                        PasswordRepeat::make('Repetir contraseña', 'password_repeat')
                            ->customAttributes(['autocomplete' => 'confirm-password'])
                            ->hideOnIndex()
                            ->hideOnDetail()
                            ->eye(),
                    ]),
                ]),
            ]),
        ];
    }

    /**
     * @param Cliente $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => [
                'sometimes',
                'bail',
                'required',
                'email',
                Rule::unique('clientes')->ignoreModel($item),
            ],
            'password' => $item->exists
                ? 'sometimes|nullable|min:6|required_with:password_repeat|same:password_repeat'
                : 'required|min:6|required_with:password_repeat|same:password_repeat',
        ];
    }

    public function search(): array
    {
        return ['id', 'nombre', 'apellidos', 'email'];
    }
}
