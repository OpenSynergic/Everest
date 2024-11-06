@props([
    'sidebars' => \App\Facades\SidebarFacade::get(),
])

<div>
    <div>
        {{ $slot }}
    </div>
</div>