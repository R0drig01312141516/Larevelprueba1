@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center content-center h-full">
    <div class="text-center h-100 my-auto">
        <h1 class="text-6xl font-bold text-gray-800">404</h1>
        <p class="text-xl text-gray-600 mt-4">Página no encontrada</p>
        <a href="{{ route('inicio') }}"
            class="mt-6 inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
            Volver al inicio
        </a>
    </div>
</div>
@endsection
