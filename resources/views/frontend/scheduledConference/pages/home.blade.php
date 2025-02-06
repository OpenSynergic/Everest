<x-everest::layouts.main>

    <x-everest::layouts.banner></x-everest::layouts.banner>

    <div class="space-y-8">

        <section class="">
            <div class="flex flex-col lg:flex-row gap-8 items-start">
                @if ($currentScheduledConference->hasMedia('cover'))
                    <div class="cf-cover">
                        <img class="h-full"
                            src="{{ $currentScheduledConference->getFirstMedia('cover')->getAvailableUrl(['thumb', 'thumb-xl']) }}"
                            alt="{{ $currentScheduledConference->title }}" />
                    </div>
                @endif

                @php
                    $layouts = App\Facades\Plugin::getPlugin('Everest')->getSetting('layouts');
                @endphp

                <div class="prose prose-li: max-w-none w-full">
                    @if ($layouts)
                        @foreach ($layouts as $layout)
                            <div class="layout-section">
                                {{ new Illuminate\Support\HtmlString($layout['data']['about']) }}
                            </div>
                        @endforeach

                    @endif
                </div>

                @if ($currentScheduledConference->getMeta('additional_content'))
                    <div class="prose max-w-none">
                        {{ new Illuminate\Support\HtmlString($currentScheduledConference->getMeta('additional_content')) }}
                    </div>
                @endif
            </div>
        </section>

        @if ($currentScheduledConference?->speakers->isNotEmpty())
            <section id="speakers">
                <div class="container mx-auto w-full px-4 max-w-7xl">
                    <div class="space-y-24">
                        @foreach ($currentScheduledConference->speakerRoles as $role)
                            @if ($role->speakers->isNotEmpty())
                                <div class="flex flex-col items-center">
                                    <h3 class="text-4xl font-bold text-gray-800 mb-16 text-center">{{ $role->name }}
                                    </h3>
                                    <div class="flex flex-wrap justify-center gap-12">
                                        @foreach ($role->speakers as $speaker)
                                            <div class="flex flex-col items-center text-center max-w-xs p-6">
                                                <img
                                                    class="h-40 w-40 object-cover mx-auto border-4 border-gray-200 shadow-sm rounded-full"
                                                    src="{{ $speaker->getFilamentAvatarUrl() }}"
                                                    alt="{{ $speaker->fullName }}"
                                                />
                                                <div class="mt-6 w-full">
                                                    <h4 class="text-2xl font-bold text-gray-900 truncate">
                                                        {{ $speaker->fullName }}</h4>

                                                    @if ($speaker->getMeta('affiliation'))
                                                        <p class="text-lg text-gray-600 mt-2 truncate">
                                                            {{ $speaker->getMeta('affiliation') }}</p>
                                                    @endif
                                                    @if($speaker->getMeta('scopus_url') || $speaker->getMeta('google_scholar_url') || $speaker->getMeta('orcid_url'))
                                                        <div class="cf-committee-scholar flex justify-center items-center gap-3 mt-3">
                                                            @if($speaker->getMeta('orcid_url'))
                                                                <a href="{{ $speaker->getMeta('orcid_url') }}" target="_blank">
                                                                    <x-academicon-orcid class="w-6 h-6 text-[#A6CE39]" />
                                                                </a>
                                                            @endif
                                                            @if($speaker->getMeta('google_scholar_url'))
                                                                <a href="{{ $speaker->getMeta('google_scholar_url') }}" target="_blank">
                                                                    <x-academicon-google-scholar class="w-6 h-6 text-[#4285F4]" />
                                                                </a>
                                                            @endif
                                                            @if($speaker->getMeta('scopus_url'))
                                                                <a href="{{ $speaker->getMeta('scopus_url') }}" target="_blank">
                                                                    <x-academicon-scopus class="w-6 h-6 text-[#e9711c]" />
                                                                </a>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    @if ($speaker->getMeta('bio'))
                                                        <p class="text-gray-600 text-base line-clamp-3 mt-4">
                                                            {{ $speaker->getMeta('bio') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($sponsorLevels->isNotEmpty() || $sponsorsWithoutLevel->isNotEmpty())
            <section id="sponsors" class="section-background py-20">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
                    <!-- Section Header -->
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Sponsors</h2>
                        <p class="text-gray-600 max-w-2xl mx-auto mt-4">Thank you to all our amazing sponsors who make our work possible</p>
                    </div>

                    <!-- Sponsors Without Level -->
                    @if ($sponsorsWithoutLevel->isNotEmpty())
                        <div class="flex flex-col items-center justify-center w-full mt-16">
                            <div class="flex flex-wrap items-center justify-center gap-6 w-full">
                                @foreach ($sponsorsWithoutLevel as $sponsor)
                                    @if (!$sponsor->getFirstMedia('logo'))
                                        @continue
                                    @endif
                                    <div class="flex items-center justify-center p-3 transition duration-300 ease-in-out">
                                        <img
                                            style="
                                                image-rendering: auto;
                                                width: auto;
                                                height: auto;
                                                object-fit: contain;
                                                max-width: 200px;
                                            "
                                            src="{{ $sponsor->getFirstMediaUrl('logo') }}"
                                            alt="{{ $sponsor->name }}"
                                            loading="lazy"
                                        />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Sponsor Levels -->
                    @foreach ($sponsorLevels as $sponsorLevel)
                        @if ($sponsorLevel->stakeholders->isNotEmpty())
                            <div class="mt-16">
                                <h3 class="text-2xl font-medium text-gray-900 text-center mb-8">{{ $sponsorLevel->name }}</h3>
                                <div class="flex flex-col items-center justify-center w-full">
                                    <div class="flex flex-wrap items-center justify-center gap-6 w-full">
                                        @foreach ($sponsorLevel->stakeholders as $sponsor)
                                            @if (!$sponsor->getFirstMedia('logo'))
                                                @continue
                                            @endif
                                            <div class="flex items-center justify-center p-3 transition duration-300 ease-in-out">
                                                <img
                                                    style="
                                                        image-rendering: auto;
                                                        width: auto;
                                                        height: auto;
                                                        object-fit: contain;
                                                        max-width: 200px;
                                                    "
                                                    src="{{ $sponsor->getFirstMediaUrl('logo') }}"
                                                    alt="{{ $sponsor->name }}"
                                                    loading="lazy"
                                                />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </section>
        @endif

        @if ($partners->isNotEmpty())
        <section class="py-20">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Partners</h2>
                </div>

                <!-- Partners Grid -->
                <div class="flex flex-col items-center justify-center w-full">
                    <div class="flex flex-wrap items-center justify-center gap-6 w-full">
                        @foreach ($partners as $partner)
                            @if (!$partner->getFirstMedia('logo'))
                                @continue
                            @endif
                            <div class="flex items-center justify-center p-3 transition duration-300 ease-in-out">
                                <!-- Partner Logo -->
                                <img
                                    style="
                                        image-rendering: auto;
                                        width: auto;
                                        height: auto;
                                        object-fit: contain;
                                        max-width: 200px;
                                    "
                                    src="{{ $partner->getFirstMediaUrl('logo') }}"
                                    alt="{{ $partner->name }}"
                                    loading="lazy"
                                />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif

        @if ($currentScheduledConference)
            <section class="section-background py-24">
                <div class="container mx-auto px-4 max-w-7xl">
                    <!-- Section Header -->
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                            Latest News
                        </h2>
                    </div>

                    @if ($currentScheduledConference->announcements()
                    ->where(function ($query) {
                        $query->where('expires_at', '>', now()->startOfDay())
                              ->orWhereNull('expires_at');
                    })->count() > 0)

                        <!-- Announcements Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($currentScheduledConference->announcements()
                            ->where(function ($query) {
                                $query->where('expires_at', '>', now()->startOfDay())
                                    ->orWhereNull('expires_at');
                            })
                            ->orderBy('created_at', 'DESC')
                            ->take(3)
                            ->get() as $announcement)
                            
                                @php
                                    $content = $announcement->getMeta('content');
                                    preg_match('/<img[^>]+src="([^">]+)"/', $content, $matches);
                                    $imageUrl = $matches[1] ?? '';
                                @endphp

                                <article
                                    class="group relative bg-white rounded-3xl shadow-lg hover:shadow-xl transition-all duration-500 ease-in-out transform hover:-translate-y-1">
                                    <!-- Image Section -->
                                    <div class="relative h-64 rounded-t-3xl overflow-hidden">
                                        <div class="absolute inset-0 bg-gradient-to-b from-black/10 to-black/30 z-10">
                                        </div>


                                        @if($imageUrl)
                                            <img src="{{ $imageUrl }}" alt="{{ $announcement->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                                <span class="text-gray-500 text-xl">No Image Available</span>
                                            </div>
                                        @endif
                                        <!-- Date Badge -->
                                        <div class="absolute top-4 left-4 z-20">
                                            <div
                                                class="flex items-center space-x-1 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full">
                                                <svg class="color-latest w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span class="text-sm font-medium text-gray-800">
                                                    {{ $announcement->created_at->format(Setting::get('format_date')) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Content Section -->
                                    <div class="relative p-8 bg-white/80 backdrop-blur-sm rounded-b-3xl">
                                        <h3
                                            class="text-xl font-bold text-gray-900 mb-4 line-clamp-2 transition-colors duration-300">
                                            <a href="{{ route('livewirePageGroup.scheduledConference.pages.announcement-page', ['announcement' => $announcement->id]) }}"
                                                class="block hover:text-blue-600">
                                                {{ $announcement->title }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                            {{ $announcement->getMeta('summary') }}
                                        </p>
                                        <div class="flex items-center justify-between">
                                            <a href="{{ route('livewirePageGroup.scheduledConference.pages.announcement-page', ['announcement' => $announcement->id]) }}"
                                                class="inline-flex items-center group/link">
                                                <span
                                                    class="text-sm font-semibold color-latest group-hover/link:color-latest transition-colors duration-200">
                                                    Read full announcement
                                                </span>
                                                <svg class="w-5 h-5 ml-2 color-latest transform transition-transform duration-300 group-hover/link:translate-x-1"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <!-- View All Link -->
                        <div class="mt-16 text-center">
                            <a href="{{ route(App\Frontend\ScheduledConference\Pages\Announcements::getRouteName('scheduledConference')) }}"
                                class="button-banner submit inline-flex items-center px-8 py-3 text-base font-medium text-white rounded-full hover:opacity-90 transition-opacity">
                                View All Updates
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16 px-4">
                            <div class="max-w-md mx-auto">
                                <svg class="mx-auto h-20 w-20 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                                <h3 class="mt-4 text-xl font-semibold text-gray-900">No Announcements Yet</h3>
                                <p class="mt-2 text-gray-600">Stay tuned! New announcements will be posted here as they
                                    become available.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @endif

    </div>
</x-everest::layouts.main>
