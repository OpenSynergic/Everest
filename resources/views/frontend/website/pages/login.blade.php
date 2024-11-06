<x-everest::layouts.main class="min-h-screen bg-gray-50">
    <div class="max-w-md mx-auto px-4 py-8">
        <div class="mb-6">
            <x-everest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="text-sm text-gray-600" />
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center mb-6">
                <h1 class="text-xl font-semibold text-gray-900 min-w-fit pr-4">{{ __('general.login') }}</h1>
                <div class="flex-grow h-px bg-gray-200"></div>
            </div>

            <form wire:submit='login' class="space-y-4">
                @error('throttle')
                    <div class="p-3 bg-red-50 text-red-700 text-sm rounded">
                        {{ $message }}
                    </div>
                @enderror

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('general.email') }} <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-primary-200 focus:border-primary-400" 
                        wire:model="email" 
                        required
                    />
                    @error('email')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('general.password') }} <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-primary-200 focus:border-primary-400" 
                        wire:model="password" 
                        required 
                    />
                    @error('password')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input 
                            type="checkbox" 
                            wire:model='remember' 
                            class="text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                        />
                        <span class="ml-2 text-sm text-gray-700">{{ __('general.remember_me') }}</span>
                    </label>
                    <x-everest::link :href="$resetPasswordUrl" class="text-sm text-primary-600 hover:text-blue-600">
                        {{ __('general.forgot_password_question') }}
                    </x-everest::link>
                </div>

                <div class="flex gap-3 pt-4">
                    <button 
                        type="submit" 
                        class="px-4 py-2 button-banner submit text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" 
                        wire:loading.attr="disabled"
                    >
                        <span class="loading loading-spinner loading-xs" wire:loading></span>
                        {{ __('general.login') }}
                    </button>
                    @if($registerUrl)
                        <x-everest::link 
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" 
                            :href="$registerUrl"
                        >
                            {{ __('general.register') }}
                        </x-everest::link>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-everest::layouts.main>