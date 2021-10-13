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

        <h3 class="mb-3">
            Felhasználó: {{ $user->email }}
        </h3>

		<a class="mb-4 btn btn-primary btn-sm" href="{{ route('admin.users') }}">Vissza</a>
		
		<div class="mb-3 ">
			<div class="form-check form-switch">
				<form id="updateAbleTo30" action="{{ route('admin.user.updateAbleTo30') }}" method="post">
					@csrf
					<input type="hidden" name="id" value="{{ $user->id }}">
					<input value="1" name="able_to_30" id="able_to_30" class="form-check-input" type="checkbox" {{ $user->able_to_30 ? 'checked' : null}}>
					<label class="form-check-label" for="flexSwitchCheckDefault">30 napos utalás engedélyezve?</label>
				</form>
			</div>
		</div>

		<div class="row mb-3">

			<div class="col-12 col-lg-5">
				<h6>Adatok</h6>
				<hr class="my-2">
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Irányítószám
					</div>
					<div class="col-12 fw-bold">
						{{ $user->firstname }}
					</div>
				</div>
				
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Megye
					</div>
					<div class="col-12 fw-bold">
						{{ $user->firstname }}
					</div>
				</div>
				
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Város
					</div>
					<div class="col-12 fw-bold">
						{{ $user->firstname }}
					</div>
				</div>
				
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Utca/házszám
					</div>
					<div class="col-12 fw-bold">
						{{ $user->firstname }}
					</div>
				</div>
				
			</div>

			<div class="col-12 col-lg-5">
				<h6 class="text-white-50">-</h6>
				<hr class="my-2">

				<div class="row mb-2 ps-3">
					<div class="col-12">
						Cégnév
					</div>
					<div class="col-12 fw-bold">
						@isset($user->firm_name)
						{{ $user->firm_name }}
						@endisset
					</div>
				</div>
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Adószám
					</div>
					<div class="col-12 fw-bold">
						@isset($user->tax_number)
						{{ $user->tax_number }}
						@endisset
					</div>
				</div>
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Telefonszám
					</div>
					<div class="col-12 fw-bold">
						@isset($user->phone_number)
						{{ $user->phone_number }}
						@endisset
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-3">

			<div class="col-12 col-lg-5">
				<h6>Szállítási cím</h6>
				<hr class="my-2">
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Irányítószám
					</div>
					<div class="col-12 fw-bold">
						@isset($user->address->postcode)
						{{ $user->address->postcode }}
						@endisset
					</div>
				</div>
				
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Megye
					</div>
					<div class="col-12 fw-bold">
						@isset($user->address->county)
						{{ $user->address->county }}
						@endisset
					</div>
				</div>

				<div class="row mb-2 ps-3">
					<div class="col-12">
						Város
					</div>
					<div class="col-12 fw-bold">
						@isset($user->address->city)
						{{ $user->address->city }}
						@endisset
					</div>
				</div>

				<div class="row mb-2 ps-3">
					<div class="col-12">
						Utca/házszám
					</div>
					<div class="col-12 fw-bold">
						@isset($user->address->street)
						{{ $user->address->street }}
						@endisset
					</div>
				</div>

				<hr class="my-2">
			</div>

			<div class="col-12 col-lg-5">

				<h6>Számlázási cím</h6>
				<hr class="my-2">
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Irányítószám
					</div>
					<div class="col-12 fw-bold">
						@isset($user->address->billing_postcode)
						{{ $user->address->billing_postcode }}
						@endisset
					</div>
				</div>
				
				<div class="row mb-2 ps-3">
					<div class="col-12">
						Megye
					</div>
					<div class="col-12 fw-bold">
						@isset($user->address->billing_county)
						{{ $user->address->billing_county }}
						@endisset
					</div>
				</div>

				<div class="row mb-2 ps-3">
					<div class="col-12">
						Város
					</div>
					<div class="col-12 fw-bold">
						@isset($user->address->billing_city)
						{{ $user->address->billing_city }}
						@endisset
					</div>
				</div>

				<div class="row mb-2 ps-3">
					<div class="col-12">
						Utca/házszám
					</div>
					<div class="col-12 fw-bold">
						@isset($user->address->billing_street)
						{{ $user->address->billing_street }}
						@endisset
					</div>
				</div>

				<hr class="my-2">
			</div>
		</div>
		
		<div>
			<input class="btn btn-primary" type="submit" form="updateAbleTo30" value="MENTÉS"/>
		</div>
    </div>

</x-admin-layout>

<script>
	$('#users-list').on('click', 'tr', function(e) {
		console.log(e);
	})
</script>