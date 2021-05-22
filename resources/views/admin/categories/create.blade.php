<x-admin-layout>

    <div class="container mt-3">
        
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <h2>
                Új kategória
            </h2>

            <div class="mb-3">
                <label class="form-label" for="parent">Ős kategória ("-", ha nincs)</label>
                <select name='parent' class="form-select" aria-label="Parent Category">
                    @foreach ($mainCategories as $category)
                        <option value='{{ $category->id }}'>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Kategória neve</label>
                <input type="text" class="form-control" name="name">
            </div>

            <input type="submit" value="Létrehoz" class="btn btn-primary">
        </form>

    </div>

</x-admin-layout>