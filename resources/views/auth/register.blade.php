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

                <h2 class="mb-4">
                    Regisztráció
                </h2>

                <form id="registration-form" method="POST" action="{{ route('register.store') }}">
                    @csrf
        
                    <!-- Name -->
                    <div class="row">
                        <div class="col-12 col-md-6">
        
                            <div>
                                <label class="form-label">Vezetéknév</label>
                                <input value="test" type="text" class="form-control" required name="lastname">
                            </div>

                            @error('lastname')
                                <div class="ms-3 mt-1 mb-2 p-0 text-danger">Hiányzó adat</div>
                            @enderror
        
                        </div>
        
                        <div class="col-12 col-md-6">
        
                            <div>
                                <label class="form-label">Keresztnév</label>
                                <input value="test" type="text" class="form-control" name="firstname" required value="">
                            </div>
        
                            @error('firstname')
                                <div class="ms-3 mt-1 mb-2 p-0 text-danger">Hiányzó adat</div>
                            @enderror
                        </div>
        
                    </div>
        
                    <!-- Email Address -->
                    <div class="row">
                        <div class="col-12 mt-3">
                            <label class="form-label">{{ __('Email')}}</label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required />
                        </div>

                        @error('email')
                            <div class="mt-1 mb-2 ms-3 p-0 text-danger">Ezzel az email címmel már regisztráltak nálunk!</div>
                        @enderror

                        <div class="col-12 mt-3">
                            <label class="form-label">{{ __('Jelszó')}}</label>
                            <input value="test" class="form-control" type="password" name="password" required />
                        </div>
                        @error('password')
                            <div class="ms-3 mt-1 mb-2 p-0 text-danger">A két jelszó nem egyezik</div>
                        @enderror
                        <div class="col-12 mt-3">
                            <label class="form-label">{{ __('Jelszó megerősítése')}}</label>
                            <input value="test" class="form-control" type="password" name="password_confirmation" required />
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-6">
                            <label class="form-label">Cégnév</label>
                            <input value="test" class="form-control" type="text" name="firm_name" required />
                        </div>

                        <div class="col-6 ">
                            <label class="form-label">Adószám</label>
                            <input value="test" class="form-control" type="text" name="tax_number" required />
                        </div>

                        <div class="col-6 mt-3">
                            <label class="form-label">Telefonszám</label>
                            <input value="test" class="form-control" type="text" name="phone_number" required />
                        </div>
                    </div>
                    
                    <div class="row mt-5">
                        <div class="col-6">
                            <h6>Szállítási információk</h6>

                            <div>
                                <label class="form-label">Irányítószám</label>
                                <input value="test" class="form-control" type="text" name="shipping_postcode" required />
                            </div>
                            <div>
                                <label class="form-label mt-3">Megye</label>
                                <input value="test" class="form-control" type="text" name="shipping_county" required />
                            </div>
                            <div>
                                <label class="form-label mt-3">Város</label>
                                <input value="test" class="form-control" type="text" name="shipping_city" required />
                            </div>
                            <div>
                                <label class="form-label mt-3">Utca/házszám</label>
                                <input value="test" class="form-control" type="text" name="shipping_street" required />
                            </div>
                        </div>
                        <div class="col-6">
                            <h6>Számlázási információk</h6>

                            <div>
                                <div>
                                    <label class="form-label">Irányítószám</label>
                                    <input value="test" class="form-control" type="text" name="billing_postcode" required />
                                </div>
                                <div>
                                    <label class="form-label mt-3">Megye</label>
                                    <input value="test" class="form-control" type="text" name="billing_county" required />
                                </div>
                                <div>
                                    <label class="form-label mt-3">Város</label>
                                    <input value="test" class="form-control" type="text" name="billing_city" required />
                                </div>
                                <div>
                                    <label class="form-label mt-3">Utca/házszám</label>
                                    <input value="test" class="form-control" type="text" name="billing_street" required />
                                </div>
                            </div>
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
