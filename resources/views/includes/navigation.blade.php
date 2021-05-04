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
                    <a class="nav-link active" aria-current="page" href="{{ route('admin') }}">Kezdőlap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('messages') }}">Üzenetek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('media') }}">Média</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.index') }}">Kategóriák</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Termékek</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Termékek
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Elérhetőség</a></li>
                        <li><a class="dropdown-item" href="#">Szállítási információk</a></li>
                        <li><a class="dropdown-item" href="#">Szolgáltatások</a></li>
                        <li><a class="dropdown-item" href="#">Kinézet</a></li>
                    </ul>
                </li>
            </ul>
            
        </div>
    </div>
</nav>
