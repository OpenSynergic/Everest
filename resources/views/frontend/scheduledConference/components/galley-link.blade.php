@props([
    'galley',
])

<div>
    <a 
        href="{{ $galley->getUrl() }}" 
        @class([
            'galley-link btn btn-outline btn-primary btn-sm',
            'pdf' => $galley->isPdf(),
        ])
    >
        {{ $galley->label }}
    </a>
</div>