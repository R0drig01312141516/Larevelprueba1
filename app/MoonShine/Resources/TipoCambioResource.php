<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use App\Models\TipoCambio;

use MoonShine\Fields\Date;
use MoonShine\Fields\Field;
use MoonShine\Fields\Number;
use MoonShine\Decorations\Block;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<TipoCambio>
 */
class TipoCambioResource extends ModelResource
{
    protected string $model = TipoCambio::class;

    protected string $title = 'Tipo de cambio';
    protected string $column = 'tipo_cambio';

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
                Number::make('Tipo de Cambio', 'tipo_cambio')
                    ->min(0)
                    ->step(0.01),
                Date::make('Creado', 'created_at')
                    ->default(now()->toDateTimeString())
                    ->sortable()
                    ->hideOnForm()
                    ->showOnExport(),
                Date::make('Actualizado', 'updated_at')
                    ->sortable()
                    ->hideOnForm()
                    ->showOnExport(),
            ]),
        ];
    }

    public function redirectAfterSave(): string
    {
        $referer = Request::header('referer');
        return $referer ?: '/';
    }

    public function getActiveActions(): array
    {
        return ['create', 'update', 'delete', 'massDelete'];
    }



    /**
     * @param TipoCambio $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'tipo_cambio' => 'required|numeric|min:0',
        ];
    }
}
