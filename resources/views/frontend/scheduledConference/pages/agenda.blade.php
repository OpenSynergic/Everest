@use('App\Models\Enums\RegistrationPaymentState')
@use('App\Facades\Setting')

<x-everest::layouts.main>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="space-y-6">
            <x-everest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" />
        </div>

        <div class="mt-8">
            <div class="flex items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Agenda</h1>
                <div class="flex-grow ml-4 border-t border-gray-300"></div>
            </div>
            
            @if ($isParticipant)
                <p class="mt-4 text-sm text-gray-600">
                    Please select the event below to confirm your attendance.
                </p>
            @endif
            
            <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Session Name</th>
                            @if ($isParticipant)
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($timelines->isEmpty())
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Agenda is empty.
                                </td>
                            </tr>
                        @endif
                        @foreach ($timelines as $timeline)
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4" {!! (!$timeline->canShown() || !$isParticipant) ? "colspan='3'" : "colspan='2'" !!}>
                                    <div class="text-sm font-medium text-gray-900">{{ $timeline->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $timeline->date->format(Setting::get('format_date')) }}</div>
                                    @if ($isParticipant)
                                        @if ($timeline->isOngoing())
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                On going
                                            </span>
                                        @elseif ($timeline->getEarliestTime()->isFuture())
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Not started
                                            </span>
                                        @elseif ($timeline->getLatestTime()->isPast())
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Over
                                            </span>
                                        @endif
                                    @endif
                                </td>
                                @if ($timeline->canShown() && $isParticipant)
                                    <td class="px-6 py-4 text-right whitespace-nowrap text-sm font-medium">
                                        @if ($timeline->canAttend())
                                            @if ($userRegistration->isAttended($timeline))
                                                <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-green-100 text-green-800">
                                                    Confirmed
                                                </span>
                                            @else
                                                <button class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                                                wire:click="attend({{ $timeline->id }}, '{{ static::ATTEND_TYPE_TIMELINE }}')">
                                                    Attend
                                                </button>
                                            @endif
                                        @else
                                            @if ($userRegistration->isAttended($timeline))
                                                <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-green-100 text-green-800">
                                                    Confirmed
                                                </span>
                                            @else
                                                @if ($timeline->getEarliestTime()->isFuture())
                                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-gray-100 text-gray-800">
                                                        Incoming
                                                    </span>
                                                @elseif ($timeline->getEarliestTime()->isPast())
                                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-red-100 text-red-800">
                                                        Expired
                                                    </span>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                @endif
                            </tr>
                            @foreach ($timeline->sessions as $session)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $session->time_span }}
                                        @if ($isParticipant)
                                            @if ($session->isOngoing())
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    On going
                                                </span>
                                            @elseif ($session->isFuture())
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Not Started
                                                </span>
                                            @elseif ($session->isPast())
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    Over
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="font-medium">{{ $session->name }}</div>
                                        <div class="mt-1 text-gray-500">{{ new Illuminate\Support\HtmlString($session->public_details) }}</div>
                                        
                                        @if (!empty($session->details) && $isParticipant)
                                            <div x-data="{ open: false }" class="mt-2">
                                                <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium text-left text-yellow-700 bg-yellow-100 rounded-lg hover:bg-yellow-200 focus:outline-none focus-visible:ring focus-visible:ring-yellow-500 focus-visible:ring-opacity-50">
                                                    <span class="flex items-center">
                                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                                        Participant Information
                                                    </span>
                                                    <svg class="w-5 h-5 transform transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="mt-2 p-4 bg-yellow-50 rounded-lg">
                                                    {{ new Illuminate\Support\HtmlString($session->details) }}
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    @if ($session->require_attendance && !$timeline->isRequireAttendance() && $isParticipant)
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if ($session->isOngoing())
                                                @if ($userRegistration->isAttended($session))
                                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-green-100 text-green-800">
                                                        Confirmed
                                                    </span>
                                                @else
                                                    <button class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                                                    wire:click="attend({{ $session->id }}, '{{ static::ATTEND_TYPE_SESSION }}')">
                                                        Attend
                                                    </button>
                                                @endif
                                            @else
                                                @if ($session->isFuture())
                                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-gray-100 text-gray-800">
                                                        Upcoming
                                                    </span>
                                                @elseif ($session->isPast())
                                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-red-100 text-red-800">
                                                        Expired
                                                    </span>
                                                @endif
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- modal --}}
    @if ($timelineData || $sessionData)
        <div x-data="{ open: @entangle('isOpen') }" x-show="open" class="fixed inset-0 flex items-center justify-center z-50">
            <div wire:click="cancel" class="fixed inset-0 bg-gray-800 opacity-75"></div>

            <div x-show="open" x-transition class="bg-white rounded shadow-lg p-6 w-1/3 mx-auto z-50 transform transition-all duration-300 ease-in-out">
                <div class="flex justify-between items-center border-b pb-3">
                    <h2 class="text-lg font-semibold">
                        Attendance Confirmation
                    </h2>
                </div>

                <div class="mt-4">
                    @if ($typeData === self::ATTEND_TYPE_TIMELINE)
                        <p class="text-gray-600">
                            Are you sure you want attend on <strong>{{ $timelineData->name }}</strong> in <strong>{{ $currentScheduledConference->title }}</strong>?
                        </p>
                    @elseif($typeData === self::ATTEND_TYPE_SESSION)
                        <p class="text-gray-600">
                            Are you sure you want attend on <strong>{{ $sessionData->name }}</strong> from <strong>{{ $sessionData->timeline->name }}</strong> in <strong>{{ $currentScheduledConference->title }}</strong>?
                        </p>
                    @else
                        INVALID!
                    @endif

                    @if (!empty($errorMessage))
                        <small class="block text-red-500">
                            *{{ $errorMessage }}
                        </small>
                    @endif
                </div>

                <div class="mt-6 flex justify-end space-x-2 text-sm">
                    <button wire:click="cancel" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300" wire:loading.attr="disabled">
                        Cancel
                    </button>

                    <button wire:click="confirm" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" wire:loading.attr="disabled">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    @endif
</x-everest::layouts.main>
