@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('cliente.pedidos') }}" class="text-gray-600 hover:text-gray-900 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Volver a mis pedidos
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-4 py-4 sm:px-6 bg-gray-50">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Detalle del Pedido #{{ $venta->id }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Realizado el {{ $venta->fecha->format('d/m/Y H:i') }}
            </p>
        </div>

        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-3">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Estado</dt>
                    <dd class="mt-1">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            {{ ($venta->estado === 'Entregado' ? 'bg-green-100 text-green-800' :
                               ($venta->estado === 'Anulado' ? 'bg-red-100 text-red-800' :
                                'bg-yellow-100 text-yellow-800')) }}">
                            {{ ucwords($venta->estado) }}
                        </span>
                    </dd>
                </div>

                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Método de pago</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($venta->metodo_pago) }}</dd>
                </div>

                @if($venta->transaccion_id)
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">ID de Transacción</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $venta->transaccion_id }}</dd>
                </div>
                @endif

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 border-b border-gray-100 pb-2">Productos</dt>
                    <dd class="mt-1">
                        <div class="space-y-4">
                            @foreach ($venta->detalles as $detalle)
                                <div class="flex flex-col sm:flex-row justify-between items-start border-b border-gray-100 pb-4">
                                    <div class="flex flex-col sm:flex-row sm:gap-4 flex-1 w-full">
                                        <div class="flex-shrink-0 w-full sm:w-20 h-48 sm:h-20 mb-4 sm:mb-0">
                                            <img src="{{ Storage::url($detalle->producto->imagen_principal) }}"
                                                alt="{{ $detalle->producto->modelo }}"
                                                class="w-full h-full object-cover rounded-lg">
                                        </div>
                                        <div class="flex-1">
                                            <a href="{{ route('producto.show', [$detalle->producto->categoria, $detalle->producto]) }}"
                                               class="text-sm font-medium text-gray-900 hover:text-indigo-600">
                                                {{ $detalle->producto->modelo }}
                                            </a>
                                            <div class="mt-1 text-sm text-gray-500">
                                                <p>Talla: {{ $detalle->talla }}</p>
                                                <p>Cantidad: {{ $detalle->cantidad }}</p>
                                                <p>Precio unitario: S/ {{ number_format($detalle->precio_unitario, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-left sm:text-right mt-2 sm:mt-0 w-full sm:w-auto">
                                        <span class="text-sm font-medium text-gray-900">
                                            S/ {{ number_format($detalle->subtotal, 2) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Total</dt>
                    <dd class="mt-1 text-lg font-bold text-gray-900">
                        S/ {{ number_format($venta->total, 2) }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection
