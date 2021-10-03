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
			<div class="alert alert-danger">
				@foreach ($errors->all() as $error)
					<p class="mb-0">{{ $error }}</p>
				@endforeach
			</div>
		@endif

        <h2>Prospektus</h2>

		
        <form action="{{ route('admin.brochure.save') }}" enctype="multipart/form-data" method="POST">
            @csrf
			
			<input class="form-control form-control-sm" id="file" type="file" name="file">
			
			<input class="btn btn-primary mt-3" type="submit" value="Új prospektus">
            
        </form>

		<a class="btn btn-primary mt-3" target="_blank" href="{{ $brochure }}">Jelenlegi prospektus</a>
    </div>
</x-admin-layout>