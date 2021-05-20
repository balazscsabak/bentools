<x-admin-layout>

    <div class="container mt-3">

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

        <h2 class="mb-4">Ajánlatkérés</h2>

		<form method="POST" action="{{ route('admin.offer.update') }}">
			@csrf

			<div class="row mb-3">
				<div class="col-md-12">
					<label for="content" class="col-12 col-form-label">Ajánlatkérés: megjelenő szöveg</label>
					<textarea name="content" class="form-control" >{{ $content }}</textarea>
				</div>
			</div>

			<div class="row mb-3">
				<div class="col-md-12">
					<label class="col-12 col-form-label">Kezdőlap: Kérjen árajánlatot szöveg</label>
					<textarea name="content_offer" class="form-control" >{{ $offer }}</textarea>
				</div>
			</div>

			<div class="row mb-3">
				<div class="col-md-12">
					<label class="col-12 col-form-label">Kezdőlap: Küldjön üzenetet szöveg</label>
					<textarea name="content_message" class="form-control" >{{ $contentMessage }}</textarea>
				</div>
			</div>

			<div class="col-12">
				<button type="submit" class="btn btn-primary float-end">Mentés</button>
			</div>
		</form>

	</div>
</x-admin-layout>