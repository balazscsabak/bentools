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

		<h5>Rendelések</h5>

		<div class="orders">

			@foreach ($user->orders as $order)
				@if ($order->status !== "ERROR")	
					<a href="{{ route('user.profile.order', $order->unique_id) }}" class="list-group-item">
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

		</div>
	</div>

</x-profile-layout>
