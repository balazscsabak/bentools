<x-app-layout>

	<div class="container">
		<div class="row my-4" style='border: 1px solid #ececec;'>
			<div class="col-12 col-md-3 p-4" style="background: #f1f1f1; border-right: 2px solid #d0d0d0;">
				<ul class="my-0 list-group ">
					<li class="list-group-item bg-light" ><a class="btn btn-link" href={{ route('user.profile') }}>Felhasználói Adatok</a></li>
					<li class="list-group-item bg-light"><a class="btn btn-link" href={{ route('user.profile.addresses') }}>Cím</a></li>
					<li class="list-group-item bg-light"><a class="btn btn-link" href={{ route('user.profile.orders') }}>Rendelések</a></li>
					<li class="list-group-item bg-light">
						<form action="{{ route('logout') }}" method="POST">
							@csrf
							<input class="btn btn-link" value="Kijelentkezés" type="submit" />
						</form>
					</li>
				</ul>
			</div>

			{{ $slot }}
		</div>
	</div>

</x-app-layout>
