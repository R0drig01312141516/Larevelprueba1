@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
@endpush

@section('content')
<div class="page-container mb-5">
    <h1 class="mt-5 mb-4 text-2xl md:text-3xl font-bold text-center">Categoría {{ $categoria->categoria }}</h1>

    {{-- Lista de marcas con enlaces --}}
    <div class="flex flex-wrap justify-center gap-4 my-6">
        @foreach ($productosPorMarcaPaginados as $marca => $productosPag)
            <a href="#marca-{{ \Illuminate\Support\Str::slug($marca) }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                {{ $marca }}
            </a>
        @endforeach
    </div>

    @if ($productosPorMarcaPaginados->isEmpty())
        <div class="text-center d-flex justify-content-center">
            <p class="text-gray-600">No se encontraron productos en esta categoría.</p>
        </div>
    @else
        @foreach ($productosPorMarcaPaginados as $marca => $productosPag)
            <div id="marca-{{ \Illuminate\Support\Str::slug($marca) }}" class="brand-section mb-6">
                <h2 class="text-xl font-bold mb-4">{{ $marca }}</h2>

                <div class="product-grid">
                    @foreach ($productosPag as $producto)
                        <x-product-card :producto="$producto" />
                    @endforeach
                </div>
                
                {{-- Paginación --}}
                <div class="mt-4 flex justify-center gap-4">
                    @if ($productosPag->onFirstPage())
                        <button disabled class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                            Anterior
                        </button>
                    @else
                        <a href="{{ $productosPag->previousPageUrl() }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Anterior
                        </a>
                    @endif

                    <span class="px-4 py-2">
                        {{ $productosPag->currentPage() }} de {{ $productosPag->lastPage() }}
                    </span>

                    @if ($productosPag->hasMorePages())
                        <a href="{{ $productosPag->nextPageUrl() }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Siguiente
                        </a>
                    @else
                        <button disabled class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                            Siguiente
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>


@endsection