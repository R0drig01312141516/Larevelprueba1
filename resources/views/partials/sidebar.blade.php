<nav class="mobile-nav">
    <div class="mobile-nav-header font-bold text-4xl">
        <h2 class="mobile-logo">Yuly</h2>
    </div>

    <form action="{{ route('productos.buscar') }}" class="mobile-search-form px-4">
        <div class="flex items-center justify-center max-w-full">
            <input class="mobile-search-input" type="text" placeholder="Buscar..." name="buscar" required>
            <button class="mobile-search-button" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </form>

    @auth('cliente')
        <div class="mobile-user-info border-b border-gray-200 mb-2 pb-3">
            <div class="flex items-center space-x-3 mb-3 px-2">
                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                    <span class="text-white text-lg font-semibold">
                        {{ substr(Auth::guard('cliente')->user()->nombre, 0, 1) }}
                    </span>
                </div>
                <div>
                    <p class="font-medium text-gray-900 truncate">
                        {{ Auth::guard('cliente')->user()->nombre }} {{ Auth::guard('cliente')->user()->apellidos }}
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                        {{ Auth::guard('cliente')->user()->email }}
                    </p>
                </div>
            </div>
            <div class="space-y-2">
                <a href="{{ route('cliente.pedidos') }}"
                    class="flex items-center text-blue-500 hover:bg-blue-50 px-3 py-2 rounded-lg transition-colors">
                    <i class="fa-solid fa-box-archive mr-3"></i>
                    Mis pedidos
                </a>
                <form action="{{ route('cliente.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center text-red-500 hover:bg-red-50 px-3 py-2 rounded-lg transition-colors">
                        <i class="fa-solid fa-right-from-bracket mr-3"></i>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    @else
        <a href="{{ route('cliente.login') }}"
            class="flex items-center text-blue-500 hover:bg-blue-50 px-4 py-3 mb-4 border-b border-gray-200 rounded-lg">
            <i class="fa-solid fa-user mr-3"></i>
            Iniciar sesión
        </a>
    @endauth

    <ul class="mobile-nav-list">
        @if ($productos->count() > 0)
            <li>
                <a class="mob-nav-link {{ request()->routeIs('productos') ? 'active' : '' }}"
                    href="{{ route('productos') }}">Todo</a>
            </li>
        @endif
        @foreach ($categorias as $categoria)
            @if ($categoria->productos->where('disponible', true)->count() > 0)
                <li>
                    <a class="mob-nav-link {{ request()->is('catalogo/' . $categoria->slug) ? 'active' : '' }}"
                        href="{{ route('categoria.show', $categoria) }}">{{ $categoria->categoria }}</a>
                </li>
            @endif
        @endforeach
    </ul>
</nav>
