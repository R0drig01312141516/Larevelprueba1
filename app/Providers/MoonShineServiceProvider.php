<?php

declare(strict_types=1);

namespace App\Providers;

use Closure;
use MoonShine\MoonShine;
use MoonShine\Pages\Page;
use MoonShine\Menu\MenuItem;
use MoonShine\Menu\MenuGroup;
use App\Models\ProductoGaleria;
use MoonShine\Menu\MenuElement;
use App\MoonShine\Resources\MarcaResource;
use App\MoonShine\Resources\TallaResource;
use App\MoonShine\Resources\VentaResource;
use App\MoonShine\Resources\OfertaResource;
use App\MoonShine\Resources\ClienteResource;
use App\MoonShine\Resources\ContactoResource;
use App\MoonShine\Resources\DistritoResource;
use App\MoonShine\Resources\ProductoResource;
use App\MoonShine\Resources\CategoriaResource;
use App\MoonShine\Resources\ProvinciaResource;
use MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\InfoTiendaResource;
use App\MoonShine\Resources\TipoCambioResource;
use App\MoonShine\Resources\DepartamentoResource;
use App\MoonShine\Resources\DetalleVentaResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use App\MoonShine\Resources\ProductoGaleriaResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.admins_title'),
                    new MoonShineUserResource()
                ),
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.role_title'),
                    new MoonShineUserRoleResource()
                ),
            ]),

            MenuGroup::make('Productos', [
                MenuItem::make('Categorias', new CategoriaResource()),
                MenuItem::make('Marcas', new MarcaResource()),
                MenuItem::make('Tallas', new TallaResource()),
                MenuItem::make('Productos', new ProductoResource()),
                MenuItem::make('Galería', new ProductoGaleriaResource()),
                MenuItem::make('Ofertas', new OfertaResource()),
            ]),

            MenuGroup::make('Clientes', [
                MenuItem::make('Clientes', new ClienteResource()),
                MenuItem::make('Mensajes', new ContactoResource()),
            ]),

            MenuGroup::make('Ventas', [
                MenuItem::make('Ventas', new VentaResource()),
                MenuItem::make('Detalle de venta', new DetalleVentaResource()),
            ]),

            MenuItem::make('Tipo de cambio', new TipoCambioResource()),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }

    public function boot(): void
    {
        parent::boot();

        moonshineColors()
            ->primary('#2b90ed');
    }
}
