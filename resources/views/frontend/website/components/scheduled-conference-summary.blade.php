@props(['scheduledConference', 'header' => 'h2'])
<div class="scheduled-conference-summary sm:flex gap-4">
    @if($scheduledConference->hasThumbnail())
    <div class="cover max-w-40">
        <img src="{{ $scheduledConference->getThumbnailUrl() }}" alt="{{ $scheduledConference->title }}">
    </div>
    @endif
    <div class="information flex-1 space-y-2">
        @if ($scheduledConference->date_start)
            <div class="flex items-center text-sm gap-2 text-gray-600">
                <x-heroicon-c-calendar-days class="h-5 w-5" />
                <span>
                    {{ $scheduledConference->date_start?->format(Setting::get('format_date')) }}
                </span>
            </div>
        @endif

        <{{ $header }} class="">
            <a href="{{ $scheduledConference->getHomeUrl() }}"
                class="serie-name link link-primary link-hover font-bold">{{ $scheduledConference->title }}</a>
        </{{ $header }}>

        @if ($scheduledConference->getMeta('description'))
            <p class="serie-description text-sm">{{ $scheduledConference->getMeta('description') }}</p>
        @endif

        <a href="{{ $scheduledConference->getHomeUrl() }}" class="btn btn-primary btn-sm">Check Conference</a>
    </div>
</div>
