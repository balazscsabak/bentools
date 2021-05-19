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

        <h2>
            Kapcsolat
        </h2>
    
        <form action="{{ route('admin.contact.update') }}" method="post">
            
            @csrf
            
            <div class="mb-3">
                <label for="email" class="form-label">Email cím</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $email }}">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Telefonszám</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $phone }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Cím</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $address }}">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Megjelenő szöveg</label>
                <textarea class="form-control" id="message" name="message">{{ trim($contantMessage) }}</textarea>
            </div>
            
            <input type="submit" value="Módosítás" class="btn btn-sm btn-primary">
        </form>

    </div>
</x-admin-layout>

