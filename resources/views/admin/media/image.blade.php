<x-admin-layout>

    <div class="container mt-3 mb-5">

        <div class="d-flex mb-4">
            <a class="btn btn-secondary me-3 btn-sm" href="{{ route('media') }}">Vissza</a>
            <form class="text-right" method="POST" action="{{ route('media.image.delete') }}">
    
                @csrf
    
                <input type="submit" value="Kép törlése" class="btn btn-danger btn-sm">
                <input type="hidden" name="id" value="{{ $image->id }}">
                
            </form>
        </div>

        <img class="with-shadow" style="margin: auto; max-width: 600px; padding:2px;" src="/storage/{{ $image->path }}" alt="{{ $image->name }}">

    </div>

</x-admin-layout>