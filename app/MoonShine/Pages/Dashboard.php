<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Venta;
use MoonShine\Fields\ID;
use MoonShine\Pages\Page;
use MoonShine\Fields\Text;
use MoonShine\Decorations\Grid;
use MoonShine\Metrics\ValueMetric;
use MoonShine\Components\TableBuilder;
use MoonShine\Components\MoonShineComponent;

class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Dashboard';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {
        return [
            Grid::make([
                ValueMetric::make('Ventas del Mes')
                    ->value(Venta::whereMonth('fecha', now()->month)->where('estado', 'Entregado')->count())
                    ->columnSpan(6)
                    ->icon('heroicons.calendar-days'),
                ValueMetric::make('Pedidos por recoger')
                    ->value(Venta::where('estado', 'Por Recoger')->count())
                    ->columnSpan(6)
                    ->icon('heroicons.information-circle'),
                ValueMetric::make('Ventas Totales')
                    ->value(Venta::where('estado', 'Entregado')->count())
                    ->columnSpan(6)
                    ->icon('heroicons.shopping-bag'),
            ]),

        ];
    }
}
