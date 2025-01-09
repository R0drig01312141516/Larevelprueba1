<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use App\Models\Categoria;
use MoonShine\Fields\Text;
use MoonShine\Fields\Field;
use Illuminate\Validation\Rule;
use MoonShine\Decorations\Block;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Categoria>
 */
class CategoriaResource extends ModelResource
{
    protected string $model = Categoria::class;

    protected string $title = 'Categorias';

    protected string $column = 'categoria';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()
                    ->sortable(),
                Text::make('Categoria', 'categoria')
                    ->required()
                    ->sortable(),
            ]),
        ];
    }

    public function redirectAfterSave(): string
    {
        $referer = Request::header('referer');
        return $referer ?: '/';
    }

    /**
     * @param Categoria $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'categoria' => [
                'required',
                'string',
                'max:25',
                Rule::unique('categorias', 'categoria')->ignoreModel($item),
            ],
        ];
    }
}
