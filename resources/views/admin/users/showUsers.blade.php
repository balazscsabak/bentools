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

        <h2 class="mb-3">
            Regisztrált felhasználók
        </h2>
    
		<div>
			<table id="users-list" class="table table-sm table-striped table-hover">
				<thead>
					<tr>
						<td>Email</td>
						<td class="text-center">Adószám</td>
						<td class="text-center">30 napos utalás</td>
						<td class="text-end">Csatlakozás dátuma</td>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr data-user_link="{{ route('admin.user', $user->id) }}">
							<td>{{ $user->email }}</td>
							<td class="text-center">{{ $user->tax_number }}</td>
							<td class="text-center">
								@if ($user->able_to_30)
									<i class="fas fa-check-circle text-success"></i>
								@else
									<i class="fas fa-times-circle text-danger"></i>
								@endif
							</td>
							<td class="text-end">{{ $user->created_at }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
        

    </div>

</x-admin-layout>

<script>
	$('#users-list').on('click', 'tr', function(e) {
		const link = $(e.currentTarget).data('user_link');
		
		if(link) {
			window.location = link;
		}
	})
</script>