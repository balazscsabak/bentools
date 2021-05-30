<x-admin-layout>

    <div class="container mt-3">
        
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p class="mb-0">{{ $error }}</p>
                @endforeach
            </div>
        @endif

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

        <h1>
            Kategória módosítása
        </h1>

        <div>
            <a class="btn btn-secondary btn-sm mt-1 mb-4" href="{{ route('categories.index') }}">Vissza</a>
        </div>

        <form id="update-form" method="POST" action="{{ route('categories.update', $category->id) }}">
            
            @csrf
            @method('PUT')



            <div class="mb-3">
                <label class="form-label" for="parent">Ős kategória ("-", ha nincs)</label>
                <select name='parent' class="form-select" aria-label="Parent Category">
                    @foreach ($mainCategories as $cat)
                        <option value='{{ $cat->id }}' {{$category->parent === $cat->id ? 'selected' : ''}}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Kategória neve</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
            </div>

        </form>
        
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" id="delete-form">
            <input type="hidden" name="id" value={{ $category->id }}>
            @csrf
            @method('DELETE')
        </form>

        <div class="d-flex justify-content-between">
            <input type="submit" value="Módosítás" class="btn btn-primary" form="update-form">
            <button class="btn btn-danger btn-sm" type="submit" form="delete-form">Törlés</button>
        </div>
            
    </div>

</x-admin-layout>