<x-website::layouts.main>
    <div class="mb-6">
        <x-website::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" />
    </div>
    <div class="relative">
        <div class="flex mb-5 space-x-4">
            <h1 class="text-xl font-semibold min-w-fit">{{ $this->getTitle() }}</h1>
            <hr class="w-full h-px my-auto bg-gray-200 border-0 dark:bg-gray-700">
        </div>
        <div class="prose">
            This {{ $name }} utilizes the <a href="https://leconfe.com">Leconfe</a> platform, an open-source conference management software. Developed, maintained, and freely distributed by Open Synergic under the GNU General Public License, Leconfe offers a robust solution for organizing and managing conferences. For more information about the platform, please visit the <a href="https://leconfe.com">Leconfe</a> website.
        </div>
    </div>
</x-website::layouts.main>
