@push('styles')
    <link rel="stylesheet" href="{{ asset('css/components/button-primary.css') }}">
@endpush

@props([
    'type' => 'button',
    'href' => null,
    'class' => '',
])

@if($href)
    <a href="{{ $href }}" class="button-primary {{ $class }}">
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="button-primary {{ $class }}">
        {{ $slot }}
    </button>
@endif
