<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3850b7;">
    <div class="container">
        <!-- Logo/Brand -->
        <a class="navbar-brand d-flex align-items-center gap-2 py-2" href="{{ route('home') }}">
            <i class="fas fa-book-reader text-warning"></i>
            <span class="fw-bold">{{ __('portal_title') }}</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Sélecteur de langue -->
                <li class="nav-item dropdown me-2">
                    <button class="btn btn-outline-light btn-sm dropdown-toggle px-3 py-1 mt-1" type="button" id="langDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-globe me-1"></i>
                        {{ config('app.available_locales')[App::getLocale()] }}
                    </button>
                    <ul class="dropdown-menu shadow-sm">
                        @foreach(config('app.available_locales') as $locale => $label)
                            <li>
                                <a class="dropdown-item @if(App::getLocale() == $locale) active fw-bold @endif"
                                   href="{{ route('language.switch', $locale) }}">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item mx-1">
                    <a class="nav-link d-flex align-items-center gap-1 px-3 py-2" href="#">
                        <i class="fas fa-users"></i>
                        <span>{{ __('Team') }}</span>
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link d-flex align-items-center gap-1 px-3 py-2" href="#">
                        <i class="fas fa-hand-holding-heart"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link d-flex align-items-center gap-1 px-3 py-2" href="{{ route('subject.index') }}">
                        <i class="fas fa-blog"></i>
                        <span>{{ __('Forum') }}</span>
                    </a>
                </li>
            </ul>

            <!-- Barre de recherche -->
            <form class="d-flex mx-lg-3 mb-2 mb-lg-0" action="{{ route('search.advanced') }}" method="GET">
                <div class="input-group input-group-sm">
                    <input type="search" name="query" class="form-control border-0 ps-3"
                           placeholder="{{ __('Search') }}" style="border-radius: 4px 0 0 4px;">
                    <button class="btn btn-light border-0" type="submit" style="border-radius: 0;">
                        <i class="fas fa-search text-primary"></i>
                    </button>
                    <a class="btn btn-light border-0" href="{{ route('search.advanced') }}" title="{{ __('Advanced Search') }}" style="border-radius: 0 4px 4px 0;">
                        <i class="fas fa-sliders-h text-primary"></i>
                    </a>
                </div>
            </form>

            <!-- Menu utilisateur -->
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-light btn-sm px-3 py-1" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>
                            <span>{{ __('Login') }}</span>
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-light btn-sm text-primary px-3 py-1" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>
                                <span>{{ __('Register') }}</span>
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="btn btn-outline-light btn-sm dropdown-toggle d-flex align-items-center gap-2 px-3 py-1" href="#"
                           id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                   href="{{ route('user.show', Auth::user()->id) }}">
                                    <i class="fas fa-user text-primary"></i>
                                    <span>{{ __('Profile') }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                   href="{{ route('user.show', Auth::user()->id) }}">
                                    <i class="fas fa-cog text-primary"></i>
                                    <span>{{ __('Settings') }}</span>
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
