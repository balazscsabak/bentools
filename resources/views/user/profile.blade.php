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

		<form method="POST" action="{{ route('user.profile.update') }}" class="row">
			@csrf
			<h5>Felhasználói Adatok</h5>
			
			<div class="col-md-6 mt-3">
				<label for="lastname" class="form-label">Vezetéknév</label>
				<input value="{{ $user->lastname }}" name="lastname" type="text" class="form-control" id="lastname">
			</div>
			
			<div class="col-md-6 mt-3">
				<label for="firstname" class="form-label">Keresztnév</label>
				<input value="{{ $user->firstname }}" name="firstname" type="text" class="form-control" id="firstname">
			</div>

			<div class="col-md-6 mt-3">
				<label for="firstname" class="form-label">Cégnév</label>
				<input value="{{ $user->firm_name }}" name="firm_name" type="text" class="form-control" id="firm_name">
			</div>

			<div class="col-md-6 mt-3">
				<label for="firstname" class="form-label">Telefonszám</label>
				<input value="{{ $user->phone_number }}" name="phone_number" type="text" class="form-control" id="phone_number">
			</div>
			
			<div class="col-md-6 mt-3">
				<label for="firstname" class="form-label">Adószám</label>
				<input value="{{ $user->tax_number }}" name="tax_number" type="text" class="form-control" id="tax_number">
			</div>

			<div class="col-12 mt-3">
				<button type="submit" class="btn btn-primary float-end">Mentés</button>
			</div>
		</form>

		<form method="POST" action="{{ route('profile.password') }}">
			@csrf
			<h5>Jelszó csere</h5>

			<div class="row mb-3">
				<label for="password" class="col-sm-2 col-form-label">Jelenlegi jelszó</label>
				<div class="col-sm-10">
				<input name="password" type="password" class="form-control" id="password">
				</div>
			</div>

			<div class="row mb-3">
				<label for="newpassword" class="col-sm-2 col-form-label">Új jelszó</label>
				<div class="col-sm-10">
				<input name="newpassword" type="password" class="form-control" id="newpassword">
				</div>
			</div>

			<div class="row mb-3">
				<label for="newpassword_confirmation" class="col-sm-2 col-form-label">Új jelszó megerősítése</label>
				<div class="col-sm-10">
				<input name="newpassword_confirmation" type="password" class="form-control" id="newpassword_confirmation">
				</div>
			</div>

			<div class="col-12">
				<button type="submit" class="btn btn-primary float-end">Mentés</button>
			</div>
		</form>

	</div>

</x-profile-layout>
