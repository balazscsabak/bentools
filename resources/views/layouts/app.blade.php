<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased d-flex flex-column h-100">
        
        @include('includes.navigation', ['products' => $products])
        
        <!-- Page Content -->
        <main class="flex-shrink-0">
            {{ $slot }}
        </main>
        
        <footer class="footer mt-auto py-4 bg-light">
            <div class="container">
                <div class="row">
                    
                    <div class="d-flex justify-content-center flex-column flex-md-row">
                        <div class="mx-3 text-center">
                            ÁSZF
                        </div>
                        
                        <div class="mx-3 text-center">
                            Adatvédelmi nyilatkozat
                        </div>

                        <div class="mx-3 text-center">
                            Cookie Szabályzat
                        </div>
                     
                    </div>

                    <a href="#" class="my-2">
                        <img class="mx-auto my-2" src="{{ asset('images/KIMATools_RGB.png') }}" alt="">
                    </a>

                    <div class="text-center">
                        © 2021 Kimatools – www.kimatools.hu
                    </div>

                </div>
            </div>
        </footer>
    </body>
</html>
