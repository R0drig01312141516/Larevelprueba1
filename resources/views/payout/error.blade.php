@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center content-center h-full py-4">
    <div class="mx-auto my-5 w-full max-w-xl px-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="{{ session('error') ? 'bg-red-500' : 'bg-yellow-500' }} px-6 py-4">
                <h1 class="text-white text-center text-2xl font-bold">
                    @if (session('error'))
                        Error en el Pago
                    @else
                        Pago Cancelado
                    @endif
                </h1>
            </div>

            <div class="px-4 py-8">
                <div class="text-center">
                    <i class="fa-solid fa-circle-exclamation {{ session('error') ? 'text-red-500' : 'text-yellow-500' }} text-6xl"></i>
                    <h2 class="mt-4 text-2xl font-semibold text-gray-800">Lo sentimos</h2>
                    <p class="mt-2 text-gray-600">
                        @if (session('error'))
                            {{ session('error') }}
                        @else
                            La venta ha sido cancelada.
                        @endif
                    </p>

                    <div class="mt-4 space-y-3 inline-flex flex-col">
                        <x-button-secondary href="{{ route('carrito.index') }}" class="w-full justify-center">
                            Intentar de nuevo
                        </x-button-secondary>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
