<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bentools</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">


    </head>
    <body class="font-sans antialiased">

        <!-- Nav -->
        @include('includes.admin.navbar')

        <div class="container">
    
            <!-- Page Content -->
            <div class="main">
                {{ $slot }}
            </div>
            
        </div>
        
        <!-- Scripts -->
        
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/admin.js') }}"></script>

        {{ $scripts ?? '' }}
    </body>
</html>
