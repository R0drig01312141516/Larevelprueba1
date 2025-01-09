<header class="site-header anim-slide-down"  style="background-color: #030303ea; color: #ffffff;">
    <div class="header-container" >
        <a href="{{ route('inicio') }}" class="header-logo font-bold text-4xl">
                <img src="{{ asset('Europa/logooo.png') }}" alt="Logo" class="logo-img img-fluid" style="width: 100%; height: 79.5px;">
        </a>

        <nav class="main-nav">
            <ul class="nav-list">
                @if ($productos->count() > 0)
                    <li class="nav-link {{ request()->routeIs('productos') ? 'active' : '' }}">
                        <a href="{{ route('productos') }}">Todo</a>
                    </li>
                @endif
                @foreach ($categorias as $categoria)
                    @if ($categoria->productos->where('disponible', true)->count() > 0)
                        <li class="nav-link {{ request()->is('catalogo/' . $categoria->slug) ? 'active' : '' }}">
                            <a href="{{ route('categoria.show', $categoria) }}">
                                {{ $categoria->categoria }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>

        <div class="header-actions">
            <form id="product-search" class="search-form" action="{{ route('productos.buscar') }}" method="GET">
                <input class="search-input" type="search" name="buscar" placeholder="Buscar productos..."
                    aria-label="Buscar productos" required>
                <button class="search-button" type="submit" aria-label="Buscar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

            <a href="{{ route('carrito.index') }}" class="cart-icon" aria-label="Ver carrito">
                <i class="fa-solid fa-cart-shopping"></i>
                @php
                    if (Auth::guard('cliente')->check()) {
                        Cart::restore(Auth::guard('cliente')->id());
                    }
                    $cartCount = Cart::count();
                @endphp
                @if ($cartCount > 0)
                    <span class="cart-count">{{ $cartCount }}</span>
                @endif
            </a>

            <div class="hidden md:block">
                @auth('cliente')
                    <div class="relative">
                        <button id="user-dropdown-button"
                            class="flex items-center space-x-2 text-blue-500 hover:text-blue-900 focus:outline-none">
                            <span class="font-medium text-md">{{ Auth::guard('cliente')->user()->nombre }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="user-menu"
                            class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg overflow-hidden z-20 hidden">
                            <div class="px-4 py-3 bg-gray-50">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::guard('cliente')->user()->nombre }}
                                    {{ Auth::guard('cliente')->user()->apellidos }}</p>
                                <p class="text-sm font-medium text-gray-500 truncate">
                                    {{ Auth::guard('cliente')->user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('cliente.pedidos') }}"
                                    class="flex items-center px-4 py-2 text-sm text-blue-500 hover:bg-gray-100">
                                    <i class="fa-solid fa-box-archive mr-3"></i>
                                    Mis pedidos
                                </a>
                                <form action="{{ route('cliente.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex w-full items-center px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                                        <i class="fa-solid fa-right-from-bracket mr-3"></i>
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('cliente.login') }}" class="user-icon" aria-label="Mi cuenta">
                        <i class="fa-solid fa-user"></i>
                    </a>
                @endauth
            </div>

            <button class="menu-toggle" aria-label="Menú móvil" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

@push('scripts')
    <script src="{{ asset('js/header.js') }}"></script>
@endpush
