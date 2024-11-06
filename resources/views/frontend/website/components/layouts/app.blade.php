@props([
    'title' => null,
])
<x-everest::layouts.base :title="$title">
    <div class="flex h-full min-h-screen flex-col">
        @hook('Frontend::Views::Header')

        {{-- Load Header Layout --}}
        <x-everest::layouts.header />


        <main class="py-3 ">
            {{-- Load Main Layout --}}
            {{ $slot }}
        </main>

        {{-- Load Footer Layout --}}
        <x-everest::layouts.footer />

        @hook('Frontend::Views::Footer')
    </div>
</x-everest::layouts.base>

