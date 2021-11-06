<x-app-layout>

    <div class="message-page pb-5">
        <div class="container">

            <div class="d-flex justify-content-center">
                <div class="col-12 col-md-7">
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

                    <div class="message">

                        <h1>
                            Üzenet küldése
                        </h1>

                        <div class="icon">
                            <i class="fas fa-comment-dots"></i>
                        </div>
                        <p>
                            Küldjön üzenetet az alábbi formon keresztül és mi felvesszük Önnel a kapcsolatot!
                        </p>

                        <form action="{{ route('message.store') }}" method="post">
                            @csrf

                            <div class="col-12 mb-2">
                                <label for="full_name" class="form-label">Teljes név</label>
                                <input value="{{ old('full_name') }}" name="full_name" type="text" class="form-control" id="full_name">
                                @error('full_name')
                                    <div class="alert alert-danger mt-2 py-1">Hibás adatot adtál meg!</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <label for="firm_name" class="form-label">Cég név</label>
                                <input value="{{ old('firm_name') }}" name="firm_name" type="text" class="form-control" id="firm_name">
                                @error('firm_name')
                                    <div class="alert alert-danger mt-2 py-1">Hibás adatot adtál meg!</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input value="{{ old('email') }}" name="email" type="email" class="form-control" id="email">
                                @error('email')
                                    <div class="alert alert-danger mt-2 py-1">Hibás adatot adtál meg!</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <label for="phone_number" class="form-label">Telefonszám</label>
                                <input value="{{ old('phone_number') }}" name="phone_number" type="text" class="form-control" id="phone_number">
                                @error('phone_number')
                                    <div class="alert alert-danger mt-2 py-1">Hibás adatot adtál meg!</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label for="message" class="form-label">Üzenet</label>
                                <textarea name="message" class="form-control" id="message">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="alert alert-danger mt-2 py-1">Hibás adatot adtál meg!</div>
                                @enderror
                            </div>

                            {{-- <div class="form-group mt-4 mb-4 d-flex">
                                <div class="captcha d-flex">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-primary" class="reload" id="reload">
                                        ↻
                                    </button>
                                </div>
                            </div> --}}
    
                            {{-- <div class="form-group mb-4">
                                <input id="captcha" type="text" class="form-control" placeholder="Mit lát a képen?" name="captcha">
                                @error('captcha')
                                    <div class="alert alert-danger mt-2 py-1">Hibás adatot adtál meg!</div>
                                @enderror
                            </div> --}}

                            <div class="d-flex justify-content-center mb-3">
                                {!! NoCaptcha::display() !!}
                            </div>
                            @if ($errors->has('g-recaptcha-response'))
                                <div class=" text-danger mb-3 text-center">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </div>
                            @endif

                            <div class="submit">
                                <input type="submit" value="Küldés" class="btn btn-primary btn-sm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        
        </div>
    </div>

    {!! NoCaptcha::renderJs('hu') !!}
</x-app-layout>
