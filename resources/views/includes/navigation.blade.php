<nav class="navbar navbar-expand-lg fixed-top nav-frontend">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/KIMATools_RGB.png') }}" alt="">
        </a>
        <div class="custom-toggler-container">
            <div class="cart-toggler-menu">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse p-3 p-lg-0" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Kezdőlap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('aboutus') }}">Rólunk</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Termékek
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        
                        @foreach ($categories as $cat)
                            <li><a class="dropdown-item" href="{{ route('products.bycategory', $cat['slug']) }}">{{ $cat['name'] }}</a></li>
                        @endforeach
                        
                        <li class="dropdown-item">
                            <a href="{{ route('products.all') }}">Összes termék</a>
                        </li>
                    
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('offer') }}">Ajánlatkérés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shipping') }}">Szállítási információk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('message.index') }}">Üzenet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Kapcsolat</a>
                </li>
                
            </ul>

            <ul class="navbar-nav ms-auto">
                
                <li class="nav-item">
                    <a class="nav-link cart-toggler" href="#">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.profile') }}">
                            <i class="fas fa-user-circle"></i>
                        </a>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Bejelentkezés</a>
                    </li>
                @endguest
                
            </ul>
            
        </div>

    </div>
</nav>
