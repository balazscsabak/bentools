<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bentools</title>

        <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GA_ID') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '{{ env('GA_ID') }}');
        </script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

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
                            <a class="text-white" href="{{ route('terms') }}">ÁSZF</a>
                        </div>
                        
                        <div class="mx-3 text-center">
                            <a class="text-white" href="{{ route('policy') }}">Adatvédelmi nyilatkozat</a>
                        </div>

                        <div class="mx-3 text-center">
                            <a class="text-white" href="{{ route('cookie') }}">Cookie Szabályzat</a>
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

        <div id="shopping-cart">
            <div class="cart-toggler close-cart-abs">
                <i class="fas fa-times"></i>
            </div>

            <div class="cart-header">
                <h1>Kosár</h1>
            </div>

            <div class="cart-items">

                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Termék</th>
                            <th class="text-end pe-3" scope="col">Ár</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                
            </div>

            <div class="text-center mb-4">
                <div><small>Minimum rendelés 6000 Ft.</small></div>
                <div><small><a href="{{ route('offer') }}" class="text-light">Kérjen árajánlatot</a></small></div>
            </div>

            <div id="cart-buttons" class="text-center">
                <a href="{{ route('cart') }}" class="shadow-sm border-dark border-1 btn btn-warning px-5 border">Kosár megtekintése</a>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.4.0/dist/lazyload.min.js"></script>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        <script>
            $(() => {
                var cookieConsent = new CookieConsent({
                    privacyPolicyUrl: "/cookie",
                    position: "right",
                    lang: "hu",
                    content: { 
                        hu: {
                            title: "Cookie beállítások",
                            body: "Weboldalunk cookie-kat (sütiket) használ a forgalom mérésére és a felhasználói élmény biztosításához. Az „Elfogadás” gombra kattintva hozzájárul az összes süti használatához. További informació: --privacy-policy--.",
                            privacyPolicy: "Cookie szabályzat",
                            buttonAcceptAll: "Összes cookie elfogadása",
                            buttonAcceptTechnical: "Csak a műszakilag szükséges cookiek elfogadása"
                        }
                    }
                })

            })
        </script>
    </body>
</html>
