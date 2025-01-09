<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contacto;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Email;
use MoonShine\Fields\Text;

/**
 * @extends ModelResource<Contacto>
 */
class ContactoResource extends ModelResource
{
    protected string $model = Contacto::class;

    protected string $title = 'Contactos';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                Email::make('Email', 'email')
                    ->showOnExport(),
                Text::make('Nombre', 'nombre')
                    ->showOnExport(),
                Text::make('Mensaje', 'mensaje')
                    ->showOnExport(),
            ]),
        ];
    }

    public function getActiveActions(): array
    {
        return ['delete', 'massDelete'];
    }

    /**
     * @param Contacto $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
    public function search(): array
    {
        return ['email', 'nombre'];
    }
}
