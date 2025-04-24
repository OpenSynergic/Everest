<x-everest::layouts.main>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <x-everest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" />
        </div>
      
        <div class="p-3 space-y-4">
            <div class="grid sm:grid-cols-2 justify-items-start gap-y-8">
                <div id="chair-contact" class="space-y-2">
                    <h2 class="font-bold">{{ __('general.principal_contact') }}</h2>
                    <div class="text-sm">
                        <p>{{ $principal_contact_name }}</p>
                        @if ($principal_contact_affiliation)
                            <p>{{ $principal_contact_affiliation }}</p>
                        @endif
                    </div>
                    @if ($principal_contact_phone)
                        <div class="text-sm">
                            <p class="font-bold">{{ __('general.phone') }}</p>
                            <p>
                                {{ $principal_contact_phone }}
                            </p>
                        </div>
                    @endif
                    @if ($principal_contact_email)
                        <div class="text-sm">
                            <p class="font-bold">{{ __('general.email') }}</p>
                            <p>
                                {{ $principal_contact_email }}
                            </p>
                        </div>
                    @endif
                </div>
                <div id="support-contact" class="space-y-2">
                    <h2 class="font-bold">{{ __('general.technical_support_contact') }}</h2>
                    <div class="text-sm">
                        <p>{{ $support_contact_name }}</p>
                    </div>
                    @if ($support_contact_phone)
                        <div class="text-sm">
                            <p class="font-bold">{{ __('general.phone') }}</p>
                            <p>
                                {{ $support_contact_phone }}
                            </p>
                        </div>
                    @endif
                    @if ($support_contact_email)
                        <div class="text-sm">
                            <p class="font-bold">{{ __('general.email') }}</p>
                            <p>
                                {{ $support_contact_email }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
       
    </div>
</x-everest::layouts.main>