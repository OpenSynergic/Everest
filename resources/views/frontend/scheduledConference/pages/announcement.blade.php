<x-everest::layouts.main>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <x-everest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" />
        </div>
      
            <div class="p-3 space-y-4">
                <header class="space-y-2">
                    <h1 class="text-3xl font-extrabold text-gray-900 ">{{ $announcement->title }}</h1>
                </header>

                @if ($announcement->hasMedia('featured_image'))
                    <div class="relative h-64 overflow-hidden rounded-lg">
                        <img class="object-cover w-full h-full"
                            src="{{ $announcement->getFirstMedia('featured_image')->getAvailableUrl(['thumb']) }}"
                            alt="{{ $announcement->title }}">
                    </div>
                @endif

                <div class="prose  max-w-none">
                    {{ new Illuminate\Support\HtmlString($this->announcement->getMeta('content')) }}
                </div>
            </div>
       
    </div>
</x-everest::layouts.main>