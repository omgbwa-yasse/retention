{{--<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0c9172;">--}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" >
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            African Retention Portail
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-users"></i> Equipe projet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-hand-holding-heart"></i> Nous soutenir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-blog"></i> Blog</a>
                </li>
            </ul>



            <form class="d-flex me-2" action="{{ route('search') }}" method="GET">
                <div class="input-group">
                    <input class="form-control" type="search" name="query" placeholder="Règle, Classe, Durée" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
                    <a  class="btn btn-outline-light" href="{{ route('search.advanced') }}">Avancer</a>
                </div>
            </form>
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> {{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <div class=" d-block d-md-none" id="navbarNavDropdown">
                        <ul class="nav flex-column bg-light">
                            <li class="nav-item">
                                <a class="nav-link active bg-dark text-white" data-toggle="collapse" href="#recherche"
                                   aria-expanded="true"><i class="bi bi-search"></i> Recherche</a>
                                <div class="collapse show" id="recherche">
                                    <ul class="list-unstyled pl-3">
                                        <li><a href="{{ route('charter.index') }}" class="text-dark"><i class="bi bi-list-check"></i> Tableau de gestion</a></li>
                                        <li><a href="{{ route('mission.index') }}" class="text-dark"><i  class="bi bi-list-check"></i> Domaines</a></li>
                                        <li><a href="{{ route('activity.index') }}" class="text-dark"><i class="bi bi-list-check"></i> Activités</a></li>
                                        <li><a href="{{ route('rule.index') }}" class="text-dark"><i class="bi bi-list-check"></i> Règles</a></li>
                                        <li><a href="{{ route('typology.index') }}" class="text-dark"><i class="bi bi-list-check"></i> Typologies</a></li>
                                        <li><a href="{{ route('reference.index') }}" class="text-dark"><i class="bi bi-list-check"></i> Références</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link bg-dark text-white" data-toggle="collapse" href="#ajouter"
                                   aria-expanded="true"><i class="bi bi-plus-circle"></i> Ajouter</a>
                                <div class="collapse show" id="ajouter">
                                    <ul class="list-unstyled pl-3">
                                        <li><a href="{{ route('activity.create') }}" class="text-dark"><i  class="bi bi-plus-square"></i> Classe</a></li>
                                        <li><a href="{{ route('mission.create') }}" class="text-dark"><i class="bi bi-plus-square"></i> Domaine</a></li>
                                        <li><a href="{{ route('rule.create') }}" class="text-dark"><i class="bi bi-plus-square"></i> Règle</a></li>
                                        <li><a href="{{ route('typology.create') }}" class="text-dark"><i class="bi bi-plus-square"></i> Typologie</a></li>
                                        <li><a href="{{ route('reference.create') }}" class="text-dark"><i class="bi bi-plus-square"></i> Référence</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link bg-dark text-white" data-toggle="collapse" href="#ajouter"
                                   aria-expanded="true"><i class="bi bi-plus-circle"></i> Paniers</a>
                                <div class="collapse show" id="ajouter">
                                    <ul class="list-unstyled pl-3">
                                        <li><a href="{{ route('basket.index') }}" class="text-dark"><i class="bi bi-plus-square"></i> Gérer</a></li>
                                        <li><a href="{{ route('basket.create') }}" class="text-dark"><i class="bi bi-plus-square"></i> Ajouter</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link bg-dark text-white" data-toggle="collapse" href="#controle" aria-expanded="true"><i
                                        class="bi bi-shield-check" ></i> Contrôle</a>
                                <div class="collapse" id="controle">
                                    <ul class="list-unstyled pl-3">
                                        <li><a href="{{ route('committee.project') }}" class="text-dark"><i class="bi bi-check-circle"></i> Projet de règles</a></li>
                                        <li><a href="{{ route('committee.examining') }}" class="text-dark"><i class="bi bi-check-circle"></i> Règles en examen</a></li>
                                        <li><a href="{{ route('committee.approved') }}" class="text-dark"><i class="bi bi-hourglass-split"></i> Règles approuvées</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bg-dark text-white" data-toggle="collapse" href="#parametre"><i
                                        class="bi bi-gear"></i> Paramètre</a>
                                <div class="collapse" id="parametre">
                                    <ul class="list-unstyled pl-3">
                                        <li>
                                            <a href="{{ route('user.show', Auth::user()->id) }}" class="text-dark">
                                                <i class="bi bi-person-circle"></i> Mon compte
                                            </a>
                                        </li>

                                        <li><a href="{{ route('setting.index') }}" class="text-dark"><i class="bi bi-sliders"></i> Généraux</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bg-dark text-white" data-toggle="collapse" href="#forum"><i
                                        class="bi bi-chat-dots"></i> Forum</a>
                                <div class="collapse" id="forum">
                                    <ul class="list-unstyled pl-3">
                                        <li><a href="{{ route('subject.index') }}" class="text-dark"><i class="bi bi-chat-square-dots"></i> Nouveautés</a></li>
                                        <li><a href="" class="text-dark"><i class="bi bi-chat-square-dots"></i> Sujets épinglés</a></li>
                                        <li><a href="{{ route('chat.index') }}" class="text-dark"><i class="bi bi-chat-square-dots"></i> En ligne</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>


                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.show', Auth::user()->id) }}"><i class="fas fa-user"></i> Profil</a>
                            <a class="dropdown-item" href="{{ route('user.show', Auth::user()->id) }}"><i class="fas fa-cog"></i> Paramètres</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
