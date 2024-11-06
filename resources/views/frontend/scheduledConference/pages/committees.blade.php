<x-everest::layouts.main>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <x-everest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" />
        </div>
        <div class="flex mb-5 space-x-4">
            <h1 class="text-xl font-semibold min-w-fit">List Committee</h1>
            <hr class="w-full h-px my-auto bg-gray-200 border-0 dark:bg-gray-700">
        </div>
        <div class="space-y-4">
            @forelse ($committeeRoles as $role)
                <div class="">
                    <h2 class="text-xl">{{ $role->name }}</h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($role->committees as $committee)
                            <div class="card card-compact border">
                                <div class="card-body">
                                    <div class="flex flex-col gap-4">
                                        <div class="flex gap-x-2 items-center">
                                            <div class="profile-image avatar">
                                                <div class="w-14 h-14 rounded-full">
                                                    <img src="{{ $committee->getFilamentAvatarUrl() }}"
                                                        alt="{{ $committee->fullName }}" />
                                                </div>
                                            </div>
                                            <div class="profile-description">
                                                <p class="text-content">{{ $committee->fullName }}</p>
                                                @if ($committee->hasMeta('affiliation'))
                                                    <span class="text-xs">{{ $committee->getMeta('affiliation') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center text-gray-500">
                    No commiittees found.
                </div>
            @endforelse
        </div>
    </div>
</x-everest::layouts.main>