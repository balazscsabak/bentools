<x-admin-layout>

    <div class="container mt-5 mb-4">

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
			<div class="col-12 mt-5 mb-3">
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
						<td>
                            <div style="font-size: 1.2rem;">
                                {{ $item->name }}
                            </div>
                    
                            @if ($item->is_variant)
                                @php
                                    $data = json_decode($item->data, true);
                                @endphp

                                <div class="my-3">
                                    <table class="table table-borderless table-sm">
                                        <thead>
                                            <tr>
                                                @foreach ($data['keys'] as $key)
                                                    <th>{{ $key }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($data['values'] as $value)
                                                    <td>{{ $value }}</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </td>
						<td style="font-size: 1.2rem; font-weight: bold;">{{ $item->quantity }}</td>
					</tr>	
					@endforeach
				@endisset
			</tbody>
	  
		</table>

        <div class="my-5">
            <a href="{{ route('admin.offers') }}" class="btn btn-sm btn-primary">Vissza</a>
        </div>
	</div>

</x-admin-layout>