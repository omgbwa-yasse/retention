<nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
    <div class="container-fluid">
        <!-- Logo/Brand -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <i class="fas fa-book-reader"></i>
            <span>African Retention</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Menu principal -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#">
                        <i class="fas fa-users"></i>
                        <span>Équipe</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#">
                        <i class="fas fa-hand-holding-heart"></i>
                        <span>Soutenir</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('subject.index') }}">
                        <i class="fas fa-blog"></i>
                        <span>Forum</span>
                    </a>
                </li>
            </ul>

            <!-- Barre de recherche -->
            <form class="d-flex mx-lg-3 mb-2 mb-lg-0" action="{{ route('search.advanced') }}" method="GET">
                <div class="input-group">
                    <input type="search" name="query" class="form-control form-control-sm bg-light" placeholder="Rechercher...">
                    <button class="btn btn-light btn-sm" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    <a class="btn btn-light btn-sm" href="{{ route('search.advanced') }}">
                        <i class="fas fa-sliders-h"></i>
                    </a>
                </div>
            </form>

            <!-- Menu utilisateur -->
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>{{ __('Login') }}</span>
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i>
                                <span>{{ __('Register') }}</span>
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#"
                           id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                   href="{{ route('user.show', Auth::user()->id) }}">
                                    <i class="fas fa-user"></i>
                                    <span>Profil</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                   href="{{ route('user.show', Auth::user()->id) }}">
                                    <i class="fas fa-cog"></i>
                                    <span>Paramètres</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger"
                                   href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>{{ __('Logout') }}</span>
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
