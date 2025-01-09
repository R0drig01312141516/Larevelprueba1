@push('styles')
    <link rel="stylesheet" href="{{ asset('css/components/producto-card.css') }}">
@endpush

<a href="{{ route('producto.show', [$producto->categoria, $producto]) }}" class="product-card">
    <div class="product-image">
        <img src="{{ Storage::url($producto->imagen_principal) }}" alt="{{ $producto->modelo }}">
        @if ($producto->oferta)
            <div class="discount-badge text-sm md:text-base">-{{ number_format($producto->oferta->porcentaje, 0) }}%</div>
        @endif
    </div>
    <div class="product-info">
        <h3 class="product-title text-lg md:text-xl font-bold truncate">{{ $producto->modelo }}</h3>
        <P class="product-marca text-sm md:text-base truncate">{{ $producto->marca->marca }} -
            {{ $producto->categoria->categoria }}
        </P>
        <div class="product-price d-flex align-items-center gap-2 truncate">
            <span class="final-price text-lg md:text-xl font-bold">S/
                {{ number_format($producto->precio_final, 2) }}</span>
            @if ($producto->oferta)
                <span class="original-price text-sm md:text-base truncate">S/
                    {{ number_format($producto->precio, 2) }}</span>
            @endif
        </div>
    </div>
</a>
