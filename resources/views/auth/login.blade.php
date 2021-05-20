<x-app-layout>
 

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="row justify-content-center my-5">
            
            <div class="col-5">
                
                <!-- Email Address -->
                <div class="mb-3">
                    <label for="emails" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Jelszó</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <!-- Remember Me -->
                <div class="mb-3">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary">Bejelentkezés</button>
                </div>

            </div>
        </div>

    </form>
</x-app-layout>
