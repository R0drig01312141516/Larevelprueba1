@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/producto-mostrar.css') }}">
@endpush

@section('content')
    @php
        $tallasDisponibles = $producto->tallas->where('pivot.cantidad', '>', 0)->count();
    @endphp

    <div class="page-container my-4">
        @if (session('success'))
            <x-alert :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert-error :message="session('error')" />
        @endif

        <div class="product-specs-container">
            <div class="product-img-wrapper">
                @if ($producto->galeria->count() > 0)
                    <div class="product-secondary-images">
                        @foreach ($producto->galeria as $imagen)
                            <img src="{{ Storage::url($imagen->imagen_galeria) }}" alt="{{ $producto->modelo }}"
                                class="border rounded-2xl">
                        @endforeach
                    </div>
                @endif
                <div class="product-main-img overflow-hidden border rounded-2xl"
                    style="@if ($producto->galeria->count() < 1) grid-column: span 5; @endif">
                    <div class="img-zoom-container">
                        <img src="{{ Storage::url($producto->imagen_principal) }}" alt="{{ $producto->modelo }}">
                    </div>
                </div>
            </div>

            <div class="product-info-wrapper">
                <div class="product-info-head">
                    <div class="product-tags">
                        <div class="tag marca text-sm md:text-base">
                            {{ $producto->marca->marca }}
                        </div>
                        <div class="tag categoria text-sm md:text-base">
                            <a href="{{ route('categoria.show', $producto->categoria) }}">
                                {{ $producto->categoria->categoria }}
                            </a>
                        </div>
                    </div>
                    <h1 class="text-base font-normal">Codigo: {{ ucwords($producto->codigo) }}</h1>
                    <h1 class="text-3xl font-bold">{{ ucwords($producto->modelo) }}</h1>
                    <div class="product-price d-flex align-items-center gap-2">
                        <span class="final-price text-2xl font-bold">S/
                            {{ number_format($producto->precio_final, 2) }}</span>
                        @if ($producto->oferta)
                            <span class="original-price text-xl line-through">S/
                                {{ number_format($producto->precio, 2) }}</span>
                        @endif
                    </div>
                </div>

                <form action="{{ route('carrito.agregar') }}" method="POST" class="product-info-body">
                    @csrf
                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                    <input type="hidden" name="modelo" value="{{ $producto->modelo }}">
                    <input type="hidden" name="precio" value="{{ $producto->precio_final }}">
                    <input type="hidden" name="url_imagen" value="{{ $producto->imagen_principal }}">

                    <div class="size">
                        @if ($producto->disponible)
                            <h2 class="text-xl font-semibold">Tallas</h2>
                            @if ($tallasDisponibles > 0)
                                <div class="sizes-group">
                                    @foreach ($producto->tallas as $talla)
                                        @if ($talla->pivot->cantidad > 0)
                                            <input type="radio" name="talla" id="talla_{{ $talla->talla }}"
                                                value="{{ $talla->talla }}" data-stock="{{ $talla->pivot->cantidad }}"
                                                class="size-input" required>
                                            <label for="talla_{{ $talla->talla }}"
                                                class="size-btn p-2 border border-gray-500 rounded">
                                                {{ $talla->talla }}
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="quantity">
                                    <h2 class="text-xl font-semibold">Cantidad</h2>
                                    <input type="number" class="p-2 border border-gray-500 rounded" value="1"
                                        min="1" max="5" name="qty" id="quantity-input" required>
                                </div>

                                <button type="submit" class="add-to-cart {{ $tallasDisponibles == 0 ? 'disabled' : '' }}"
                                    id="add-to-cart" {{ $tallasDisponibles == 0 ? 'disabled' : '' }}>
                                    <i class="fa-solid fa-bag-shopping"></i>
                                    Agregar al carrito
                                </button>
                            @else
                                <p class="no-sizes-available">Lo sentimos, no hay tallas disponibles actualmente</p>
                                <x-button-primary href="{{ route('inicio') }}">
                                    <span>Regresar</span>
                                    <span class="ms-2"><i class="fa-solid fa-house"></i></span>
                                </x-button-primary>
                            @endif
                        @else
                            <p class="no-sizes-available">Lo sentimos, el producto no está disponible</p>
                            <x-button-primary href="{{ route('inicio') }}">
                                <span>Regresar</span>
                                <span class="ms-2"><i class="fa-solid fa-house"></i></span>
                            </x-button-primary>
                        @endif
                    </div>

                </form>
            </div>
        </div>

        @if ($recomendaciones->count() > 0)
            <div class="recomendations-container my-5">
                <h2 class="recomendations-title text-2xl md:text-3xl font-bold">Podría interesarte</h2>

                <div class="recommendations-wrapper">
                    @foreach ($recomendaciones as $recomendacion)
                        <x-product-card :producto="$recomendacion" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/producto-mostrar.js') }}"></script>
    {{-- agrgado --}}

@endpush
