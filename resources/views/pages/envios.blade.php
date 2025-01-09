@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12 md:px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="page-container py-5">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Información de Envíos</h1>
            <p class="text-lg text-gray-600">Gracias por elegir nuestros servicios</p>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                    <h2 class="ml-2 text-2xl font-semibold text-gray-800">Recogida en Tienda</h2>
                </div>
                <p class="text-gray-600 mb-4">Actualmente solo ofrecemos la opción de recogida en nuestra tienda física.
                </p>
            </div>

            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <h2 class="ml-2 text-2xl font-semibold text-gray-800">Nuestra Ubicación</h2>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700">Urb. Los Educadores. Mz M. Lt 04.</p>
                    <p class="text-gray-700">Piura, Perú</p>
                    <p class="text-gray-700">20000</p>
                    <p class="text-gray-700 mt-2">Horarios:</p>
                    <p class="text-gray-700">Lunes a Viernes de 9:00 AM a 6:00 PM</p>
                    <p class="text-gray-700">Sábados de 9:00 AM a 6:00 PM</p>
                    <p class="text-gray-700">Domingos y Festivos: 10:00 AM a 2:00 PM</p>
                </div>
            </div>

            <div class="p-6">
                <div class="flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h2 class="ml-2 text-2xl font-semibold text-gray-800">¡Gracias por tu Preferencia!</h2>
                </div>
                <p class="text-gray-600">Apreciamos tu confianza en nuestros servicios. Esperamos verte pronto en
                    nuestra tienda.</p>
            </div>
        </div>
    </div>
</div>
@endsection
