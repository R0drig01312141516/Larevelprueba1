<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\Text;

use MoonShine\Fields\Field;
use App\Models\DetalleVenta;
use MoonShine\Fields\Number;
use MoonShine\Decorations\Block;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use App\MoonShine\Resources\VentaResource;
use MoonShine\Components\MoonShineComponent;
use App\MoonShine\Resources\ProductoResource;
use MoonShine\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<DetalleVenta>
 */
class DetalleVentaResource extends ModelResource
{
    protected string $model = DetalleVenta::class;

    protected string $title = 'DetalleVenta';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()
                    ->sortable()
                    ->showOnExport(),
                BelongsTo::make('Venta', 'venta', 'id', resource: new VentaResource())
                    ->badge()
                    ->showOnExport(),
                BelongsTo::make('Producto', 'producto', 'nombre', resource: new ProductoResource())
                    ->badge()
                    ->showOnExport(),
                Text::make('Talla', 'talla')
                    ->showOnExport(),
                Number::make('Cantidad', 'cantidad')
                    ->showOnExport(),
                Number::make('Precio Unitario', 'precio_unitario')
                    ->step(0.01)
                    ->showOnExport(),
            ]),
        ];
    }

    public function getActiveActions(): array
    {
        return [
            'view'
        ];
    }

    /**
     * @param DetalleVenta $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
