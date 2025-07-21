<section class="hero-banner bg-gradient-to-r relative bg-[#FAFAFA] text-black py-20 lg:py-32 -mt-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col gap-4 lg:flex-row-reverse items-center justify-between">
            <!-- Bagian gambar -->
            <div class="w-full lg:w-1/2 flex justify-items-end ">
                @php
                    $images = $currentScheduledConference->getMedia('everest-header');
                    $imageUrls = [];
                    
                    foreach ($images as $image) {
                        $imageUrls[] = $image->getAvailableUrl(['thumb', 'thumb-xl']); // Menyimpan URL ukuran 'thumb'
                    }
                @endphp
                <div class="grid gap-4 {{ count($imageUrls) > 1 ? 'grid-cols-2' : 'grid-cols-1' }} mb-4">
                    @if(count($imageUrls) > 0)
                        @foreach($imageUrls as $index => $url)
                            @if($index < 2)
                                <div class="rounded-lg overflow-hidden shadow-sm"> 
                                    <img src="{{ $url }}" alt="Conference Image {{ $index + 1 }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                        @endforeach
                        
                        @if(count($imageUrls) == 3)
                            <div class="col-span-2 flex justify-center">
                                <div class="w-1/2 rounded-lg overflow-hidden shadow-sm"> 
                                    <img src="{{ $imageUrls[2] }}" alt="Conference Image 3" class="w-full h-full object-cover">
                                </div>
                            </div>
                        @elseif(count($imageUrls) == 4)
                            <div class="col-span-2 grid grid-cols-2 gap-4">
                                <div class="rounded-lg overflow-hidden shadow-sm"> 
                                    <img src="{{ $imageUrls[2] }}" alt="Conference Image 3" class="w-full h-full object-cover">
                                </div>
                                <div class="rounded-lg overflow-hidden shadow-sm"> 
                                    <img src="{{ $imageUrls[3] }}" alt="Conference Image 4" class="w-full h-full object-cover">
                                </div>
                            </div>
                        @endif
                        @else
                       
                        <div class="rounded-lg overflow-hidden shadow-sm bg-gradient-to-r from-gray-300 to-gray-400 w-full sm:w-[752px] sm:h-[286.17px] aspect-[752/286.17] flex items-center justify-center">
                            <span class="text-gray-500 text-xl">Default Image</span>
                        </div>
                        

                    @endif
                </div>
            </div>

            <div class="w-full lg:w-1/2 mb-10 lg:mb-0">
                <h1 class="font-bold text-2xl lg:text-6xl tracking-tight mb-8 drop-shadow-lg">{{ $currentScheduledConference->title }}</h1>
                <div class="flex flex-col space-y-4 mb-8">
                    @if($currentScheduledConference->date_start || $currentScheduledConference->date_end)
                        <div class="flex items-center">
                            <span class="icon-banner mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <div>
                                @if($currentScheduledConference->date_start)
                                    @if($currentScheduledConference->date_end && $currentScheduledConference->date_start->format(Setting::get('format_date')) !== $currentScheduledConference->date_end->format(Setting::get('format_date')))
                                        <span class="font-semibold text-black">{{ $currentScheduledConference->date_start->format(Setting::get('format_date')) }}</span>
                                        <span class="font-semibold text-black"> - {{ $currentScheduledConference->date_end->format(Setting::get('format_date')) }}</span>
                                    @else
                                        <span class="font-semibold text-black">{{ $currentScheduledConference->date_start->format(Setting::get('format_date')) }}</span>
                                    @endif
                                @endif
                                <span class="ml-2 text-sm text-gray-600">Conference Dates</span>
                            </div>
                        </div>
                    @endif
                    
                    <div class="flex items-center">
                        <span class="icon-banner mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        <div>
                            <span class="font-semibold text-black">{{ new Illuminate\Support\HtmlString($currentScheduledConference->getMeta('location') ?? 'To be announced') }}</span>
                            <span class="ml-2 text-sm text-gray-600">Conference Venue</span>
                        </div>
                    </div>
                </div>
                @if($theme->getSetting('banner_buttons'))
                <div class="flex flex-col flex-wrap sm:flex-row gap-4">
                    @foreach($theme->getSetting('banner_buttons') ?? [] as $button)
                        <a 
                            @style([
                                'background-color: ' . data_get($button, 'background_color') => data_get($button, 'background_color'),
                                'color: ' . data_get($button, 'text_color') => data_get($button, 'text_color'), 
                            ])
                            href="{{ data_get($button, 'url') }}" 
                            class="button-banner"
                            >
                            {{ data_get($button, 'text') }}
                        </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
