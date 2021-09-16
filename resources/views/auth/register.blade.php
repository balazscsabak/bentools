<x-app-layout>

    <div class="container">
        
        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        <div class="row justify-content-center my-4">
            <div class="col-12 col-lg-7">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        {{ $message }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register.store') }}">
                    @csrf
        
                    <!-- Name -->
                    <div class="row">
                        <div class="col-12 col-md-6">
        
                            <div>
                                <label class="form-label">Vezetéknév</label>
                                <input type="text" class="form-control" required name="lastname">
                            </div>

                            @error('lastname')
                                <div class="ms-3 mt-1 mb-2 p-0 text-danger">Hiányzó adat</div>
                            @enderror
        
                        </div>
        
                        <div class="col-12 col-md-6">
        
                            <div>
                                <label class="form-label">Keresztnév</label>
                                <input type="text" class="form-control" name="firstname" required value="">
                            </div>
        
                            @error('firstname')
                                <div class="ms-3 mt-1 mb-2 p-0 text-danger">Hiányzó adat</div>
                            @enderror
                        </div>
        
                    </div>
        
                    <!-- Email Address -->
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">{{ __('Email')}}</label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required />
                        </div>

                        @error('email')
                            <div class="mt-1 mb-2 ms-3 p-0 text-danger">Ezzel az email címmel már regisztráltak nálunk!</div>
                        @enderror

                        <div class="col-12">
                            <label class="form-label">{{ __('Jelszó')}}</label>
                            <input class="form-control" type="password" name="password" required />
                        </div>
                        @error('password')
                            <div class="ms-3 mt-1 mb-2 p-0 text-danger">A két jelszó nem egyezik</div>
                        @enderror
                        <div class="col-12">
                            <label class="form-label">{{ __('Jelszó megerősítése')}}</label>
                            <input class="form-control" type="password" name="password_confirmation" required />
                        </div>
                    </div>
        
                    <div class="d-flex justify-content-center my-4">
                        <button type="submit" class="btn btn-primary">{{ __('Regisztráció') }}</button>
                    </div>
        
                   
        
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Már regisztrált?') }}
                        </a>
        
                    </div>
                </form>
            </div>
        </div>


    </div>
</x-app-layout>
