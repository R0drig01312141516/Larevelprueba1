@props([
    'type' => 'button',
    'href' => null,
    'class' => '',
])

@if($href)
    <a href="{{ $href }}"
        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors {{ $class }}">
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}"
        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors {{ $class }}">
        {{ $slot }}
    </button>
@endif
