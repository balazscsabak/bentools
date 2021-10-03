<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-admin">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.offers') }}">ADMIN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdownAdmin" aria-controls="navbarNavDropdownAdmin" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse p-3 p-lg-0 " id="navbarNavDropdownAdmin">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.orders') }}">Rendelések</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.offers') }}">Ajánlatkérések</a>
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.index') }}">Posztok</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Beállitások
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('admin.contact') }}">Kapcsolat</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.shipping') }}">Szállítási információk</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.offer.content') }}">Ajánlatkérés</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.aboutus') }}">Rólunk</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.cookie') }}">Cookie Szabályzat</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.policy') }}">Adatvédelmi nyilatkozat</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.terms') }}">ÁSZF</a></li>
                        <li><a class="dropdown-item" href="{{ route('settings.slideshow') }}">Slideshow</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.brochure') }}">Prospektus</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle h5 mb-0" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu--profile" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                        <div class="dropdown-divider"></div>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
        
                                <a class="dropdown-item" :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Kijelentkezés') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
