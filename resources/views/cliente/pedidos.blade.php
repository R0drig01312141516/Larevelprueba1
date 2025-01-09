@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 my-auto h-full">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Mis Pedidos</h2>

    @forelse($ventas as $venta)
        <div class="bg-white rounded-lg shadow mb-6 overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                <div class="flex flex-col">
                    <span class="text-lg font-semibold text-gray-900">Pedido #{{ $ventas->count() - $loop->index }}</span>
                    <span class="text-sm text-gray-600">{{ $venta->fecha->format('d/m/Y H:i') }}</span>
                </div>
                <span
                    class="px-3 py-1 rounded-full text-sm font-semibold self-start
                            {{ ($venta->estado === 'Entregado' ? 'bg-green-100 text-green-800' : ($venta->estado === 'Anulado' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }}">
                    {{ ucwords($venta->estado) }}
                </span>
            </div>

            <div class="p-4">
                <div class="space-y-4">
                    @foreach ($venta->detalles as $detalle)
                        <div
                            class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-gray-100 pb-4">
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('producto.show', [$detalle->producto->categoria, $detalle->producto]) }}"
                                    class="text-base font-medium text-gray-900 hover:text-indigo-600 truncate">{{ $detalle->producto->modelo }}</a>
                                <div class="mt-1 flex flex-wrap gap-4 text-sm text-gray-500">
                                    <span>Talla: {{ $detalle->talla }}</span>
                                    <span>Cantidad: {{ $detalle->cantidad }}</span>
                                    <span>Precio: S/ {{ number_format($detalle->precio_unitario, 2) }}</span>
                                </div>
                            </div>
                            <div class="mt-2 sm:mt-0 text-right">
                                <span class="text-sm font-medium text-gray-900">
                                    S/ {{ number_format($detalle->subtotal, 2) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-base font-semibold text-gray-900">Total</span>
                        <span class="text-lg font-bold text-gray-900">S/ {{ number_format($venta->total, 2) }}</span>
                    </div>

                    <div class="text-sm text-gray-500 bg-gray-50 rounded-lg p-3">
                        <div class="flex flex-wrap gap-2">
                            <span>Método de pago: {{ ucfirst($venta->metodo_pago) }}</span>
                            @if ($venta->transaccion_id)
                                <span class="hidden sm:inline">•</span>
                                <span>ID Transacción: {{ $venta->transaccion_id }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <x-button-secondary href="{{ route('cliente.pedidos.show', $venta) }}">
                            Ver detalle
                        </x-button-secondary>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="rounded-md bg-blue-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">No tienes pedidos realizados aún.</p>
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-4">
            <x-button-secondary href="{{ route('productos') }}">
                Empezar a comprar
            </x-button-secondary>
        </div>
    @endforelse
</div>
@endsection
