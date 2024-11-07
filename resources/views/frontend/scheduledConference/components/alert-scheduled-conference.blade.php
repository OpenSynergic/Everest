@props(['scheduledConference'])

@if ($scheduledConference->isArchived())
    <section id="archive-serie" class="max-w-4xl mx-auto px-4 py-2">
        <div role="alert" class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-lg shadow-sm flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span class="text-amber-700 text-sm font-medium flex-1">You are viewing an archived scheduled conference</span>
            
        </div>
    </section>
@elseif($scheduledConference->isUpcoming())
    <section id="upcoming-serie" class="max-w-4xl mx-auto px-4 py-2">
        <div role="alert" class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg shadow-sm flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-blue-700 text-sm font-medium flex-1">You are viewing an upcoming scheduled conference</span>
        </div>
    </section>
@elseif($scheduledConference->isDraft())
    <section id="draft-serie" class="max-w-4xl mx-auto px-4 py-2">
        <div role="alert" class="bg-gray-50 border-l-4 border-gray-500 p-4 rounded-lg shadow-sm flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span class="text-gray-700 text-sm font-medium flex-1">You are viewing a draft scheduled conference</span>
        </div>
    </section>
@endif