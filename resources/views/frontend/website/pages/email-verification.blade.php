<x-everest::layouts.main class="min-h-screen bg-gray-50 py-12 px-4">
    <div class="max-w-xl mx-auto">
        <div class="mb-6">
            <x-everest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="text-sm text-gray-500 hover:text-gray-700 transition-colors" />
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-200">
            <div class="flex items-center mb-5 space-x-4">
                <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                    <x-heroicon-s-envelope class="h-6 w-6 icon-banner" />
                    Verify Your Email
                </h1>
                <hr class="flex-grow h-px bg-gray-300 border-0">
            </div>

            <div class="space-y-4 text-gray-600">
                @if (session('success'))
                    <div class="flex items-center bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg">
                        <x-heroicon-s-check-circle class="h-5 w-5 mr-2 text-green-600" />
                        <span>Email verification link sent successfully.</span>
                    </div>
                @endif

                @error('email')
                    <div class="flex items-center bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg">
                        <x-heroicon-o-exclamation-circle class="h-5 w-5 mr-2 text-red-600" />
                        <span>{{ $message }}</span>
                    </div>
                @enderror

                <p class="text-gray-700">
                    Almost there! We've sent a verification email to <b>{{ Str::maskEmail(auth()->user()->email) }}</b>.
                </p>
                <p>You need to verify your email address to log into Leconfe.</p>

                <div class="pt-4">
                    <button wire:click='sendEmailVerificationLink' class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-2.5 button-banner submit text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all"
                        wire:loading.attr="disabled">
                        <span wire:loading class="animate-spin mr-2">
                            <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                        </span>
                        Resend Email
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-everest::layouts.main>
