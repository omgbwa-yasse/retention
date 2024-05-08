@guest
@else
    <div id="container">
        <div id="content">
            <aside id="sous-menu" class="bg-light" style="min-height: 100vh;">
                <ul class="nav flex-column">
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
                                <li><a href="{{ route('setting.index') }}" class="text-dark"><i class="bi bi-person-circle"></i> Mon compte</a></li>
                                <li><a href="{{ route('setting.index') }}" class="text-dark"><i class="bi bi-sliders"></i> Généraux</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link bg-dark text-white" data-toggle="collapse" href="#forum"><i
                                class="bi bi-chat-dots"></i> Forum</a>
                        <div class="collapse" id="forum">
                            <ul class="list-unstyled pl-3">
                                <li><a href="{{ route('forum.subject.index') }}" class="text-dark"><i class="bi bi-chat-square-dots"></i> Nouveautés</a></li>
                                <li><a href="{{ route('forum.subject.basket') }}" class="text-dark"><i class="bi bi-chat-square-dots"></i> Sujets épinglés</a></li>
                                <li><a href="{{ route('forum.subject.online') }}" class="text-dark"><i class="bi bi-chat-square-dots"></i> En ligne</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </aside>
        </div>
    </div>
@endguest
