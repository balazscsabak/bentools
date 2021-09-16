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

        <h2 class="mb-3">Termékek</h2>

        <div class="mb-3">
            <a class="btn-primary btn btn-sm me-2" href="{{ route('products.create') }}">Új termék</a>
        </div>

        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Termék neve</th>
                    <th scope="col">Kategória</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $product)
                    
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td><a href="{{ route('products.show', $product->id) }}">Szerkesztés</a></td>
                    </tr>

                @endforeach
              
            </tbody>
        </table>

    </div>

</x-admin-layout>