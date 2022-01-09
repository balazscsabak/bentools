<x-app-layout>

	<div class="container my-4">
		
		<div class="row justify-content-center">
			<div class="col-12 col-lg-6">

				<h5 class="text-success fw-bold mb-3">Sikeres rendelés</h5>
				
				<h6 class="mb-3">Azonosító: <span class="fw-bold">{{ $order->unique_id }}</span></h6>
				
				<h6 class="mb-3">Cégnév: <span class="fw-bold">{{ $order->info->firm_name }}</span></h6>
				
				<h6 class="mb-3">Telefonszám: <span class="fw-bold">{{ $order->info->phone_number }}</span></h6>
				
				<h6 class="mb-3">Adószám: <span class="fw-bold">{{ $order->info->tax_number }}</span></h6>
				
				<h6 class="mb-3">Fizetés módja: <span class="fw-bold">{{ $order->methodName }}</span></h6>
				
			</div>
		</div>

		<div class="row mb-3 justify-content-center">

			<div class="col-12 col-lg-3">
				<h6>Szállítási cím</h6>
				<hr class="my-2">
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Irányítószám
					</div>
					<div class="col-12 fw-bold">
						{{ $order->info->shipping_postcode }}
					</div>
				</div>
				
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Megye
					</div>
					<div class="col-12 fw-bold">
						{{ $order->info->shipping_county }}
					</div>
				</div>

				<div class="row mb-2 ps-3">
					<div class="col-12">
						Város
					</div>
					<div class="col-12 fw-bold">
						{{ $order->info->shipping_city }}
					</div>
				</div>

				<div class="row mb-2 ps-3">
					<div class="col-12">
						Utca/házszám
					</div>
					<div class="col-12 fw-bold">
						{{ $order->info->shipping_street }}
					</div>
				</div>

				<hr class="my-2">
			</div>

			<div class="col-12 col-lg-3">

				<h6>Számlázási cím</h6>
				<hr class="my-2">
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Irányítószám
					</div>
					<div class="col-12 fw-bold">
						{{ $order->info->billing_postcode }}
					</div>
				</div>
				
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Megye
					</div>
					<div class="col-12 fw-bold">
						{{ $order->info->billing_county }}
					</div>
				</div>

				<div class="row mb-2 ps-3">
					<div class="col-12">
						Város
					</div>
					<div class="col-12 fw-bold">
						{{ $order->info->billing_city }}
					</div>
				</div>

				<div class="row mb-2 ps-3">
					<div class="col-12">
						Utca/házszám
					</div>
					<div class="col-12 fw-bold">
						{{ $order->info->billing_street }}
					</div>
				</div>

				<hr class="my-2">
			</div>
		</div>

		<div class="row mb-3 justify-content-center">
			<div class="col-12 col-lg-6">
				<h6>Termékek</h6>

				<table class="table table-sm table-borderless">

					@foreach ($order->items as $item)
						<tr>
							<td class="ps-0">{{ $item->name }}</td>
							<td class="text-end"><span class="fw-bold">{{ $item->quantity }} db</span></td>
							<td class="text-end pe-0"><span class="fw-bold">{{ $item->price_sum }} Ft</span></td>
						</tr>
					@endforeach
				
				</table>

			</div>
		</div>
		
		<div class="row justify-content-center">
			<div class="col-12 col-lg-6 text-end fs-5 d-flex justify-content-between">
				<div>
					Összesen: 	
				</div>
				<div class="fw-bold">{{ $order->price }} Ft</div>
			</div>
		</div>
		<div class="row mb-4 justify-content-center">
			<div class="col-12 col-lg-6 text-end fs-5">
				<div class="fw-light text-end">
					<small>Nettó: {{ $order->net_price }} Ft</small>
				</div>
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="col-12 col-lg-6">
				<a href="{{ route('user.profile.orders') }}" class="btn btn-link fs-5 p-0">Eddigi rendeléseim</a>
			</div>
		</div>


	</div>

</x-app-layout>