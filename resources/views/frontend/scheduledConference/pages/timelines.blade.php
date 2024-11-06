<x-everest::layouts.main>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-1">
            <x-everest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" />
        </div>
        <div class="p-3">
            <div class="flex mb-5 items-center space-x-4">
                <h1 class="text-2xl font-bold text-gray-800">Event Timelines</h1>
            </div>
            @if($timelines->isNotEmpty())
                <ol class="relative border-l border-gray-200">
                    @foreach ($timelines as $timeline)
                        <li class="mb-10 ml-6 last:mb-0 transition-transform duration-200">
                            <div class="absolute w-4 h-4 bg-gray-200 rounded-full -left-2 border border-white"></div>
                            <time class="mb-1 text-sm font-normal leading-none text-gray-500">{{ $timeline->date->format(Setting::get('format_date')) }}</time>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $timeline->name }}</h3>
                            <p class="text-base font-normal text-gray-600">
                                {{ $timeline->description }}
                            </p>
                        </li>
                    @endforeach
                </ol>
            @else
                <div class="text-center py-6">
                    <p class="text-lg text-gray-500">No timelines yet.</p>
                </div>
            @endif
        </div>
    </div>
</x-everest::layouts.main>
