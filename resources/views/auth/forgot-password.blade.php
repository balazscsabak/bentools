<x-app-layout>

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-12 col-md-4">
                <div class="mb-4 fs-4 text-center mt-3 text-gray-600">
                    {{ __('Elfelejtett jelszó') }}
                </div>

                @if ($errors->any())
                    <div class="alert text-center mt-3 alert-danger">
                        @foreach ($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if ($message = Session::get('status'))
                    <div class="alert mt-3 alert-success text-center alert-block">
                        {{ $message }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="form-label">{{__('Email cím')}}</label>
                        
                        <input  type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus />
                    </div>
                    
                    <p class="text-center mt-3">
                        {{ __('Az emailben található linkre kattintva megadhatja az új jelszavát') }}
                    </p>

                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-primary text-uppercase mx-auto">
                            {{ __('Email küldése') }}
                        </button>
                    </div>
                </form>
                                
            </div>
        </div>

    </div>

</x-app-layout>
