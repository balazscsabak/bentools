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

		<h5>
			Alapértelmezett cím kezelése 
		</h5>
		
		@if (!$primary_address)
			<div class="row">

				<div class="col-12">
					<p>
						Nincs alapértelmezett cím beállítva!
					</p>
				</div>

				<div class="col-12">
					<form method="POST" action="{{ route('user.profile.addresses.store') }}" class="row">
						@csrf
			
						<div class="row my-2">
							<div class="col-12 col-md-3">
								<label class="form-label" for="postcode">Irányítószám</label>
							</div>
							<div class="col-12 col-md-3">
								<input class="form-control form-control-sm" type="text" name="postcode" id="postcode" style="min-width: 150px">
							</div>
						</div>
			
						<div class="row my-2">
							<div class="col-12 col-md-3">
								<label class="form-label" for="city">Város</label>
							</div>
							<div class="col-12 col-md-5">
								<input class="form-control form-control-sm" type="text" name="city" id="city" style="min-width: 300px">
							</div>
						</div>
			
						<div class="row my-2">
							<div class="col-12 col-md-3">
								<label class="form-label" for="street">Utca/Házszám</label>
							</div>
							<div class="col-12 col-md-5">
								<input class="form-control form-control-sm" type="text" name="street" id="street" style="min-width: 300px">
							</div>
						</div>
			
						<div class="col-12">
							<button type="submit" class="btn btn-primary float-end">Mentés</button>
						</div>
					</form>
				</div>
			</div>

		@else

			<div class="row">
				<div class="col-12">
					<form method="POST" action="{{ route('user.profile.addresses.update') }}">
						@csrf
						@method('PUT')
						
						<div class="row my-2">
							<div class="col-12 col-md-3">
								<label class="form-label" for="postcode">Irányítószám</label>
							</div>
							<div class="col-12 col-md-3">
								<input value="{{ $primary_address->postcode }}" class="form-control form-control-sm" type="text" name="postcode" id="postcode" style="min-width: 150px">
							</div>
						</div>
			
						<div class="row my-2">
							<div class="col-12 col-md-3">
								<label class="form-label" for="city">Város</label>
							</div>
							<div class="col-12 col-md-5">
								<input value="{{ $primary_address->city }}" class="form-control form-control-sm" type="text" name="city" id="city" style="min-width: 300px">
							</div>
						</div>
			
						<div class="row my-2">
							<div class="col-12 col-md-3">
								<label class="form-label" for="street">Utca/Házszám</label>
							</div>
							<div class="col-12 col-md-5">
								<input value="{{ $primary_address->street }}" class="form-control form-control-sm" type="text" name="street" id="street" style="min-width: 300px">
							</div>
						</div>
			
						<div class="col-12">
							<button type="submit" class="btn btn-primary float-end">Mentés</button>
						</div>
					</form>
				</div>
			</div>

		@endif


	</div>

</x-profile-layout>
