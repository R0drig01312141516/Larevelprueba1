@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
@endpush

@section('content')
<div class="page-container pb-5">
    <h1 class="mt-5 mb-4 text-2xl md:text-3xl font-bold text-center">Resultados de búsqueda para "{{ $busqueda }}"</h1>

    @if ($productos->count() === 0)
        <div class="flex justify-center items-center flex-col gap-4 mt-4 mb-5">
            <p class="text-gray-600 text-center text-base">No se encontraron productos relacionados con la
                búsqueda</p>
            <x-button-primary href="{{ route('productos') }}" class="mt-4">
                Volver a la página principal
            </x-button-primary>
        </div>
    @else
        <div class="product-grid mt-2">
            @foreach ($productos as $producto)
                <x-product-card :producto="$producto" />
            @endforeach
        </div>

        <div class="mt-10 flex justify-center gap-4">
            @if ($productos->onFirstPage())
                <button disabled class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                    Anterior
                </button>
            @else
                <a href="{{ $productos->appends(['buscar' => $busqueda])->previousPageUrl() }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Anterior
                </a>
            @endif

            <span class="px-4 py-2">
                {{ $productos->currentPage() }} de {{ $productos->lastPage() }}
            </span>

            @if ($productos->hasMorePages())
                <a href="{{ $productos->appends(['buscar' => $busqueda])->nextPageUrl() }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Siguiente
                </a>
            @else
                <button disabled class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                    Siguiente
                </button>
            @endif
        </div>
    @endif
</div>
@endsection
