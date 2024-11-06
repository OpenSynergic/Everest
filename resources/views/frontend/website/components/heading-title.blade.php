@props([
    'title' => '',
    'tag' => 'h2',
])

<div {{ $attributes->merge(['class' => 'flex space-x-4']) }}>
    <{{ $tag }} class="text-xl font-semibold min-w-fit">{{ $title }}</{{ $tag }}>
    <hr class="w-full h-px my-auto bg-gray-200 border-0 dark:bg-gray-700">
</div>