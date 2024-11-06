@props([
    'href' => '#',
    'spa' => false,
])

<a 
    {{ $attributes }}
    href="{{ $href }}"
    @if($spa)
        wire:navigate.hover
    @endif
> 
    {{ $slot }}  
</a>

