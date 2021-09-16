<x-admin-layout>
    <div class="container mt-3 mb-5">
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

        @if ($errors->any())
            <div class="alert alert-danger alert-block">
            
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                
            </div>
        @endif

        <h2 class="mb-3">
            Rendelés: {{ $order->unique_id }}
        </h2>
    
		<a class="mb-4 btn btn-primary btn-sm" href="{{ route('admin.orders') }}">Vissza</a>

		<div class="order">

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
					
					<h6 class="mb-3">Cégnév: <span class="fw-bold">{{ $order->info->firm_name }}</span></h6>
				
					<h6 class="mb-3">Adószám: <span class="fw-bold">{{ $order->info->tax_number }}</span></h6>
					
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-lg-10">

					<h6 class="mb-3">Státusz: <span class="fw-bold">{!! $order->StatusBadge !!}</span></h6>
					
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

</x-admin-layout>