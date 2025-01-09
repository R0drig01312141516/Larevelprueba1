<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Marca;
use MoonShine\Fields\ID;

use MoonShine\Fields\Text;
use MoonShine\Fields\Field;
use Illuminate\Validation\Rule;
use MoonShine\Decorations\Block;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Marca>
 */
class MarcaResource extends ModelResource
{
    protected string $model = Marca::class;

    protected string $title = 'Marcas';

    protected string $column = 'marca';

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
                ID::make()->sortable(),
                Text::make('Marca', 'marca')
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
     * @param Marca $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'marca' => [
                'required',
                'string',
                'max:25',
                Rule::unique('marcas', 'marca')->ignoreModel($item),
            ],
        ];
    }
}
