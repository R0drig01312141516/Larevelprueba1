@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/nosotros.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contacto.css') }}">
@endpush

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush

@section('content')
<div class="page-container">
    <div class="header-nosotros">
        <div class="about-title anim-slide-up">
            <h1 class="text-4xl font-bold">Acerca de Zapatería Yuly</h1>
        </div>
        <div class="about-image anim-slide-up">
            <img src="{{ Storage::url('img/nosotros/about.png') }}" alt="About">
        </div>
    </div>

    <section class="nosotros-container">
        <div class="text-container anim-slide-up">
            <h1 class="text-2xl font-bold">Nosotros</h1>
            <p class="text-lg">Con más de 20 años de experiencia, ofrecemos calzado de calidad y estilo para toda la
                familia.</p>
        </div>
        <div class="text-container anim-slide-up">
            <h2 class="text-2xl font-bold">Misión</h2>
            <p class="text-lg">Ofrecer una experiencia de compra y servicio de calidad y estilo a los clientes.</p>
        </div>
        <div class="text-container anim-slide-up">
            <h2 class="text-2xl font-bold">Visión</h2>
            <p class="text-lg">Ser la zapatería líder a nivel nacional, destacada por estilo, calidad y confianza.</p>
        </div>
    </section>

    <div class="contacto-wrapper anim-slide-up">

        <div class="contacto-text">
            <h1 class="contacto-title text-3xl font-bold">Contacto</h1>
            <p class="contacto-subtitle text-lg">Si tienes alguna pregunta, comentario o sugerencia, no dudes en
                contactarnos.</p>
            <p class="contacto-subtitle text-lg">O tambien puedes enviarnos un mensaje a nuestro <a
                    href="https://wa.me/55123456789">WhatsApp</a></p>
        </div>

        @if (session('success'))
            <div class="mx-4 mt-4">
                <x-alert :message="session('success')" />
            </div>
        @endif

        @error('email')
            <div class="mx-4 mt-4">
                <x-alert-error :message="$message" />
            </div>
        @enderror

        <form class="contacto-form" action="{{ route('contacto') }}" method="POST">
            @csrf
            <div class="form-content">
                <input class="contact-input" type="text" name="nombre" placeholder="Nombre" required>
                <input class="contact-input" type="email" name="email" placeholder="Email" required>
                <textarea class="contact-textarea" name="mensaje" placeholder="Mensaje" minlength="5"
                    required></textarea>

                <div>
                    <div class="g-recaptcha mb-3" data-sitekey="{{ config('services.recaptcha.site_key') }}">


                    </div>

                    @error('g-recaptcha-response')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                </div>

                <button class="contact-button" type="submit">
                    <div class="svg-wrapper-1">
                        <div class="svg-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path fill="currentColor"
                                    d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <span>Enviar</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
