@props(['sponsorLevels', 'sponsorsWithoutLevel'])


@if ($sponsorLevels->isNotEmpty() || $sponsorsWithoutLevel->isNotEmpty())
<section id="sponsors" class="section-background py-20">
	<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
		<!-- Section Header -->
		<div class="text-center max-w-3xl mx-auto mb-16">
			<h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Sponsors</h2>
			<p class="text-gray-600 max-w-2xl mx-auto mt-4">Thank you to all our amazing sponsors who make our work possible</p>
		</div>

		<!-- Sponsors Without Level -->
		@if ($sponsorsWithoutLevel->isNotEmpty())
			<div class="flex flex-col items-center justify-center w-full mt-16">
				<div class="flex flex-wrap items-center justify-center gap-6 w-full">
					@foreach ($sponsorsWithoutLevel as $sponsor)
						@if (!$sponsor->getFirstMedia('logo'))
							@continue
						@endif

						@php $tag = $sponsor->getMeta('url') ? 'a' : 'div'; @endphp

						<{{$tag}} 
							@if($sponsor->getMeta('url'))
							href="{{ $sponsor->getMeta('url') }}"
							@endif
							class="flex items-center justify-center p-3 transition duration-300 ease-in-out">
							<img
								style="
									image-rendering: auto;
									width: auto;
									height: auto;
									object-fit: contain;
									max-width: 200px;
								"
								src="{{ $sponsor->getFirstMediaUrl('logo') }}"
								alt="{{ $sponsor->name }}"
								loading="lazy"
							/>
						</{{$tag}}>
					@endforeach
				</div>
			</div>
		@endif

		<!-- Sponsor Levels -->
		@foreach ($sponsorLevels as $sponsorLevel)
			@if ($sponsorLevel->stakeholders->isNotEmpty())
				<div class="mt-16">
					<h3 class="text-2xl font-medium text-gray-900 text-center mb-8">{{ $sponsorLevel->name }}</h3>
					<div class="flex flex-col items-center justify-center w-full">
						<div class="flex flex-wrap items-center justify-center gap-6 w-full">
							@foreach ($sponsorLevel->stakeholders as $sponsor)
								@if (!$sponsor->getFirstMedia('logo'))
									@continue
								@endif
								@php $tag = $sponsor->getMeta('url') ? 'a' : 'div'; @endphp


								<{{$tag}} 
									@if($sponsor->getMeta('url'))
									href="{{ $sponsor->getMeta('url') }}"
									target="_blank"
									@endif
									class="flex items-center justify-center p-3 transition duration-300 ease-in-out">
									<img
										style="
											image-rendering: auto;
											width: auto;
											height: auto;
											object-fit: contain;
											max-width: 200px;
										"
										src="{{ $sponsor->getFirstMediaUrl('logo') }}"
										alt="{{ $sponsor->name }}"
										loading="lazy"
									/>
								</{{$tag}}>
							@endforeach
						</div>
					</div>
				</div>
			@endif
		@endforeach

	</div>
</section>
@endif