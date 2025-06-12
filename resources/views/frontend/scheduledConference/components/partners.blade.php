@props(['partners'])

@if ($partners->isNotEmpty())
	<section class="py-20">
		<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
			<!-- Section Header -->
			<div class="text-center max-w-3xl mx-auto mb-16">
				<h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Partners</h2>
			</div>

			<!-- Partners Grid -->
			<div class="flex flex-col items-center justify-center w-full">
				<div class="flex flex-wrap items-center justify-center gap-6 w-full">
					@foreach ($partners as $partner)
						@if (!$partner->getFirstMedia('logo'))
							@continue
						@endif
						@php $tag = $partner->getMeta('url') ? 'a' : 'div'; @endphp

						<{{$tag}} 
							@if($partner->getMeta('url'))
							href="{{ $partner->getMeta('url') }}"
							target="_blank"
							@endif
						 	class="flex items-center justify-center p-3 transition duration-300 ease-in-out">
							<!-- Partner Logo -->
							<img
								style="
									image-rendering: auto;
									width: auto;
									height: auto;
									object-fit: contain;
									max-width: 200px;
								"
								src="{{ $partner->getFirstMediaUrl('logo') }}"
								alt="{{ $partner->name }}"
								loading="lazy"
							/>
						</{{$tag}}>
					@endforeach
				</div>
			</div>
		</div>
	</section>
@endif