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
            Rendelések
        </h2>

		<div class="orders">

			@if (count($orders) > 0)
				@foreach ($orders as $order)
					@if ($order->status !== "ERROR")	
						<a href="{{ route('admin.order', $order->unique_id) }}" class="list-group-item">
							<div class="d-flex justify-content-between align-items-center">
								<div class="m-0">
									<span class="text-secondary">#</span>
									{{ $order->unique_id }}
									<p class="m-0 ">
										<small class="text-secondary ">
											{{ $order->methodName }} - {{ $order->price }} Ft
										</small>
									</p>
								</div>

								<div class="d-flex align-items-center">
									<div class="d-flex align-items-center me-3 me-lg-5">
										{!! $order->statusBadge !!}
									</div>
									<div class="m-0">
										{{ date_format($order->created_at, 'Y-m-d H:i:s') }}
									</div>
								</div>
							</div>
						</a>
					@endif
				@endforeach
			@else
				<div class="list-group-item">
					<h6 class="text-center m-0">
						Jelenleg nincs új rendelés
					</h6>
				</div>
			@endif


		</div>

    </div>

</x-admin-layout>
