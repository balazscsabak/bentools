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

        <h2 class="mb-4">Socials beállítások</h2>

		<div class="row">
			<div class="col-12 col-md-8">
				
				<form method="POST" action="{{ route('admin.socials.update') }}">
					@csrf

					<table class="table table-borderless">
						<tbody>
							<tr>
								<td class="align-middle">
									Facebook
								</td>
								<td class="align-middle">
									<div class="form-check form-switch">
										<input 
											@if(isset($socials['facebook_enabled']) && $socials['facebook_enabled']) 
												checked 
											@endif 
											class="form-check-input" 
											type="checkbox" 
											id="facebook_enabled" 
											name="facebook_enabled">
									</div>
								</td>
								<td>
									<div class="input-group">
										<span class="input-group-text">URL</span>
										<input
											@if(isset($socials['facebook_url']) && $socials['facebook_url']) 
												value="{{ $socials['facebook_url'] }}"
											@endif 
										 	type="text" 
											id="facebook_url" 
											name="facebook_url" 
											class="form-control">
									</div>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									Instagram
								</td>
								<td class="align-middle">
									<div class="form-check form-switch">
										<input 
											@if(isset($socials['instagram_enabled']) && $socials['instagram_enabled']) 
												checked 
											@endif 
											class="form-check-input" type="checkbox" id="instagram_enabled" name="instagram_enabled">
									</div>
								</td>
								<td>
									<div class="input-group">
										<span class="input-group-text">URL</span>
										<input 
											@if(isset($socials['instagram_url']) && $socials['instagram_url']) 
												value="{{ $socials['instagram_url'] }}"
											@endif 
											type="text" id="instagram_url" name="instagram_url" class="form-control">
									</div>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									YouTube
								</td>
								<td class="align-middle">
									<div class="form-check form-switch">
										<input 
											@if(isset($socials['youtube_enabled']) && $socials['youtube_enabled']) 
												checked 
											@endif 
											class="form-check-input" type="checkbox" id="youtube_enabled" name="youtube_enabled">
									</div>
								</td>
								<td>
									<div class="input-group">
										<span class="input-group-text">URL</span>
										<input 
											@if(isset($socials['youtube_url']) && $socials['youtube_url']) 
												value="{{ $socials['youtube_url'] }}"
											@endif 
											type="text" id="youtube_url" name="youtube_url" class="form-control">
									</div>
								</td>
							</tr>
						</tbody>
					</table>

					<div class="mt-4">
						<input class="btn btn-primary" type="submit" value="Mentés">
					</div>
				</form>

			</div>
		</div>

	</div>
</x-admin-layout>