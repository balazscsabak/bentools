<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/KIMATools_RGB.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Kezdőlap</a>
                </li>
                <li class="nav-item dropdown has-megamenu">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Termékek
                    </a>
                    <div class="dropdown-menu megamenu" aria-labelledby="navbarDropdownMenuLink">
                        <div class="row">
                            @foreach ($products as $cat => $product)
                                <div class="col">
                                    <p>{{ $cat }}</p>

                                    @foreach ($product as $p)
                                        <a class="dropdown-item" href="{{ route('product', $p->slug) }}">{{ $p->name }}</a>
                                    @endforeach
                                </div>
                            @endforeach
                            
                            <div class="col">
                                <a href="{{ route('products.all') }}">Összes termék</a>
                            </div>
                        </div>
                    </div>
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
            
        </div>
    </div>
</nav>
