

@push('styles')
<link rel="stylesheet" href="{{ asset('public/css/Footer1.css') }}">
@endpush

<body>

    <footer class="footer">
        <div class="footer1">
            <h1 class="h1">¡SIGUENOS!</h1>
    
            <div class="a">
                <a href=""><img src="{{ asset('Europa/tik tok negro.png') }}" alt="" height="50px" width="50px" /></a>
                <a href=""><img src="{{ asset('Europa/linkedin negro.png') }}" alt="" height="50px" width="50px" /></a>
                <a href=""><img src="{{ asset('Europa/youtube negro.png') }}" alt="" height="50px" width="50px" /></a>
                <a href=""><img src="{{ asset('Europa/faceboo negro.png') }}" alt="" height="50px" width="50px" /></a>
                <a href=""><img src="{{ asset('Europa/instagram negro.png') }}" alt="" height="50px" width="50px" /></a>
            </div>
        </div>
    
        <h1>SERVICIO AL CLIENTE</h1>
    
        <div class="go">
            <a href="">
                <p>¡Configura Tu Reloj! (Tutoriales)</p>
            </a>
            <a href="{{ route('envios') }}">
                <p>Política De Envíos</p>
            </a>
            <a href="{{ route('envios') }}">
                <p>Políticas De Privacidad</p>
            </a>
          
        </div>
    
        <h1>SOBRE NOSOTROS</h1>
        <div class="go">
            <a href="{{ route('nosotros') }}">
                <p>Nuestra Historia</p>
            </a>
            <a href="{{ route('nosotros') }}">
                <p>Visión Y Misión</p>
            </a>
            <a href="{{ route('nosotros') }}">
                <p>¡Contáctanos!</p>
            </a>
        </div>
    
        <div class="footerimg">
            <img src="{{ asset('Europa/images.png') }}" alt="" />
        </div>
    </footer>
        
</body>




{{-- <footer class="site-footer">
    <div class="footer-container">
        <div class="footer-grid">
            <a class="footer-brand" href="{{ route('inicio') }}">
                Yuly
            </a>

            <div class="footer-links">
                <h3>Enlaces Rápidos</h3>
                <ul>
                    <li><a class="footer-link" href="{{ route('inicio') }}">Inicio</a></li>
                    <li><a class="footer-link" href="{{ route('productos') }}">Productos</a></li>
                    <li><a class="footer-link" href="{{ route('nosotros') }}">Nosotros</a></li>
                    <li><a class="footer-link" href="{{ route('envios') }}">Envíos</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h3>Ubicación</h3>
                <address>
                    <p>CC. Diver Plaza TDA 30</p>
                    <p>Piura, Perú</p>
                    <p>Tel: <a href="tel:+51987654321">+51 987654321</a></p>
                </address>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="copyright">
                &copy; {{ date('Y') }} Zapateria Yuly. Todos los derechos reservados.
            </p>
            <div class="social-links">
                <a href="https://wa.me/51987654321" target="_blank" rel="noopener" aria-label="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                    <p>WhatsApp</p>
                </a>
            </div>
        </div>
    </div>
</footer> --}}
