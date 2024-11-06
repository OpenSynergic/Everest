@php
    $primaryNavigationItems = app()->getNavigationItems('primary-navigation-menu');
    $userNavigationMenu = app()->getNavigationItems('user-navigation-menu');
@endphp

<!-- Top Navigation Bar -->
<div class="navbar-publisher bg-gradient-to-r from-[#48CFCB] to-[#229799] shadow z-[51] text-white sticky top-0 hidden w-full">
    <div class="container mx-auto px-4 lg:px-8 h-16 flex items-center justify-between">
        <!-- Logo Section -->
        <div class="flex items-center gap-x-4">
            <x-everest::logo 
                :headerLogo="app()->getSite()->getFirstMedia('logo')?->getAvailableUrl(['thumb', 'thumb-xl'])" 
                :headerLogoAltText="app()->getSite()->getMeta('name')" 
                :homeUrl="url('/')" 
                class="h-8 w-auto"
            />
        </div>
        
        <!-- User Navigation -->
        <div class="hidden lg:flex items-center gap-x-6">
            <x-everest::navigation-menu 
                :items="$userNavigationMenu" 
                class="text-white hover:text-gray-200 transition-colors duration-200" 
            />
        </div>
    </div>
</div>
    
@if(app()->getCurrentConference() || app()->getCurrentScheduledConference())
    <div id="navbar" class="sticky-navbar top-0 shadow z-50 w-full text-white transition-all duration-300">
        <div class="navbar-everest navbar container mx-auto px-4 lg:px-8 h-16">
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
                    <x-everest::navigation-menu 
                        :items="$userNavigationMenu" 
                        class="flex items-center gap-x-6 text-white hover:text-gray-200 transition-colors duration-200" 
                    />   
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