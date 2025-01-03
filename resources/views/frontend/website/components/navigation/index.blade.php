@props([
    'items' => [],
])

<nav x-navigation>
    <div class="relative">
        <ul class="navbar-items flex items-center justify-center flex-1 p-1 space-x-1 list-none group">
            @foreach ($items as $key => $item)
                @php($item = new App\Classes\NavigationItem(...$item))

                @if (!$item->hasChildren())
                    <li>
                        <x-website::link
                            class="btn btn-ghost btn-sm rounded-full inline-flex items-center justify-center px-4 transition-colors hover:text-primary-content focus:outline-none disabled:opacity-50 disabled:pointer-events-none group w-max"
                            :href="$item->getUrl()">
                            {{ $item->getLabel() }}
                        </x-website::link>
                    </li>
                @else
                    <x-website::navigation.dropdown.trigger :key="$key" :item="$item" />
                @endif
            @endforeach
        </ul>
    </div>
    <div x-navigation:dropdown
        class="navbar-dropdown absolute -top-2 duration-200 ease-out -translate-x-1/2 translate-y-11 transition-all text-gray-800"
        x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" x-cloak>
        @foreach ($items as $key => $item)
            @php($item = new App\Classes\NavigationItem(...$item))
            @if (!$item->hasChildren())
                @continue
            @endif
            <div class="navbar-dropdown-content" x-navigation:dropdown-content="{{ $key }}">
                <x-website::navigation.dropdown.items :items="$item->getChildren()" />
            </div>
        @endforeach
    </div>
</nav>
