<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Producto;
use MoonShine\Fields\ID;

use MoonShine\Fields\Text;
use MoonShine\Fields\Field;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Textarea;
use Illuminate\Validation\Rule;
use MoonShine\Decorations\Block;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use App\MoonShine\Resources\MarcaResource;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;
use App\MoonShine\Resources\CategoriaResource;
use MoonShine\Fields\Relationships\BelongsToMany;

/**
 * @extends ModelResource<Producto>
 */
class ProductoResource extends ModelResource
{
    protected string $model = Producto::class;

    protected string $title = 'Productos';

    protected string $column = 'modelo';

    protected bool $columnSelection = true;

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected array $with = ['marca', 'categoria', 'tallas', 'galeria'];
    /**
     * @return list<MoonShineComponent|Field>
     */

    public function fields(): array
    {
        return [
            Block::make('Información del Producto', [
                ID::make()
                    ->hideOnIndex()
                    ->showOnExport(),
                Text::make('Modelo', 'modelo')
                    ->required()
                    ->sortable()
                    ->showOnExport(),
                Switcher::make('Disponible', 'disponible')
                    ->default(true)
                    ->updateOnPreview()
                    ->showOnExport(),
                Textarea::make('Descripción', 'descripcion')
                    ->hideOnIndex()
                    ->showOnExport(),
                Number::make('Precio', 'precio')
                    ->min(0)
                    ->step(1)
                    ->buttons()
                    ->required()
                    ->showOnExport(),
                Image::make('Imagen Principal', 'imagen_principal')
                    ->disk('public')
                    ->dir('productos')
                    ->allowedExtensions(['jpg', 'png', 'jpeg', 'webp']),
                BelongsTo::make('Marca', 'marca', 'marca', resource: new MarcaResource())
                    ->nullable()
                    ->required()
                    ->showOnExport()
                    ->badge(),
                BelongsTo::make('Categoría', 'categoria', 'categoria', resource: new CategoriaResource())
                    ->nullable()
                    ->required()
                    ->showOnExport()
                    ->badge(),
                BelongsToMany::make('Tallas Disponibles', 'tallas', 'talla')
                    ->fields([
                        Number::make('Cantidad', 'cantidad')
                    ])

                    ->showOnExport(),
                HasMany::make('Galería', 'galeria', resource: new ProductoGaleriaResource())
                    ->fields([
                        Image::make('', 'imagen_galeria')
                            ->disk('public')
                            ->dir('productos/galeria')
                            ->removable()
                            ->keepOriginalFileName(),
                    ])
                    ->searchable(false)
                    ->creatable(true),

                    Text::make('Codigo', 'codigo')
                    ->required()
                    ->sortable()
                    ->showOnExport(),
            ]),
        ];
    }


    public function redirectAfterSave(): string
    {
        $referer = Request::header('referer');
        return $referer ?: '/';
    }

    /**
     * @param Producto $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'modelo' => [
                'required',
                'string',
                Rule::unique('productos')->ignoreModel($item),
            ],
            'disponible' => ['required', 'boolean'],
            'imagen_principal' => $item->exists
                ? ['nullable', 'image', 'max:2048', 'mimes:jpg,png,jpeg,webp']
                : ['required', 'image', 'max:2048', 'mimes:jpg,png,jpeg,webp'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'marca_id' => ['required', 'exists:marcas,id'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'precio' => ['required', 'numeric', 'min:0'],
            'codigo' => ['required', 'string', 'max:100'],
        ];
    }
}
