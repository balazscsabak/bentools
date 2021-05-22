<x-admin-layout>

    <div class="container mt-3">
        
        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            
            @csrf
            @method('PUT')

            <h1>
                Kategória módosítása
            </h1>

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

            <input type="submit" value="Módosítás" class="btn btn-primary">
        </form>

    </div>

</x-admin-layout>