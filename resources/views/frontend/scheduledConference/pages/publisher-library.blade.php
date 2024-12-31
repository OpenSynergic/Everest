<x-everest::layouts.main>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <x-everest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" />
        </div>
        <div class="p-3 space-y-4">
            <header class="space-y-2">
                <h1 class="text-3xl font-extrabold text-gray-900">{{ $this->getTitle() }}</h1>
            </header>
            <div class="space-y-4">
                @if($publisherLibraries->isNotEmpty())
                    @foreach($publisherLibraries as $media)
                        <div class="hover:shadow-md transition-shadow duration-200 border rounded-lg">
                            <div class="p-0">
                                <a href="{{ route(App\Frontend\ScheduledConference\Pages\PublisherLibraryDownload::getRouteName(), ['media' => $media->uuid]) }}"
                                   class="flex items-center justify-between p-6 group">
                                    <span class="text-lg text-gray-700 group-hover:text-blue-600 transition-colors">
                                        {{ $media->name }}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-600">{{ __('general.no_publisher_library_available') }}</p>
                @endif
            </div>
        </div>
    </div>
</x-everest::layouts.main>
