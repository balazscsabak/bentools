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

        @if ($errors->any())
            <div class="alert alert-danger alert-block">
            
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                
            </div>
        @endif

        <h2 class="mb-3">
            Rólunk
        </h2>
    
        <form action="{{ route('admin.aboutus.update') }}" method="post">
            @method('PUT')
            @csrf
            
            <div class="mb-3">
                <h5 for="about-us-content" class="mb-3">Megjelenő szöveg</h5>
                <textarea id="about-us-content" name="content">{{ $content }}</textarea>
            </div>
            
            <input type="submit" value="Módosítás" class="btn btn-sm btn-primary">
        </form>

    </div>

</x-admin-layout>
