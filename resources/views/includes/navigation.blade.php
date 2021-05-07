<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Termékek
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/products">Összes termék</a></li>
                        @foreach ($products as $product)
                            <li><a class="dropdown-item" href="{{ route('product', $product->slug) }}">{{ $product->name }}</a></li>
                        @endforeach
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
            
        </div>
    </div>
</nav>
