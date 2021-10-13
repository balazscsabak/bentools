<x-app-layout>

	<div class="container my-4">
		
		<div class="row justify-content-center">
			<div class="col-12 col-lg-6">

				<h5 class="text-danger fw-bold mb-3">Sikertelen vásárlás</h5>
				<div class="col-12 ">
					Tranzakció azonosító: <b>{{ $order->unique_id }}</b>
				</div>

				<hr class="my-2">
				
				
				<div class="row">
					<div class="col-12 mb-2">
						Az Ön által kezdeményezett online bankkártyás fizetés nem valósult meg. Néhány gyakori hiba:
					</div>

					<div class="col-12 mb-3">
						<div class="mb-1">
							Kártya jellegű hiba
						</div>

						<div class="ps-3 mb-3">
							<div>
								<b> A kártya nem alkalmas internetes fizetésre.</b>
							</div>
							<div>
								<b>A kártya internetes használata számlavezető bank által tiltott.</b>
							</div>
							<div>
								<b>A kártyahasználat tiltott.</b>
							</div>
							<div>
								<b>A kártyaadatok (kártyaszám, lejárat, aláíráscsíkon szereplő kód) hibásan lettek megadva.</b>
							</div>
							<div>
								<b>A kártya lejárt.</b>
							</div>
						</div>

						<div class="mb-1">
							Számla jellegű hiba
						</div>

						<div class="ps-3">
							<div>
								<b>Nincs fedezet a tranzakció végrehajtásához.</b>
							</div>
							<div>
								<b>A tranzakció összege meghaladja a kártya vásárlási limitét.</b>
							</div>
						</div>
					</div>

					<div class="col-12">
						Az ügy további kivizsgálásának érdekében, kérjük vegye fel velünk a kapcsolatot.
					</div>

				</div>
			</div>
		</div>

		<div class="row justify-content-center my-4">
			<div class="col-12 col-lg-6">
				<a href="{{ route('user.profile.orders') }}" class="btn btn-link fs-5 p-0">Eddigi rendeléseim</a>
			</div>
		</div>

	</div>

</x-app-layout>