<x-admin-layout>

    <div class="container">

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

        <h2 class="mb-4 mt-3">Ajánlatkérések</h2>

		<div>
			<table class="table">
				<thead class="table-dark">
				  <tr>
					<th scope="col">Név</th>
					<th scope="col">Cégnév</th>
					<th scope="col">Telefonszám</th>
					<th scope="col">Dátum</th>
					<th scope="col"></th>
				  </tr>
				</thead>
				<tbody>
					@foreach ($offers as $offer)
					<tr>
						<th scope="row">{{ $offer->full_name }}</th>
						<td>{{ $offer->firm_name }}</td>
						<td>{{ $offer->phone }}</td>
						<td>{{ $offer->created_at }}</td>
						<td><a href="{{ route('admin.offer', $offer->id) }}">Részletek</a></td>
					</tr>
					@endforeach
				</tbody>
			  </table>

		</div>

	</div>
</x-admin-layout>