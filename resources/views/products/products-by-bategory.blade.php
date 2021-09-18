<x-app-layout>

    <div class="products-page mt-3 pb-5">
        <div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-8">
					<h5 class="mb-3">Kategória: {{ $slug ?? '' }}</h5>
					<div class="row gy-3 related-items products-wrapper">
						@foreach ($products as $product)
						
							<x-related-item :product="$product"/>
						
						@endforeach
					</div>
				</div>
			</div>
        </div>
    </div>

</x-app-layout>
