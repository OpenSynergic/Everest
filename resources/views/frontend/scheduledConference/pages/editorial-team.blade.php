<x-everest::layouts.main>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <x-everest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" />
    </div>
    <div class="relative">
        <div class="flex mb-5 space-x-4">
            <h1 class="text-xl font-semibold min-w-fit">{{ $this->getTitle() }}</h1>
            <hr class="w-full h-px my-auto bg-gray-200 border-0 dark:bg-gray-700">
        </div>
        @if ($editorialTeam)
            <div class="prose">
                {{ new Illuminate\Support\HtmlString($editorialTeam) }}
            </div>
        @else
            <div>
                No information provided.
            </div>
        @endif
    </div>
</div>
</x-everest::layouts.main>
