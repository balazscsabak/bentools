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

        <div class="row mb-4">
            <div class="col-4">
                <form action="{{ route('media.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="image" class="form-label">Kép feltöltés</label>
                    <input class="form-control form-control-sm" id="image" type="file" name="image">
                    
                    <input type="submit" value="Feltöltés" class="btn btn-primary btn-sm mt-2">
                </form>
            </div>
        </div>

        <h2 class="mb-3">Feltöltött képek</h2>

        <div class="row gx-4 gy-4">
            @foreach ($images as $image)
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <a href="{{ route('media.image', $image->id) }}">
                        <img class="border border-secondary border-2 rounded-1" src="/storage/{{ $image->path }}" alt="/storage/{{ $image->name }}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>

</x-admin-layout>