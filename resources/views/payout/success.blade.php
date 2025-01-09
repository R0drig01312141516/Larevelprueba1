@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center content-center h-full py-4">
    <div class="mx-auto my-5 w-full max-w-xl px-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-green-500 px-6 py-4">
                <h1 class="text-white text-center text-2xl font-bold">Pago Exitoso</h1>
            </div>

            <div class="px-4 py-8">
                <div class="text-center">
                    <i class="fas fa-check-circle text-green-500 text-6xl"></i>
                    <h2 class="mt-4 text-2xl font-semibold text-gray-800">¡Gracias por tu compra!</h2>
                    <p class="mt-2 text-gray-600">Tu pago se ha procesado correctamente.</p>
                    <p class="mt-1 text-sm text-gray-500">ID de transacción: {{ $transaccion_id }}</p>

                    <div class="mt-4 space-y-3 inline-flex flex-col">
                        <x-button-secondary href="{{ route('cliente.pedidos') }}"
                            class="w-full justify-center bg-green-500 hover:bg-green-600">
                            Ver mis pedidos
                        </x-button-secondary>

                        <x-button-secondary href="{{ route('productos') }}" class="w-full justify-center">
                            Seguir Comprando
                        </x-button-secondary>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
