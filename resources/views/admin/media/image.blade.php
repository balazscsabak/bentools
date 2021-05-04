<x-admin-layout>

    <div class="container mt-3">
        <img src="/storage/{{ $image->path }}" alt="{{ $image->name }}">

        <form method="POST" action="{{ route('media.image.delete') }}">

            @csrf

            <input type="hidden" name="id" value="{{ $image->id }}">
            
            <input type="submit" value="Kép törlése" class="btn btn-danger">

        </form>
    </div>

</x-admin-layout>