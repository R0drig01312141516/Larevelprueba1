<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Venta;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;

use MoonShine\Fields\Field;
use MoonShine\Fields\Number;
use MoonShine\MoonShineRequest;
use MoonShine\Decorations\Block;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;
use App\MoonShine\Resources\DetalleVentaResource;
use MoonShine\Http\Responses\MoonShineJsonResponse;

/**
 * @extends ModelResource<Venta>
 */
class VentaResource extends ModelResource
{
    protected string $model = Venta::class;

    protected string $title = 'Ventas';

    protected bool $columnSelection = true;

    protected bool $createInModal = true;




    public function redirectAfterSave(): string
    {
        $referer = Request::header('referer');
        return $referer ?: '/';
    }

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
                BelongsTo::make('Cliente', 'cliente', 'nombre', resource: new ClienteResource())
                    ->badge()
                    ->searchable()
                    ->showOnExport(),
                Number::make('Total Soles', 'total')
                    ->showOnExport(),
                Text::make('Fecha', 'fecha')
                    ->showOnExport(),
                Text::make('Método de Pago', 'metodo_pago')
                    ->showOnExport(),
                Number::make('Tipo de Cambio', 'tipo_cambio')
                    ->showOnExport(),
                Number::make('Total USD', 'total_dolares')
                    ->showOnExport(),
                Text::make('Estado', 'estado')
                    ->showOnExport(),
                Text::make('Transacción ID', 'transaccion_id')
                    ->showOnExport(),
                Text::make('Correo de Pago', 'payer_email')
                    ->showOnExport(),

                HasMany::make('Detalles', 'detalles', resource: new DetalleVentaResource())
                    ->searchable(false)
                    ->hideOnIndex(),
            ]),
        ];
    }

    /**
     * @param Venta $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }

    public function getActiveActions(): array
    {
        return ['view'];
    }

    public function search(): array
    {
        return ['id', 'cliente.nombre', 'fecha', 'estado', 'metodo_pago', 'transaccion_id', 'payer_email'];
    }

    public function indexButtons(): array
    {
        return [
            ActionButton::make('Anular')
                ->method(
                    'anularVenta',
                    params: fn($item) => ['venta_id' => $item->getKey()]
                )
                ->canSee(fn($item) => $item->estado !== 'Anulado')
                ->error(),
            ActionButton::make('Completar')
                ->method('completarVenta', params: fn($item) => ['venta_id' => $item->getKey()])
                ->canSee(fn($item) => $item->estado !== 'Entregado' && $item->estado !== 'Anulado')
                ->success(),
        ];
    }

    public function completarVenta(MoonShineRequest $request): MoonShineJsonResponse
    {
        $ventaId = $request->get('venta_id');

        try {
            $venta = Venta::findOrFail($ventaId);

            if ($venta->estado === 'Entregado') {
                return MoonShineJsonResponse::make()
                ->toast('La venta ya está completada', 'error');
            }

            $venta->estado = 'Entregado';
            $venta->save();

            return MoonShineJsonResponse::make()
                ->toast('Venta completada correctamente')
                ->redirect($this->indexPageUrl());
        } catch (\Exception $e) {
            return MoonShineJsonResponse::make()
                ->toast('Error al completar la venta: ' . $e->getMessage(), 'error');
        }
    }

    public function anularVenta(MoonShineRequest $request): MoonShineJsonResponse
    {
        $ventaId = $request->get('venta_id');

        try {
            $venta = Venta::findOrFail($ventaId);

            if ($venta->estado === 'Anulado') {
                return MoonShineJsonResponse::make()
                    ->toast('La venta ya está anulada', 'error');
            }

            $venta->estado = 'Anulado';
            $venta->save();

            return MoonShineJsonResponse::make()
                ->toast('Venta anulada correctamente')
                ->redirect($this->indexPageUrl());
        } catch (\Exception $e) {
            return MoonShineJsonResponse::make()
                ->toast('Error al anular la venta: ' . $e->getMessage(), 'error');
        }
    }
}
