<x-app-layout>

	<input type="hidden" name="confirm_cart_summ" id="confirm_cart_summ" value="{{ $summ }}">
	<input type="hidden" name="email" id="email" value="{{ $user->email }}">
	<div class="container my-4">

			
		<h2>Vásárlási adatok</h2>

		<div class="content mt-3 row">

			<div class="col-12 col-lg-6 mb-lg-0 mb-4">
				
				<div id="shopping-cart-checkout" class="sticky-top" style="top: 80px">
		
					<div class="cart-items-checkout">
						
						<table class="table table-borderless">
							<thead>
								<tr>
									<th scope="col"></th>
									<th scope="col">Termék</th>
									<th class="text-end pe-3" scope="col">Ár</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($cart['items'] as $item)
									
									<tr>
										<th class="cart-td-image" scope="row">
											<div class="image" style="background-image: url('{{ $item->image_href }}')"></div>
										</th>
										<td>
											<div class="item-info">
												<div class="name">
													{{ $item->name }}
												</div>
												<div class="quantity">
													<span class="multiply">x</span>{{ $item->quantity }}
												</div>
											</div>
										</td>
										<td class="text-end">
											<div class="price fw-bold">
												{{ $item->price }} .-
											</div>
										</td>
									</tr>
								
								@endforeach

                        	</tbody>
						</table>
						
					</div>

					<div class="cart-sum row mt-4">
						<div class="col-6 h4">
							Összesen:
						</div>
						<div class="col-6 h4 fw-bold text-end">
							{{ $summ }} Ft
						</div>
					</div>
					
				</div>
				
			</div>

			<div class="col-12 col-lg-6 mb-lg-0 mb-4">
				<h5>Cégadatok</h5>
				
				<div class="row mb-3">
					<div class="col-12 col-lg-6">
						<label for="firm-name" class="form-label">Cégnév</label>
						<input type="text" class="form-control" id="firm-name" >
					</div>
					<div class="col-12 col-lg-6">
						<label for="tax-number" class="form-label">Adószám</label>
						<input type="text" class="form-control" id="tax-number" >
					</div>
				</div>

				<h5>Szállítási cím</h5>

				<div class="row mb-3">
					<div class="col-12 col-lg-4">
						<label for="shipping-postcode" class="form-label">Irányítószám</label>
						<input type="text" class="form-control" id="shipping-postcode" value="{{ $user->address->postcode ?? '' }}">
					</div>
					<div class="col-12 col-lg-8">
						<label for="shipping-city" class="form-label">Város</label>
						<input type="text" class="form-control" id="shipping-city" value="{{ $user->address->city ?? '' }}">
					</div>
				</div>

				<div class="row mb-4">
					<div class="col-12">
						<label for="shipping-street" class="form-label">Utca/Házszám</label>
						<input type="text" class="form-control" id="shipping-street" value="{{ $user->address->street ?? '' }}">
					</div>
				</div>

				<h5>Számlázási cím</h5>

				<div class="form-check mb-3">
					<input class="form-check-input" type="checkbox" id="billing-shipping-check">
					<label class="form-check-label" for="billing-shipping-check">
					  Szállítási és számlázási cím megegyezik
					</label>
				</div>

				<div id="billing-address">
					<div class="row mb-3">
						<div class="col-4">
							<label for="billing-postcode" class="form-label">Irányítószám</label>
							<input type="text" class="form-control" id="billing-postcode">
						</div>
						<div class="col-8">
							<label for="billing-city" class="form-label">Város</label>
							<input type="text" class="form-control" id="billing-city">
						</div>
					</div>
	
					<div class="row mb-3">
						<div class="col-12">
							<label for="billing-street" class="form-label">Utca/Házszám</label>
							<input type="text" class="form-control" id="billing-street">
						</div>
					</div>
				</div>

				<h5 class="mt-4">Fizetési mód</h5>

				<div id="payment-menthod" class="mb-4">

						<div class="form-check">
							<input value="1" class="form-check-input payment-method-radio" type="radio" name="payment-method" id="method-1">
							<label class="form-check-label" for="method-1">
								Átutalásos fizetés
							</label>
						</div>

						<div class="form-check">
							<input value="2" class="form-check-input payment-method-radio" type="radio" name="payment-method" id="method-2">
							<label class="form-check-label" for="method-2">
								30 napos fizetési határidővel
							</label>
						</div>

						<div class="form-check">
							<input disabled value="3" class="form-check-input payment-method-radio" type="radio" name="payment-method" id="method-3">
							<label class="form-check-label" for="method-3">
								Online bankkártyás fizetés (Jelenleg nem elérhető)
							</label>
						</div>

				</div>

				{{-- <div id="card-info-placeholder" style="display: none">

					<div class="row">
						<div class="col-12 mx-auto">
							<div class="mb-4">
								<label for="card-holder-name" class="form-label">Kártyára írt név</label>
								<input name="card-holder-name" id="card-holder-name" type="text" class="form-control">
							</div>
							
							<label for="shipping-postcode" class="form-label mb-1">Kártyaszám - lejárati hónap/nap - CVC kód</label>
							<div class="form-text mb-3">Biztonságos bankkártyás fizetés! A kártya adatait kizárólag a Stripe szolgáltató használja fel. Az adatokat semmilyen módon nem tároljuk! További információ itt: <a href="#">Adatvédelmi nyilatkozat</a></div>
							<!-- Stripe Elements Placeholder -->
							<div id="card-element" class="rounded border p-3 mb-3"></div>
							
							<button class="card-button btn btn-primary">
								Vásárlás
							</button>
						</div>
					</div>
				
				</div> --}}

				{{-- TODO - rename --}}
				<div id="cash-on-delivery-placeholder" style="display: none">
					<div class="my-3">
						<div class="form-check">
							<input class="form-check-input gdpr-purchase-check" type="checkbox" value="" id="">
							<label class="form-check-label">
								Elolvastam és elfogadom a <a href="">szerződési feltételeket</a>!
							</label>
						</div>
						
						<div class="form-check">
							<input class="form-check-input gdpr-purchase-check" type="checkbox" value="" id="">
							<label class="form-check-label">
								Elolvastam és elfogadom az <a href="">adatvédelmi szabályzatot</a>!
							</label>
						</div>

						<div class="form-check">
							<input class="form-check-input gdpr-purchase-check" type="checkbox" value="" id="">
							<label class="form-check-label">
								Elfogadom, hogy a rendeles leadása fizetési kötelezettséggel jár!
							</label>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<button class="card-button btn btn-primary">
								Vásárlás
							</button>
						</div>
					</div>
				</div>

				{{-- TODO - rename --}}
				<div id="bank-transfver-placeholder" style="display: none">
					<div class="fw-light fst-italic">
						Amennyiben 30 napos határidős fizetésünket szeretné kiválasztani, ezt előre egyeztetéssel teheti meg.<br>
						A weboldalon a regisztáráció után, kérem jelezze nekünk üzenet vagy email esetleg telefonhívás formájában szándékát.
					</div>
					<div class="my-3">
						<div class="form-check">
							<input class="form-check-input gdpr-purchase-check" type="checkbox" value="" id="">
							<label class="form-check-label">
								Elolvastam és elfogadom a <a href="">szerződési feltételeket</a>!
							</label>
						</div>
						
						<div class="form-check">
							<input class="form-check-input gdpr-purchase-check" type="checkbox" value="" id="">
							<label class="form-check-label">
								Elolvastam és elfogadom az <a href="">adatvédelmi szabályzatot</a>!
							</label>
						</div>

						<div class="form-check">
							<input class="form-check-input gdpr-purchase-check" type="checkbox" value="" id="">
							<label class="form-check-label">
								Elfogadom, hogy a rendeles leadása fizetési kötelezettséggel jár!
							</label>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<button class="card-button btn btn-primary" disabled>
								Vásárlás
							</button>
						</div>
					</div>
				</div>

				<script src="https://js.stripe.com/v3/"></script>
				<script src="{{ asset('js/purchase.js') }}"></script>
				
			</div>

		</div>


	</div>

</x-app-layout>