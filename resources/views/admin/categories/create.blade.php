<x-admin-layout>

    <div class="container mt-3">
        
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div class="mb-3">
                <label for="parent">Parent Category</label>

                <select name='parent' class="form-select" aria-label="Parent Category">
                    <option value='1' selected>-</option>
                    
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