@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Carrito de compras</h2>
    @if (session('success'))
        <x-alert :message="session('success')" />
    @endif
    @if (session('error'))
        <x-alert-error :message="session('error')" />
    @endif
    @if (isset($items) && $items->count() > 0)
        <section class="carrito">
            <section class="carrito-productos">
                <article class="cart-card productos-card">
                    @foreach ($items as $item)
                                <div class="carrito-producto max-w-full">
                                    @php
                                        $producto = App\Models\Producto::findOrFail($item->id);
                                    @endphp
                                    <a href="{{ route('producto.show', [$producto->categoria, $producto]) }}" class="producto-imagen">
                                        <form action="{{ route('carrito.eliminar', $item->rowId) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="producto-quitar"><i class="fa-solid fa-xmark"></i></button>
                                        </form>
                                        <img src="{{ Storage::url($item->options->url_imagen) }}" alt="{{ $item->name }}" class="border border-gray-200 rounded-md">
                                    </a>
                                    <div class="producto-info truncate">
                                        <a href="{{ route('producto.show', [$producto->categoria, $producto]) }}"
                                            class="text-xl font-bold truncate">{{ $item->name }}</a>
                                        <p>Precio: <span> S/{{ $producto->precio }}</span></p>
                                        <p  class="13s">Codigo: <span>{{ $producto->codigo }}</span></p>
                                        <p>Talla: <span>{{ $item->options->talla }}</span></p>
                                        <p>Cantidad:
                                        <form action="{{ route('carrito.actualizar', $item->rowId) }}" method="POST"
                                            class="carrito-actualizar">
                                            @csrf
                                            @php
                                                $talla = $item->options->talla;
                                                $cantidadDisponible = $producto
                                                    ->tallas()
                                                    ->where('tallas.talla', $talla)
                                                    ->first()->pivot->cantidad;
                                            @endphp
                                            <input type="number" name="cantidad" value="{{ $item->qty }}" min="1"
                                                max="{{ min($cantidadDisponible, 5) }}" class="cantidad-input" required>
                                            <x-button-secondary type="submit" class="truncate max-w-full">Actualizar</x-button-secondary>
                                        </form>
                                        </p>
                                    </div>

                                </div>
                    @endforeach
                </article>
                <div class="carrito-footer mt-4">
                    <form action="{{ route('carrito.vaciar') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button-secondary type="submit" class="bg-red-500 hover:bg-red-600 float-end">Vaciar Carrito</x-button-secondary>
                    </form>
                </div>
            </section>

            <section class="carrito-resumen">
                <article class="cart-card resumen-card">
                    <div class="resumen-head">
                        <h2 class="text-xl font-bold text-gray-900">Resumen</h2>
                    </div>
                    <div class="resumen-info">
                        <p class="resumen-text font-bold">Subtotal: <span
                                class="font-normal">S/{{ number_format($resumen['subtotal'], 2) }}</span></p>
                        <p class="resumen-text font-bold">IGV (Incluido): <span
                                class="font-normal">S/{{ number_format($resumen['igv'], 2) }}</span></p>
                        <p class="resumen-text font-bold"><a href="{{ route('envios') }}" class="underline">Envio:</a><span
                                class="font-normal">Recoger en tienda</span></p>
                    </div>
                    <div class="resumen-footer">
                        <p class="resumen-text font-bold">Total: <span
                                class="font-normal">S/{{ number_format($resumen['total'], 2) }}</span></p>
                        <div class="resumen-buttons">
                            <form action="{{ route('comprar.paypal') }}" method="POST">
                                @csrf
                                <input type="hidden" name="total" value="{{ $resumen['total'] }}">

                                @foreach ($items as $item)
                                    <input type="hidden" name="product_names[]" value="{{ $item->name }}">
                                    <input type="hidden" name="quantities[]" value="{{ $item->qty }}">
                                @endforeach

                                <button class="btn-comprar" type="submit">
                                    <span class="btn-text">Comprar</span>
                                    <span class="btn-icon"><i class="fa-solid fa-cart-shopping"></i></span>
                                </button>
                            </form>
                            <a class="btn-continuar" href="{{ route('productos') }}">Seguir Comprando</a>
                        </div>
                    </div>
                </article>
            </section>
        </section>
    @else
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
                    <p class="text-sm text-blue-700">No hay productos en tu carrito</p>
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-4">
            <x-button-secondary href="{{ route('productos') }}">
                Agregar productos
            </x-button-secondary>
        </div>
    @endif
</div>
@endsection


