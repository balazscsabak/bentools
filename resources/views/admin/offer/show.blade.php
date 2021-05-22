<x-admin-layout>

    <div class="container mt-5">
        <div class="row">
            <div class="col-3">
                Név
            </div>
            <div class="col-9">
                {{ $offer->full_name ?? '' }}
            </div>

            <div class="offer-data-divider w-100"></div>

            <div class="col-3">
                Cégnév
            </div>
            <div class="col-9">
                {{ $offer->firm_name ?? '' }}
            </div>

            <div class="offer-data-divider w-100"></div>

            <div class="col-3">
                Email
            </div>
            <div class="col-9">
                {{ $offer->email ?? '' }}
            </div>
            
            <div class="offer-data-divider w-100"></div>

            <div class="col-3">
                Telefonszám
            </div>
            <div class="col-9">
                {{ $offer->phone ?? '' }}
            </div>

            <div class="offer-data-divider w-100"></div>

            <div class="col-3">
                Dátum
            </div>
            <div class="col-9">
                {{ $offer->created_at ?? '' }}
            </div>

            <div class="offer-data-divider w-100"></div>

            <div class="col-3">
                Üzenet
            </div>
            <div class="col-9">
                {!! nl2br($offer->message) ?? '' !!}
            </div>
            
        </div>

		<div class="row">
			<div class="col-12">
				<h5>Termékek</h5>
			</div>

		</div>

		<table class="table table-sm">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Termék</th>
					<th scope="col">Mennyiség</th>
				</tr>
			</thead>
			<tbody>
				@isset($offer->items)
					@foreach ($offer->items as $item)
					<tr>
						<th scope="row">{{ $item->product_id }}</th>
						<td>{{ $item->name }}</td>
						<td>{{ $item->quantity }}</td>
					</tr>	
					@endforeach
				@endisset
			</tbody>
	  
		</table>

	</div>

</x-admin-layout>