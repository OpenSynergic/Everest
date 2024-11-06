@use('App\Models\Enums\RegistrationPaymentState')

<x-everest::layouts.main>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if ($isLogged)
            <!-- Breadcrumbs -->
            <div class="mb-8">
                <x-everest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" />
            </div>

            @if ($userRegistration)
                <!-- Main Content -->
                <div class="bg-white rounded-lg shadow-sm p-6 sm:p-8">
                    <!-- Header Section -->
                    <div class="flex items-center gap-4 mb-8 border-b pb-4">
                        <h1 class="text-xl sm:text-2xl font-bold text-gray-900">
                            {{ __('general.registration_status') }}
                        </h1>
                    </div>

                    <!-- Registration Details -->
                    <div class="space-y-8">
                        <!-- Info Text -->
                        <p class="text-gray-600">
                            {{ __('general.this_your_pacticipant_retistration_details') }}
                        </p>

                        <!-- Details Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <tbody class="divide-y divide-gray-100">
                                    <!-- Status -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 text-sm font-medium text-gray-700 w-1/4">
                                            {{ __('general.status') }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-500">:</td>
                                        <td class="py-3 text-sm">
                                            <span @class([
                                                'px-3 py-1 rounded-full text-sm font-medium',
                                                'bg-green-100 text-green-800' => $userRegistration->getState() === RegistrationPaymentState::Paid->value,
                                                'bg-yellow-100 text-yellow-800' => $userRegistration->getState() === RegistrationPaymentState::Unpaid->value,
                                                'bg-red-100 text-red-800' => $userRegistration->trashed(),
                                            ])>
                                                {{ $userRegistration->trashed() ? 'Failed' : $userRegistration->getState() }}
                                            </span>
                                        </td>
                                    </tr>

                                    <!-- Type -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 text-sm font-medium text-gray-700">
                                            {{ __('general.type') }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-500">:</td>
                                        <td class="py-3 text-sm font-semibold text-gray-900">
                                            {{ $userRegistration->registrationPayment->name }}
                                        </td>
                                    </tr>

                                    <!-- Level -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 text-sm font-medium text-gray-700">
                                            {{ __('general.level') }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-500">:</td>
                                        <td class="py-3 text-sm text-gray-900">
                                            {{ 
                                                match ($userRegistration->registrationPayment->level) {
                                                    App\Models\RegistrationType::LEVEL_PARTICIPANT => 'Participant',
                                                    App\Models\RegistrationType::LEVEL_AUTHOR => 'Author',
                                                    default => 'None',
                                                }    
                                            }}
                                        </td>
                                    </tr>

                                    <!-- Description -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 text-sm font-medium text-gray-700">
                                            {{ __('general.description') }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-500">:</td>
                                        <td class="py-3 text-sm text-gray-900">
                                            {!! $userRegistration->registrationPayment->description !!}
                                        </td>
                                    </tr>

                                    <!-- Cost -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 text-sm font-medium text-gray-700">
                                            {{ __('general.cost') }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-500">:</td>
                                        <td class="py-3 text-sm font-semibold text-gray-900">
                                            @php
                                                $userRegistrationCostFormatted = moneyOrFree($userRegistration->registrationPayment->cost, $userRegistration->registrationPayment->currency, true);
                                            @endphp
                                            {{ $userRegistrationCostFormatted }}
                                        </td>
                                    </tr>

                                    <!-- Registration Date -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 text-sm font-medium text-gray-700">
                                            {{ __('general.registration_date') }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-500">:</td>
                                        <td class="py-3 text-sm text-gray-900">
                                            {{ $userRegistration->created_at->format(Setting::get('format_date')) }}
                                        </td>
                                    </tr>

                                    <!-- Payment Date (if applicable) -->
                                    @if ($userRegistration->getState() === RegistrationPaymentState::Paid->value && $userRegistration->registrationType->currency !== 'free')
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 text-sm font-medium text-gray-700">
                                                {{ __('general.payment_date') }}
                                            </td>
                                            <td class="py-3 px-4 text-gray-500">:</td>
                                            <td class="py-3 text-sm text-gray-900">
                                                {{ $userRegistration->registrationPayment->paid_at->format(Setting::get('format_date')) }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-6">
                            @if($userRegistration->getState() === RegistrationPaymentState::Paid->value && $userRegistration->registrationPayment->level === App\Models\RegistrationType::LEVEL_AUTHOR && !$userRegistration->trashed())
                                <a href="{{ App\Panel\ScheduledConference\Resources\SubmissionResource::getUrl('index', panel: App\Providers\PanelProvider::PANEL_SCHEDULED_CONFERENCE) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-colors duration-150">
                                    {{ __('general.submission') }}
                                </a>
                            @elseif($userRegistration->getState() === RegistrationPaymentState::Unpaid->value || $userRegistration->trashed())
                                <div x-data="{ isCancelling: false }">
                                    <button 
                                        x-show="!isCancelling" 
                                        x-on:click="isCancelling = true"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition-colors duration-150"
                                    >
                                        {{ __('general.cancel_registration') }}
                                    </button>

                                    <div class="space-y-4" x-show="isCancelling" x-cloak>
                                        <p class="text-gray-700">
                                            {{ __('general.are_you_sure_want_to_cancel_registration') }}
                                        </p>
                                        <div class="flex gap-3">
                                            <button 
                                                class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 transition-colors duration-150"
                                                x-on:click="isCancelling = false"
                                            >
                                                {{ __('general.no') }}
                                            </button>
                                            <button 
                                                class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition-colors duration-150"
                                                wire:click="cancel"
                                            >
                                                {{ __('general.yes') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Payment Details Accordion -->
                        @if ($userRegistration->getState() === RegistrationPaymentState::Unpaid->value && !$userRegistration->trashed() && !empty($paymentDetails))
                            <div class="mt-8 space-y-4">
                                @foreach($paymentDetails as $paymentTitle => $paymentDescription)
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <div class="collapse-arrow" x-data="{ open: $index === 0 }">
                                            <button 
                                                class="flex justify-between items-center w-full px-4 py-3 bg-gray-50 hover:bg-gray-100 transition-colors duration-150"
                                                @click="open = !open"
                                            >
                                                <span class="text-sm font-medium text-gray-900">
                                                    {{ $paymentTitle }}
                                                </span>
                                                <svg class="w-5 h-5 transform transition-transform duration-200" 
                                                     :class="{'rotate-180': open}"
                                                     xmlns="http://www.w3.org/2000/svg" 
                                                     viewBox="0 0 20 20" 
                                                     fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <div 
                                                x-show="open" 
                                                x-collapse 
                                                class="px-4 py-3 bg-white"
                                            >
                                                <div class="prose max-w-none">
                                                    {!! new Illuminate\Support\HtmlString($paymentDescription) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Policies Section -->
                        <div class="space-y-8 mt-8">
                            @if(!empty($currentScheduledConference->getMeta('payment_policy')))
                                <div class="prose max-w-none">
                                    <h2 class="text-xl font-semibold text-gray-900 mb-4">
                                        {{ __('general.payment_policy') }}
                                    </h2>
                                    {!! new Illuminate\Support\HtmlString($currentScheduledConference->getMeta('payment_policy')) !!}
                                </div>
                            @endif

                            @if(!empty($currentScheduledConference->getMeta('registration_policy')))
                                <div class="prose max-w-none">
                                    <h2 class="text-xl font-semibold text-gray-900 mb-4">
                                        {{ __('general.registration_policy') }}
                                    </h2>
                                    {{ new Illuminate\Support\HtmlString($currentScheduledConference->getMeta('registration_policy'))}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @else
            {{ abort(404) }}
        @endif
    </div>
</x-everest::layouts.main>