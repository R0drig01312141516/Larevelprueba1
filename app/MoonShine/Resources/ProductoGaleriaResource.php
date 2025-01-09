<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;

use MoonShine\Fields\Field;
use MoonShine\Fields\Image;
use App\Models\ProductoGaleria;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<ProductoGaleria>
 */
class ProductoGaleriaResource extends ModelResource
{
    protected string $model = ProductoGaleria::class;

    protected string $title = 'Galería de Imágenes';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected array $with = ['producto'];

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            ID::make()->hideOnIndex(),
            BelongsTo::make('Producto', 'producto', 'modelo')
                ->nullable()
                ->required()
                ->badge(),
            Image::make('Imágenes de Galería', 'imagen_galeria')
                ->disk('public')
                ->dir('productos/galeria'),
        ];
    }

    public function redirectAfterSave(): string
    {
        $referer = Request::header('referer');
        return $referer ?: '/';
    }
    /**
     * @param ProductoGaleria $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'producto_id' => ['required', 'exists:productos,id'],
            'imagen_galeria' => $item->exists
                ? ['nullable', 'image', 'max:2048']
                : ['required', 'image', 'max:2048'],
        ];
    }

    public function getActiveActions(): array
    {
        return ['create', 'update', 'delete', 'massDelete'];
    }
}
