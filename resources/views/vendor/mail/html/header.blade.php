@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <h1 class="logo">
                    {{-- Obtener Nombre de la empresa --}}
                    {{ config('app.name') }}
                </h1>
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
