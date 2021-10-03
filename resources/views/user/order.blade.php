<x-profile-layout>

	<div class="col-12 col-md-9 p-4">
		
		@if ($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				<p class="mb-0">{{ $error }}</p>
			@endforeach
		</div>
		@endif

		@if ($message = Session::get('success'))
		<div class="alert alert-success alert-block">
			{{ $message }}
		</div>
		@endif

		@if ($message = Session::get('error'))
		<div class="alert alert-danger alert-block">
			{{ $message }}
		</div>
		@endif

		<h5>Rendelés: {{ $order->unique_id }}</h5>

		<a class="mb-4 btn btn-primary btn-sm" href="{{ route('user.profile.orders') }}">Vissza</a>

		<div class="order">

			<div class="row">
				<div class="col-12 col-lg-10">

					<h6 class="mb-3">Cégnév: <span class="fw-bold">{{ $order->info->firm_name }}</span></h6>
					
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-lg-10">

					<h6 class="mb-3">Telefonszám: <span class="fw-bold">{{ $order->info->phone_number }}</span></h6>
					
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-lg-10">

					<h6 class="mb-3">Adószám: <span class="fw-bold">{{ $order->info->tax_number }}</span></h6>
					
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-lg-10">

					<h6 class="mb-3">Fizetés módja: <span class="fw-bold">{{ $order->methodName }}</span></h6>
					
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-lg-10">

					<h6 class="mb-3">
						Rendelés dátuma: 
						<span class="fw-bold">
						{{ date_format($order->created_at, 'Y-m-d H:i:s') }}
						</span>
				</h6>
					
				</div>
			</div>

			<div class="row mb-5">
				<div class="col-12 col-lg-10">

					<h6 class="mb-2">
						Státusz: 
						<span class="fw-bold">
							{!! $order->StatusBadge !!}
						</span>
					</h6>

					@if ($order->status === 'PENDING')
						<div>
							<small>Amennyiben a rendelés státusza “Feldolgozás alatt”, visszavonhatja rendelését!</small>
						</div>
						<div>
							<button data-bs-toggle="modal" data-bs-target="#cancelOrderModals" class="btn btn-danger btn-sm p-2text-uppercase py-0">Rendelés visszavonása</button>
						</div>

						<!-- Modal -->
						<div class="modal fade" id="cancelOrderModals" tabindex="-1" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="cancelOrderModalsLabel">Rendelés visszamondása</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										Biztos, hogy vissza szeretnéd mondani a rendelésed?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
										
										<form id="cancel-order-form"  action="{{ route('user.profile.order.cancel') }}" method="POST">
											@csrf
											<input type="hidden" name="id" value="{{ $order->id }}">
											<button id="submit-cancel-order" type="submit" class="btn btn-danger">Rendelés visszavonása</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					@endif
				</div>
			</div>

			<div class="row mb-3">

				<div class="col-12 col-lg-5">
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
	
				<div class="col-12 col-lg-5">
	
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

			<div class="row mb-3">
				<div class="col-12 col-lg-10">
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
			
			<div class="row mb-4">
				<div class="col-12 col-lg-10 text-end fs-5">
					Összesen: <span class="fw-bold">{{ $order->price }} Ft</span>
				</div>
			</div>
		</div>
	</div>

</x-profile-layout>

<script>
	$('#cancel-order-form').on('submit', function(e) {
		$('#submit-cancel-order').attr('disabled', 'disabled');
	})
</script>