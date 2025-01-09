@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
@endpush

@section('content')
    <div class="container mb-5">
        @if ($productoReciente)
            <section class="featured-card">
                <div class="featured-content">

                    <span class="featured-badge bg-red-500">
                        <i class="featured-badge-icon fa-solid fa-fire-flame-curved"></i>
                        Reciente
                    </span>

                    <h1 class="featured-title text-center mt-4">{{ ucwords($productoReciente->modelo) }}</h1>
                    <p class="featured-description text-center text-sm md:text-base mt-2">
                        {{ $productoReciente->descripcion }}
                    </p>

                    <x-button-secondary
                        href="{{ route('producto.show', [$productoReciente->categoria, $productoReciente]) }}"
                        class="mt-4">
                        Ver producto
                    </x-button-secondary>

                </div>
                <div class="featured-img-wrapper">
                    <img class="featured-img" src="{{ Storage::url($productoReciente->imagen_principal) }}"
                        alt="{{ $productoReciente->modelo }}">
                </div>
            </section>
        @endif

        @foreach ($categorias as $categoria)
            @if ($categoria->productos->count() > 0)
                <section class="text-center py-3">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center mt-4">{{ $categoria->categoria }}</h2>
                    <div class="product-grid">
                        @foreach ($categoria->productos->take(4) as $producto)
                            <x-product-card :producto="$producto" />
                        @endforeach
                    </div>
                    <div class="flex justify-center">
                        <x-button-primary href="{{ route('categoria.show', $categoria->slug) }}" class="mt-4">
                            Mostrar Todo
                        </x-button-primary>
                    </div>
                </section>
            @endif
        @endforeach
    </div>
@endsection
