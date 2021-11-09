<x-app-layout>

	<div class="container my-4">
		<h2>Kosár tartalma</h2>

		<div class="row mt-3">
			<div class="col-12 col-lg-6 mb-lg-0 mb-4">
				
				<div id="shopping-cart-page" class="show">
		
					<div class="cart-items">
						
						<table class="table table-borderless">
							<thead>
								<tr>
									<th scope="col"></th>
									<th scope="col">Termék</th>
									<th class="text-end pe-3" scope="col">Ár</th>
								</tr>
							</thead>
							<tbody>
									
							</tbody>
						</table>
						
					</div>
				
					<div class="cart-sum row mt-4">
						<div class="col-6 h4">
							Összesen:
						</div>
						<div class="col-6 h4 fw-bold text-end " id="cart-page-sum">
							{{ $summ }} Ft
						</div>
					</div>
					
				</div>
				
			</div>

			<div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
				@if ($summ < 6000)

				<h5 class="text-center">Minimum rendelés 6000 Ft. A rendeléshez tegyél még hozzá valamit a kosaradhoz!</h5>
				
				@else
					@auth

					<form class="text-center" method="POST" action="{{ route('checkout') }}">
						@csrf
						<h5 class="mb-3">Tovább a megrendeléshez</h5>
						<input type="submit" class="btn btn-primary" value='Tovább' />

					</form>

					@endauth
					
					@guest
					
					<div>

						<h5 class="text-center">
							A vásárlás folytatásához, kérlek jelentkezz be!
						</h5>
			
						<form method="POST" action="{{ route('cart.checkout') }}">
							@csrf
					
							<div class="row justify-content-center my-4">
								
								<div class="col-8">
									
									@if ($error = Session::get('error'))
										<div class="alert alert-danger alert-block text-center mb-3">
										
											Rossz felhasználónév/jelszó
											
										</div>
									@endif
									
									<!-- Email Address -->
									<div class="mb-3">
										<label for="emails" class="form-label">Email cím</label>
										<input type="email" class="form-control" name="email" id="email" required autofocus="autofocus">
									</div>
					
									<!-- Password -->
									<div class="mb-3">
										<label for="password" class="form-label">Jelszó</label>
										<input type="password" class="form-control" name="password" id="password" required>
									</div>
					
									<!-- Remember Me -->
									<div class="mb-3">
										<label for="remember_me" class="inline-flex items-center">
											<input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
											<span class="ml-2 text-sm text-gray-600">{{ __('Maradjak bejelentkezve') }}</span>
										</label>
									</div>
					
									<div class="d-flex justify-content-center">
										<input type="submit" class="btn btn-primary" value='Bejelentkezés' />
									</div>
			
									<div class="text-center">
										<p class="mt-4 mb-0">
											Nincs még profilja?
										</p>
										<a href="{{ route('register') }}" class="btn btn-link">Regisztráció</a>
									</div>
					
								</div>
							</div>
					
						</form>

					</div>

					@endguest

				@endif
			</div>

		</div>
	</div>

</x-app-layout>