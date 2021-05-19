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

        <h2 class="mb-4">Szállítási információ</h2>

		<form method="POST" action="{{ route('admin.shipping.update') }}">
			@csrf

			<div class="row mb-3">
				<div class="col-md-12">
					<h4>Megjelenő kontent</h4>
					<textarea name="content" class="form-control content-editor" id="shipping-content-editor">{{ $content }}</textarea>
				</div>
			</div>

			<div class="row mb-3">
				<div class="col-md-12">
					<h4>Frontpage kontent</h4>
					<textarea name="short_content" class="form-control content-editor" id="post-content-editor">{{ $shortContent }}</textarea>
				</div>
			</div>

			<div class="col-12">
				<button type="submit" class="btn btn-primary float-end">Mentés</button>
			</div>
		</form>

	</div>
</x-admin-layout>