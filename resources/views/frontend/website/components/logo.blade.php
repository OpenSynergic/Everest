@props([
    'homeUrl' => url('/'),
    'headerLogo' => null,
    'headerLogoAltText' => config('app.name'),
])

@if ($headerLogo)
    <x-everest::link
        {{ $attributes->merge(['class' => 'inline-flex items-center']) }}
        :href="$homeUrl"
    >
        <div class="relative h-12 min-w-[100px] max-w-[200px]"> {{-- Sesuaikan ukuran --}}
            <img
                src="{{ $headerLogo }}"
                alt="{{ $headerLogoAltText }}"
                class="absolute inset-0 w-full h-full object-contain"
            />
        </div>
    </x-everest::link>
@else
    <x-everest::link
        :href="$homeUrl"
        {{ $attributes->merge([
            'class' => '
                text-lg
                sm:text-xl
                font-semibold
                hover:opacity-80
                transition-opacity
                duration-200
            '
        ]) }}
    >
        {{ $headerLogoAltText }}
    </x-everest::link>
@endif
