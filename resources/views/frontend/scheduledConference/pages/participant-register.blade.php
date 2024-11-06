@use('Illuminate\Support\Str')
@use('Carbon\Carbon')
<x-everest::layouts.main>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="space-y-6">
        <x-everest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" />
    </div>
    @if ($registrationOpen)
        <div class="bg-white shadow-md rounded-lg overflow-hidden mt-6">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h1 class="text-2xl font-semibold text-gray-800">{{ __('general.participant_registration') }}</h1>
            </div>
            @if (!$isSubmit)
                <form wire:submit='register' class="p-6 space-y-6">
                    <!-- Registration Types Table -->
                    <div>
                        <h2 class="text-lg font-semibold mb-3 text-gray-700">{{ __('general.registration_type') }}</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('general.registration_type') }}</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('general.quota') }}</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('general.level') }}</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('general.cost') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($registrationTypeList as $index => $type)
                                        @if ($type->active)
                                            <tr>
                                                <td class="px-4 py-3">
                                                    <div class="text-sm font-medium text-gray-900">{{ $type->type }}</div>
                                                    <div class="text-xs text-gray-500">{{ $type->getMeta('description') }}</div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="text-sm text-gray-900">{{ $type->getPaidParticipantCount() }}/{{ $type->quota }}</div>
                                                    @if (!$type->isOpen())
                                                        <div class="text-xs text-red-500">{{ __('general.closed') }}</div>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="text-sm text-gray-900">
                                                        {{ 
                                                            match ($type->level) {
                                                                App\Models\RegistrationType::LEVEL_PARTICIPANT => 'Participant',
                                                                App\Models\RegistrationType::LEVEL_AUTHOR => 'Author',
                                                                default => 'None',
                                                            }    
                                                        }}
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    @php
                                                        $typeCostFormatted = moneyOrFree($type->cost, $type->currency, true);
                                                        $elementID = Str::slug($type->type)
                                                    @endphp
                                                    <div class="flex items-center gap-2">
                                                        @if($isLogged)
                                                            @if ($type->level !== App\Models\RegistrationType::LEVEL_AUTHOR)
                                                                <input class="form-radio h-4 w-4 text-indigo-600" id="{{ $elementID }}" type="radio" wire:model="type" value="{{ $type->id }}" @disabled(!$type->isOpen())>
                                                            @else
                                                                <span class="text-gray-400" title="This registration type is for information only">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                                                    </svg>
                                                                </span>
                                                            @endif
                                                        @endif
                                                        <label class="text-sm text-gray-700 @if($type->isOpen() && $type->level !== App\Models\RegistrationType::LEVEL_AUTHOR) cursor-pointer @endif" for="{{ $elementID }}">
                                                            {{ $typeCostFormatted }}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @error('type')
                            <div class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- User Information -->
                    @if ($isLogged)
                        <div>
                            <h2 class="text-lg font-semibold mb-3 text-gray-700">{{ __('general.this_is_your_detailed_account_information') }}</h2>
                            <div class="bg-gray-50 p-4 rounded-md">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">{{ __('general.name') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $userModel->full_name }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">{{ __('general.email') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $userModel->email }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">{{ __('general.affiliation') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $userModel->getMeta('affiliation') ?? '-' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">{{ __('general.phone') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $userModel->getMeta('phone') ?? '-' }}</dd>
                                    </div>
                                    @if($userCountry)
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">{{ __('general.country') }}</dt>
                                            <dd class="mt-1 text-sm text-gray-900">{{ $userCountry->flag . ' ' . $userCountry->name }}</dd>
                                        </div>
                                    @endif
                                </dl>
                            </div>
                            <p class="mt-2 text-sm text-gray-600">{{ __('general.if_you_feel_this_is_not_your_account_please_log_out_and_use_your_account') }}</p>
                        </div>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        {!! __('general.currently_not_logged_in', ['url' => app()->getLoginUrl() ]) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" @class([
                            'px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500',
                            'opacity-50 cursor-not-allowed' => !$isLogged || $registrationTypeList->isEmpty(),
                        ]) x-data x-on:click="window.scrollTo(0, 0)" wire:loading.attr="disabled">
                            <span class="loading loading-spinner loading-xs" wire:loading></span>
                            {{ __('general.register_now') }}
                        </button>
                    </div>
                </form>
            @else
                <!-- Registration confirmation section -->
                <div class="p-6 space-y-6">
                    <div class="bg-green-50 border-l-4 border-green-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">
                                    {{ __('general.these_are_your_registration_details') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('general.registration_details') }}</h3>
                        </div>
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">{{ __('general.type') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $registrationType->type }}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">{{ __('general.description') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $registrationType->getMeta('description') ?? '-' }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">{{ __('general.cost') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ moneyOrFree($registrationType->cost, $registrationType->currency, true) }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <p class="text-sm text-gray-600">
                        {!! __('general.is_mistake_you_can_cancel') !!}
                    </p>

                    <div class="flex justify-end space-x-3">
                        <button type="button" class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="cancel" x-data x-on:click="window.scrollTo(0, 0)">
                            {{ __('general.cancel') }}
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm" wire:click="confirm" wire:loading.attr="disabled">
                            <span class="loading loading-spinner loading-xs" wire:loading></span>
                            {{ __('general.confirm') }}
                        </button>
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="w-full ml-4 my-6">
            <p class="text-lg">
                {{ __('general.registration_are_closed') }}
            </p>
        </div>
    @endif
    
</x-everest::layouts.main>
