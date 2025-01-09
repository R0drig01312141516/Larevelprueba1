<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Talla;
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
 * @extends ModelResource<Talla>
 */
class TallaResource extends ModelResource
{
    protected string $model = Talla::class;

    protected string $title = 'Tallas';

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
                Text::make('Talla', 'talla')
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
     * @param Talla $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'talla' => [
                'required',
                'string',
                'min:0',
                'max:20',
                'regex:/^[A-Za-z0-9]+$/',
                
                Rule::unique('tallas', 'talla')->ignoreModel($item),
            ],
        ];
    }
}
