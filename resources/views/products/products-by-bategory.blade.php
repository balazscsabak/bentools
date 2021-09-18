<x-app-layout>

    <div class="products-page mt-3 pb-5">
        <div class="container">
			<div class="row">
				<div class="col-12 col-lg-8 align-self-center">
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
