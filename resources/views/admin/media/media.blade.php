<x-admin-layout>

    <div class="container mt-3">
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

        <div class="row">
            <div class="col-4">
                <form action="{{ route('media.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="image" class="form-label">Kép feltöltés</label>
                    <input class="form-control form-control-sm" id="image" type="file" name="image">
                    
                    <input type="submit" value="Feltöltés" class="btn btn-primary mt-2">
                </form>
            </div>
        </div>

        <h4>Feltöltött képek</h4>

        <div class="row">
            @foreach ($images as $image)
                <div class="col-3">
                    <a href="{{ route('media.image', $image->id) }}">
                        <img src="/storage/{{ $image->path }}" alt="/storage/{{ $image->name }}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>

</x-admin-layout>