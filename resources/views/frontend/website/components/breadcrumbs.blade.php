@props([
    'breadcrumbs' => [],
])

@if(!empty($breadcrumbs))
<div {{ $attributes->class(['breadcrumbs text-sm bg-gray-50 px-4 py-3 rounded-md']) }}>
    <ul class="flex items-center flex-wrap gap-2">
        @foreach ($breadcrumbs as $url => $label)
            <li class="flex items-center">
                @if(!is_int($url))
                    <x-everest::link 
                        :href="$url" 
                        class="text-gray-600 hover:text-blue-800 transition-colors duration-200 font-medium"
                    >
                        {{ $label }}
                    </x-everest::link>
                @else
                    <span class="text-gray-600">{{ $label }}</span>
                @endif
                
                @if(!$loop->last)
                    <svg 
                        class="w-5 h-5 mx-2 text-gray-400" 
                        xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endif