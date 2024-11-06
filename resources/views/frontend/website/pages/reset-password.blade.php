<x-everest::layouts.main class="min-h-screen bg-gray-50/50 py-16 px-4">
    <div class="max-w-lg mx-auto">
        <div class="mb-8">
            <x-everest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="text-sm text-gray-500 hover:text-gray-700 transition-colors" />
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100/50 backdrop-blur-sm">
            <div class="p-8">
                <div class="flex flex-col space-y-1.5 mb-8">
                    <h1 class="text-2xl font-semibold tracking-tight text-gray-900">{{ __('general.reset_password') }}</h1>
                    <p class="text-sm text-gray-500">
                        {{ __('general.please_enter_email_to_reset_password') }}
                    </p>
                </div>

                @if(!$success)
                    <form wire:submit='submit' class="space-y-6">
                        @error('throttle')
                            <div class="bg-red-50/80 backdrop-blur-sm border border-red-100 text-red-600 text-sm p-4 rounded-xl flex items-start">
                                <svg class="h-5 w-5 mr-2 flex-shrink-0" viewBox="0 0 24 24" fill="none">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M12 7v6M12 17.01l.01-.011" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 flex items-center">
                                {{ __('general.email') }}
                                <span class="text-red-500 ml-0.5">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M21 8L17.4392 9.97822C15.454 11.0811 14.4614 11.6326 13.4102 11.8488C12.4798 12.0401 11.5202 12.0401 10.5898 11.8488C9.53864 11.6326 8.54603 11.0811 6.5608 9.97822L3 8M6.2 19H17.8C18.9201 19 19.4802 19 19.908 18.782C20.2843 18.5903 20.5903 18.2843 20.782 17.908C21 17.4802 21 16.9201 21 15.8V8.2C21 7.0799 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V15.8C3 16.9201 3 17.4802 3.21799 17.908C3.40973 18.2843 3.71569 18.5903 4.09202 18.782C4.51984 19 5.07989 19 6.2 19Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <input 
                                    type="email"
                                    name="email"
                                    class="w-full pl-10 pr-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors"
                                    wire:model="email"
                                    required 
                                    placeholder="Enter your email address"
                                />
                            </div>
                            @error('email')
                                <div class="text-sm text-red-600 flex items-center">
                                    <svg class="h-4 w-4 mr-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <circle cx="12" cy="12" r="10" stroke-width="1.5"/>
                                        <path d="M12 7v6M12 17.01l.01-.011" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 pt-4">
                            <button 
                                type="submit"
                                class="inline-flex justify-center items-center px-5 py-2.5 button-banner submit text-white text-sm font-medium rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-sm hover:shadow"
                                wire:loading.attr="disabled"
                            >
                                <span wire:loading class="mr-2">
                                    <svg class="animate-spin h-4 w-4 text-white" viewBox="0 0 24 24" fill="none">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                    </svg>
                                </span>
                                {{ __('general.reset_password') }}
                            </button>

                            @if($registerUrl)
                                <x-everest::link 
                                    class="inline-flex justify-center items-center px-5 py-2.5 bg-white border border-gray-200 text-sm font-medium rounded-xl text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200"
                                    :href="$registerUrl"
                                >
                                    {{ __('general.register') }}
                                </x-everest::link>
                            @endif
                        </div>
                    </form>
                @else
                    <div class="space-y-6">
                        <div class="bg-green-50/80 backdrop-blur-sm border border-green-100 text-green-700 p-4 rounded-xl flex items-start">
                            <svg class="h-5 w-5 mr-2 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M9 12.75L11.25 15L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="1.5"/>
                            </svg>
                            {{ __('general.reset_password_mail_sent') }}
                        </div>
                        
                        <x-everest::link 
                            class="inline-flex justify-center items-center px-5 py-2.5 bg-white border border-gray-200 text-sm font-medium rounded-xl text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200"
                            :href="app()->getLoginUrl()"
                        >
                            <svg class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ __('general.login') }}
                        </x-everest::link>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-everest::layouts.main>