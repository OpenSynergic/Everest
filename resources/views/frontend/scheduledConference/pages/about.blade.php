<x-everest::layouts.main>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"> 
        <!-- Breadcrumbs Section -->
        <div class="px-4 sm:px-6 lg:px-8 mb-6">
            <x-everest::breadcrumbs 
                :breadcrumbs="$this->getBreadcrumbs()" 
                class="text-sm text-gray-500 hover:text-gray-700" 
            />
        </div>

        <!-- Main Content Section -->
        <div class="px-4 sm:px-6 lg:px-8">
            <!-- Title Section -->
            <div class="flex flex-col sm:flex-row items-center  ml-2">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4 sm:mb-0 sm:mr-8">
                    {{ $this->getTitle() }}
                </h1>
            </div>

            @if ($about)
                <div class="prose max-w-none layout-section" style="--tw-prose-body:#000000">
                    {{ new Illuminate\Support\HtmlString($about) }}
                </div>
            @else
                <div class="bg-gray-100 rounded-lg p-6 text-center">
                    <p class="text-lg text-gray-500">
                        No information provided at this time.
                    </p>
                    <p class="mt-2 text-sm text-gray-400">
                        Check back later for updates.
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-everest::layouts.main>