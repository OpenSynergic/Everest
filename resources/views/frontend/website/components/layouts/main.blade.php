@props([
    'sidebars' => \App\Facades\SidebarFacade::get(),
])

<div>
    <div>
        {{ $slot }}
    </div>

    @if ($sidebars->isNotEmpty())
        <aside class="lg:col-span-3">
            <x-website::layouts.sidebar :sidebars="$sidebars"/>
        </aside>
    @endif
</div>