@php
    $primaryNavigationItems = app()->getNavigationItems('primary-navigation-menu');
    $userNavigationMenu = app()->getNavigationItems('user-navigation-menu');
@endphp

<!-- Top Navigation Bar -->
@if(App\Facades\Plugin::getPlugin('Everest')->getSetting('top_navigation'))
<div class="navbar-publisher bg-gradient-to-r text-black  top-0 w-full font-semibold z-[60]">
    <div class="container mx-auto px-4 lg:px-8 h-16 flex items-center justify-between">
        <!-- Logo Section -->
        <div class="flex items-center gap-x-4 ">
            <x-everest::logo
                :headerLogo="app()->getSite()->getFirstMedia('logo')?->getAvailableUrl(['thumb', 'thumb-xl'])"
                :headerLogoAltText="app()->getSite()->getMeta('name')"
                :homeUrl="url('/')"
                class="text-black h-8 w-auto"
            />
            @if(App\Models\Conference::exists())
                @livewire(App\Livewire\GlobalNavigation::class)
            @endif
        </div>

        <!-- User Navigation -->
        <div class="hidden lg:flex items-center gap-x-6">
            <x-everest::navigation-menu
            :items="$userNavigationMenu"
            class="flex items-center gap-x-6 text-white hover:text-gray-200 transition-colors duration-200"
            />
        </div>
    </div>
</div>
@endif

@if(app()->getCurrentConference() || app()->getCurrentScheduledConference())
    <div id="navbar" class="sticky-navbar top-0 shadow z-50 w-full text-white transition-all duration-300">
        <div class="navbar-everest navbar-custom-everest container mx-auto px-4 lg:px-8 h-16">
            <div class="flex items-center justify-between h-full">
                <!-- Mobile Menu & Logo -->
                <div class="flex items-center gap-x-4">
                    <div class="lg:hidden">
                        <x-everest::navigation-menu-mobile />
                    </div>
                    <x-everest::logo
                        :headerLogo="$headerLogo"
                        class="font-bold h-8 w-auto"
                    />
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex justify-end items-center space-x-3">
                    <x-everest::navigation-menu
                        :items="$primaryNavigationItems"
                        class="flex items-center gap-x-6 text-white hover:text-gray-200 transition-colors duration-200"
                    />

                    @if(!App\Facades\Plugin::getPlugin('Everest')->getSetting('top_navigation'))
                    <x-everest::navigation-menu
                    :items="$userNavigationMenu"
                    class="flex items-center gap-x-6 text-white hover:text-gray-200 transition-colors duration-200"
                    />
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var navbar = document.getElementById('navbar');

        function handleScroll() {
            if (window.scrollY > 0) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        window.addEventListener('scroll', handleScroll);
    });
    </script>
@endif
