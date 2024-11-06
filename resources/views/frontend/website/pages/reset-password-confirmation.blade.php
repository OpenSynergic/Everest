<x-everest::layouts.main class="min-h-screen bg-gray-50/50 py-16 px-4">
 <div class="max-w-lg mx-auto">
    <div class="mb-8">
        <x-everest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="text-sm" />
    </div>

    <div class="bg-white rounded-lg shadow-sm p-8">
        <div class="flex items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">{{ __('general.reset_password') }}</h1>
            <div class="flex-grow ml-4">
                <div class="h-0.5 bg-gray-100"></div>
            </div>
        </div>

        @if(!$success)
            <form wire:submit='submit' class="space-y-6">
                <p class="text-gray-600">
                    {{ __('general.enter_password_to_update') }}
                </p>

                <div class="space-y-4">
                    <div class="form-control">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('general.new_password') }}
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input 
                            type="password"
                            name="password"
                            class="w-full px-4 py-2 border border-gray-200 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            wire:model="password"
                            required
                        />
                        @error('password')
                            <div class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('general.confirm_password') }}
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input 
                            type="password"
                            name="password_confirmation"
                            class="w-full px-4 py-2 border border-gray-200 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            wire:model="password_confirmation"
                            required
                        />
                        @error('password_confirmation')
                            <div class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="pt-2">
                    <button 
                        type="submit"
                        class="inline-flex items-center px-4 py-2 button-banner submit text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition"
                        wire:loading.attr="disabled"
                    >
                        <span class="w-4 h-4 mr-2" wire:loading>
                            <svg class="animate-spin" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                            </svg>
                        </span>
                        {{ __('general.submit') }}
                    </button>
                </div>
            </form>
        @else
            <div class="space-y-6">
                <p class="text-gray-600">
                    {{ __('general.reset_password_update_success') }}
                </p>
                <x-everest::link 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition"
                    :href="app()->getLoginUrl()"
                >
                    {{ __('general.login') }}
                </x-everest::link>
            </div>
        @endif
    </div>
</div>
</x-everest::layouts.main>