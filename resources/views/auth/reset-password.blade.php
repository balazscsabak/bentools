<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-4">
                <div class="mb-4 fs-4 text-center mt-3 text-gray-600">
                    {{ __('Jelszóváltoztatás') }}
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

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="form-label">{{ __('Email cím') }}</label>

                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}" required  readonly/>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="form-label">{{ __('Új jelszó') }}</label>

                        <input id="password" class="form-control" type="password" name="password" required autofocus/>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <label for="password_confirmation" class="form-label">{{ __('Új jelszó megerősítése') }}</label>

                        <input id="password_confirmation" class="form-control"
                                            type="password"
                                            name="password_confirmation" required />
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button class="btn btn-primary text-uppercase mx-auto">
                            {{ __('Mentés') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
