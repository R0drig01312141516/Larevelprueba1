@extends('layouts.app')


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/inicio1.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/
    bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    {{-- slick --}}
   
    <link
    rel="stylesheet"
    href="https://unpkg.com/swiper/swiper-bundle.min.css"
  />

    <!-- TIPOGRAFIA -->
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
    </style>
@endpush



@section('content')

    <body>
        <main class="main">
            <div class="rojo">
                <a class="rojo1" href="https://wa.me/51964668311" target="_blank">
                    <img src="{{ asset('Europa/whapts.png') }}" alt="whatsapp" />
                    <h2>AGENDA TU PEDIDO AL 964668311</h2>
                </a>
            </div>

            <div class="carrousel">
                <div class="grande">
                    <img class="imgg" src="#" alt="Imagen 1" />
                    <img class="imgg" src="#" alt="Imagen 2" />
                </div>

                <ul class="puntos">
                    <li class="punto"></li>
                    <li class="punto"></li>
                </ul>
            </div>

            <br>
            <br>

            {{-- carrusel  --}}


            <!-- Agrega tus 19 imágenes aquí -->

            <div class="sliderCARRUSEL">
                <h2 class="text-2xl md:text-3xl font-bold section-title">TUS MARCAS</h2>
                <div class="slide-track">
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/1.png') }}" alt="Imagen 1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/2.png') }}" alt="Imagen 1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/3.png') }}" alt="Imagen 1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/4.png') }}" alt="Imagen 1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/5.png') }}" alt="Imagen 1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/6.png') }}" alt="Imagen 1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/7.png') }}" alt="Imagen 1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/8.png') }}" alt="Imagen 1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/9.png') }}" alt="Imagen 1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/10.png') }}" alt="Imagen 1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/11.png') }}" alt="Imagen 1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/12.png') }}" alt="Imagen 1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/13.png') }}" alt="Imagen 1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/14.png') }}" alt="Imagen    1">
                    </div>

                    <div class="slide">
                        <img src="{{ asset('Europa/marca/16.png') }}" alt="Imagen    1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/17.png') }}" alt="Imagen    1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/18.png') }}" alt="Imagen    1">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('Europa/marca/19.png') }}" alt="Imagen    1">
                    </div>
                </div>

            </div>
            {{-- carrusel/fin  --}}


            <div class="panel">
                <div class="panela">
                    <a class="apanel" href="#">
                        <div class="overlayy">
                            <h2 class="overlay-text">Prueba</h2>
                        </div>
                        <img class="imag" src="{{ asset('Europa/Pnal/Pnal7.jpg') }}" alt="" />
                    </a>
                </div>

                <div class="panelb">
                    <a class="apanel1" href="#">
                        <div class="overlayy">
                            <h2 class="overlay-text">Prueba</h2>
                        </div><img class="imag" src="{{ asset('Europa/Pnal/descarga (2).jpeg') }}" alt="" />
                    </a>
                    <a class="apanel2" href="#">
                        <div class="overlayy">
                        </div><img class="imag" src="{{ asset('Europa/Pnal/Pnal2.jpg') }}" alt="" />
                        <h2 class="overlay-text">Prueba</h2>
                    </a>
                </div>

                <div class="panelc">
                    <a class="apanel" href="#">
                        <div class="overlayy">
                            <h2 class="overlay-text">Prueba</h2>
                        </div><img class="imag" src="{{ asset('Europa/Pnal/nocta.jpg') }}" alt="" />
                    </a>
                </div>
            </div>


            {{-- archivo vulnerabel adaptado --}}
            @if ($ofertas->count() > 0)
                <div class="ofertas-container">
                    <!-- Hero Section -->
                    <section class="hero-section">
                        <h2 class="text-2xl md:text-3xl font-bold section-title">OFERTAS <svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-fire" viewBox="0 0 16 16">
                                <path
                                    d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15" />
                            </svg></h2>
                        <div class="hero-container w-full">
                            <div class="hero-slider">

                                @foreach ($ofertas as $oferta)
                                    <div class="hero-slide">
                                        <a
                                            href="{{ route('producto.show', [$oferta->producto->categoria, $oferta->producto]) }}">
                                            @php
                                                $imagen = $oferta->banner_oferta ?? $oferta->producto->imagen_principal;
                                            @endphp
                                            <img src="{{ Storage::url($imagen) }}"
                                                alt="{{ $oferta->producto->modelo }}">

                                            <div class="bg-gradient-to-t"></div>
                                            <div class="text-white">
                                                <h3 class="text-2xl md:text-5xl font-bold mb-2">
                                                    {{ $oferta->producto->modelo }}</h3>
                                                <p class="text-lg md:text-2xl">{{ $oferta->producto->marca->marca }}
                                                </p>
                                            </div>
                                            <div class="ofertin">
                                                <span
                                                    class="bg-gray-900 text-white px-3 pt-1 pb-1.5 rounded-full font-bold text-sm sm:text-lg md:text-2xl">
                                                    -{{ number_format($oferta->porcentaje) }}%
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Navigation Buttons -->
                            @if ($ofertas->count() > 1)
                                <div class="hero-navigation">
                                    <button class="hero-nav-btn hero-nav-prev nav-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                                        </svg>
                                    </button>
                                    <button class="hero-nav-btn hero-nav-next nav-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </section>
                </div>
            @endif
            {{-- archivo vulnerabel adaptado//fin --}}



            <div class="panelgeneral">
                <div class="panelsecundario">
                    <a class="a1" href="#">
                        <img src="{{ asset('Europa/reloj1.jpg') }}" alt="img1" />
                        <div class="text-sci">
                            <p class="text-ss">G-SHOCK</p>
                        </div>
                    </a>

                    <a class="a1" href="#">
                        <img src="{{ asset('Europa/reloj.jpg') }}" alt="img2" />

                        <div class="text-sci">
                            <p class="text-ss">NAVIFORCE</p>
                        </div>
                    </a>
                </div>




                <div class="panelprincipanl">
                    <div class="ppheader">
                        <div class="pph3">
                            <h3 class="h31">LO MEJOR DE LA SEMANA</h3>
                            <h3>LOS MÁS PEDIDOS</h3>
                        </div>

                        {{-- <div class="pb">
                            <a href="#">
                                << /a>
                                    <br>
                                    <a href="#">></a>
                        </div> --}}
                    </div>

                    <div class="ppmain">
                        <div class="cont-productos">
                            <!-- productos -->

                            @foreach ($nuevosProductos as $producto)
                                <div class="producto">
                                    <a class="apro"
                                        href="{{ route('producto.show', [$producto->categoria, $producto]) }}"><img
                                            src="{{ Storage::url($producto->imagen_principal) }}"
                                            alt="{{ $producto->modelo }}" alt="imagen" class="img-p" />
                                    </a>



                                    @if ($producto->oferta)
                                        <span class="porcentaje">-
                                            {{ number_format($producto->oferta->porcentaje, 0) }}%</span>
                                    @endif



                                    <a href="{{ route('producto.show', [$producto->categoria, $producto]) }}"><span
                                            class="titulo-p">{{ $producto->modelo }}-{{ $producto->marca->marca }}</span>
                                    </a>

                                    <a class="pprecio"
                                        href="{{ route('producto.show', [$producto->categoria, $producto]) }}">



                                        @if ($producto->oferta)
                                            <p class="pp"><span
                                                    class="pp">s/</span>{{ number_format($producto->precio, 2) }}
                                            </p>
                                        @endif

                                        <p>s/{{ number_format($producto->precio_final, 2) }}</p>
                                    </a>

                                    <div class="productoboton">
                                        <a class="boton-p"
                                            href="{{ route('producto.show', [$producto->categoria, $producto]) }}">
                                            <p class="pt">VER</p>

                                            <svg class="iconp" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" class="bi bi-eye-fill"
                                                viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                            </svg>


                                        </a>
                                    </div>
                                </div>
                            @endforeach




                            <!-- fin d eproductos -->
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
{{-- 
            <div class="panelventa22">
                <div class="pv2-header">
                    <div class="pv2-text">
                        <div class="span2"><span>MARCAS POPULARES</span></div>
                    </div>
                    <hr class="hrpv2" />

                    <div class="panelventa2-lista">
                        <ul class="ul-pv2">
                            <li class="list-p2"><a href="#">G-SHOCK</a></li>
                            <li class="list-p2"><a href="#">NAVIFORCE</a></li>
                            <li class="list-p2"><a href="#">MEGIR</a></li>
                            <li class="list-p2"><a href="#">CURREN</a></li>
                            <li class="list-p2"><a href="#">MINI FOCUS</a></li>
                        </ul>
                    </div>
                </div>

                <div class="panelventa2-main">
                    <div class="slick-carousel">
                        <div class="cont-productospv2">

                            @foreach ($nuevosProductos as $producto)
                                <div class="productopv2">
                                    <a class="apropv2"
                                        href="{{ route('producto.show', [$producto->categoria, $producto]) }}"><img
                                            src="{{ Storage::url($producto->imagen_principal) }}"
                                            alt="{{ $producto->modelo }}" class="img-ppv2" />
                                    </a>

                                    @if ($producto->oferta)
                                        <span class="porcentajepv2">-
                                            {{ number_format($producto->oferta->porcentaje, 0) }}%</span>
                                    @endif


                                    <a href="{{ route('producto.show', [$producto->categoria, $producto]) }}"><span
                                            class="titulo-ppv2">{{ $producto->modelo }}-{{ $producto->marca->marca }}</span>
                                    </a>

                                    <a class="ppreciopv2"
                                        href="{{ route('producto.show', [$producto->categoria, $producto]) }}">

                                        <p>s/</p>
                                        <p>{{ number_format($producto->precio_final, 2) }}</p>

                                        @if ($producto->oferta)
                                            <p class="pppv2"><span
                                                    class="pppv2">s/</span>{{ number_format($producto->precio, 2) }}</p>
                                        @endif



                                    </a>

                                    <div class="productobotonpv2">
                                        <a class="boton-ppv2"
                                            href="{{ route('producto.show', [$producto->categoria, $producto]) }}">
                                            <p class="ptpv2">VER</p>


                                            <svg class="iconppv2" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" class="bi bi-eye-fill"
                                                viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                            </svg>


                                        </a>
                                    </div>
                                </div>
                            @endforeach

                            <!-- 2 -->

                        </div>
                        <!-- fin del 6 -->
                    </div>
                </div>
            </div> --}}



            {{-- nuevi slider Productos --}}

            <!--== Slider ============================================-->
          
            <section class="product-slider">
                <!-- Heading -->
                <h4 class="product-slider-heading">Product Slider</h4>
    
                <!-- Slider Container -->
                <div class="slider-container">
                    <!-- Swiper -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <!-- Slide 1 -->
                            @foreach ($nuevosProductos as $producto)
                            <div class="swiper-slide">
                                <div class="product-box">
                                    @if ($producto->oferta)
                                    <span class="product-box-offer">-{{ number_format($producto->oferta->porcentaje, 0) }}%</span>
                                    @endif
                                    <div class="product-img-container">
                                        <div class="product-img">
                                            <a href="{{ route('producto.show', [$producto->categoria, $producto]) }}">
                                                <img class="product-img-front" src="{{ Storage::url($producto->imagen_principal) }}" alt="{{ $producto->modelo }}" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-box-text">
                                        <div class="product-category"><span>{{ $producto->marca->marca }}</span></div>
                                        <a href="{{ route('producto.show', [$producto->categoria, $producto]) }}" class="product-title">{{ $producto->modelo }}</a>
                                        <div class="price-buy">
                                            @if ($producto->oferta)
                                            <span class="p-price-secundary">S/{{ number_format($producto->precio_final, 2) }}</span>
                                            @endif
                                            <span class="p-price">S/{{ number_format($producto->precio, 2) }}</span>
                                     

                                        </div>
    
                                        <!-- agregar boton -->
                                        <div class="productoboton">
                                            <a class="boton-p" href="{{ route('producto.show', [$producto->categoria, $producto]) }}">
                                                <p class="pt">VER</p>
    
                                                <svg class="iconp" xmlns="http://www.w3.org/2000/svg" width="30"
                                                    height="30" fill="currentColor" class="bi bi-eye-fill"
                                                    viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                    <path
                                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                                </svg>
                                            </a>
                                        </div>
    
    
                                    </div>
                                </div>
                            </div>
   
                            @endforeach

    
                            <!-- Repeat similar blocks for other slides -->
                        </div>
                        <!-- Navigation Buttons -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </section>

            {{-- Fin/nuevi slider Productos --}}




            <!--check  en panel(inicio)-->
            <div class="check">
                <div class="conteiner-check">
                    <!-- 1 -->
                    <div class="checkG">
                        <a href="checkGGico">
                            <svg class="svg-check" xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path
                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                <path
                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                            </svg>
                        </a>

                        <a class="checkGG" href="#">
                            <span>Envío gratis a todo el Perú</span>
                            <p>Tanto en lima como provincia</p>
                        </a>
                    </div>
                    <!--2-->
                    <div class="checkG">
                        <a href="checkGGico">
                            <svg class="svg-check" xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path
                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                <path
                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                            </svg>
                        </a>

                        <a class="checkGG" href="#">
                            <span>Accesorios de regalo</span>
                            <p>Incluye caja metálica* y pulsera de cuero</p>
                        </a>
                    </div>
                    <!--3-->
                    <div class="checkG">
                        <a href="checkGGico">
                            <svg class="svg-check" xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path
                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                <path
                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                            </svg>
                        </a>

                        <a class="checkGG" href="#">
                            <span>Garantía de fabrica</span>
                            <p>Ante cualquier desperfecto</p>
                        </a>
                    </div>
                    <!--4-->
                    <div class="checkG">
                        <a href="checkGGico">
                            <svg class="svg-check" xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path
                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                <path
                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                            </svg>
                        </a>

                        <a class="checkGG" href="#">
                            <span>Atención rápida</span>
                            <p>Resolvemos tus dudas</p>
                        </a>
                    </div>
                    <!--fin-->
                </div>
            </div>
            <!--check  en panel(final)-->


    



        </main>

       


    </body>
@endsection

@push('scripts')
    <script src="{{ asset('js/app1.js') }}"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

@endpush


{{-- <section class="hero-one mb-5 w-full">
         <div class="hero-content">
             <h1 class="text-3xl font-bold">Bienvenido a nuestra Tienda de Calzado</h1>
             <p class="text-lg">Descubre las últimas tendencias</p>
         </div>
     </section>
     <div class="container">

      @if ($ofertas->count() > 0)
            <section class="hero-section">
                 <h2 class="text-2xl md:text-3xl font-bold section-title">Ofertas</h2>
                 <div class="hero-container w-full">
                     <div class="hero-slider">
                         @foreach ($ofertas as $oferta)
                             <div class="hero-slide">
                              <a href="{{ route('producto.show', [$oferta->producto->categoria, $oferta->producto]) }}">
                                     @php
                                         $imagen = $oferta->banner_oferta ?? $oferta->producto->imagen_principal;
                                     @endphp
                                     <img src="{{ Storage::url($imagen) }}" alt="Oferta {{ $oferta->producto->modelo }}">

                                     <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                                     <div class="absolute bottom-0 left-0 p-6 text-white">
                                         <h3 class="text-2xl md:text-5xl font-bold mb-2">{{ $oferta->producto->modelo }}</h3>
                                         <p class="text-lg md:text-2xl">{{ $oferta->producto->marca->marca }}</p>
                                     </div>

                                     <div class="absolute top-4 md:top-6 right-4">                                         <span
                                            class=" bg-gray-900 text-white px-3 pt-1 pb-1.5 rounded-full font-bold text-sm sm:text-lg md:text-2xl">
                                             -{{ number_format($oferta->porcentaje) }}%
                                         </span>
                                     </div>
                                 </a>
                            </div>
                         @endforeach
                                             </div>
                    @if ($ofertas->count() > 1)
                         <div class="hero-navigation">
                             <button class="hero-nav-btn hero-nav-prev nav-btn">
                                 <i class="bx bx-chevron-left"></i>
                             </button>
                             <button class="hero-nav-btn hero-nav-next nav-btn">
                                 <i class="bx bx-chevron-right"></i>
                             </button>
                         </div>
                     @endif
                 </div>
             </section>
         @endif

         @if ($nuevosProductos->count() > 0)
             <section class="slider-container">
                 <h2 class="text-2xl md:text-3xl font-bold section-title">Lo Nuevo</h2>
                 <div class="slider-wrapper">
                     @foreach ($nuevosProductos as $producto)
                         <div class="slide p-2">
                             <x-product-card :producto="$producto" />
                         </div>
                     @endforeach
                 </div>
                 <div class="flex justify-center">
                     <x-button-primary href="{{ route('productos') }}" class="mt-4">
                         Mostrar Todo
                     </x-button-primary>
                 </div>
             </section>
         @endif
     </div>  --}}
