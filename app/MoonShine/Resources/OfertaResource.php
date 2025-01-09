<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Oferta;
use MoonShine\Fields\ID;

use MoonShine\Fields\Date;
use MoonShine\Fields\Field;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Decorations\Block;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Oferta>
 */
class OfertaResource extends ModelResource
{
    protected string $model = Oferta::class;

    protected string $title = 'Ofertas';

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
                BelongsTo::make('Producto', 'producto', 'modelo')
                    ->searchable()
                    ->required()
                    ->badge(),
                Number::make('Porcentaje', 'porcentaje')
                    ->min(0)
                    ->max(100)
                    ->step(0.01),
                Image::make('Banner de Oferta', 'banner_oferta')
                    ->removable()
                    ->dir('ofertas'),
                Date::make('Fecha de Inicio', 'fecha_inicio')
                    ->required()
                    ->format('d/m/Y'),
                Date::make('Fecha de Fin', 'fecha_fin')
                    ->required()
                    ->format('d/m/Y'),
            ]),
        ];
    }

    /**
     * @param Oferta $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'producto_id' => ['required', 'exists:productos,id', 'unique:ofertas,producto_id,' . $item->id],
            'banner_oferta' => [
                'nullable',
                'image',
                'max:2048',
            ],
            'porcentaje' => ['required', 'numeric', 'min:0', 'max:100'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date', 'after:fecha_inicio'],
        ];
    }

    public function validationMessages(): array
    {
        return [
            'producto_id.unique' => 'El producto ya tiene una oferta activa.',
            'porcentaje.min' => 'El porcentaje de descuento no puede ser menor a 0.',
            'porcentaje.max' => 'El porcentaje de descuento no puede ser mayor a 100.',
            'fecha_inicio.required' => 'La fecha de inicio es requerida.',
            'fecha_fin.required' => 'La fecha de fin es requerida.',
            'fecha_fin.after' => 'La fecha de fin debe ser mayor a la fecha de inicio.',
        ];
    }
}
