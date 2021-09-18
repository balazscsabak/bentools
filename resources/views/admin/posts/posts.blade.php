<x-admin-layout>
    
    <input type="hidden" id="hiddenAjaxUrl" value="{{ route('posts.index') }}">

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

        @if ($errors->any())
            <div class="alert alert-danger alert-block">
            
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                
            </div>
        @endif
        
        <h2 class="mb-4">Posztok</h2>
        <div>
            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">Új poszt</a>
        </div>
        <table class="table table-responsive table-hover yajra-datatable-posts">
            <thead >
                <tr class="table-dark">
                    <th>No</th>
                    <th>Cím</th>
                    <th>Létrejött</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</x-admin-layout>
