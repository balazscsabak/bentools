<x-admin-layout>

    <div class="container mt-3">
        
        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="parent">Parent Category</label>

                <select name='parent' class="form-select" aria-label="Parent Category">
                    <option value='1' {{$category->parent === 1 ? 'selected' : ''}}>-</option>
                    
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