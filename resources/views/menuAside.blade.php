@guest
@else
    <aside id="sous-menu" class=" " style="min-height: 100vh; width: 250px;">
        <nav class="navbar-dark">
            <ul class="nav flex-column pt-3">
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center" data-toggle="collapse" href="#recherche">
                        <i class="bi bi-search me-2"></i> Recherche
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse show" id="recherche">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item"><a href="{{ route('charter.index') }}" class="nav-link py-2"><i class="bi bi-list-check me-2"></i>Tableau de gestion</a></li>
                            <li class="nav-item"><a href="{{ route('mission.index') }}" class="nav-link py-2"><i class="bi bi-list-check me-2"></i>Activités</a></li>
                            <li class="nav-item"><a href="{{ route('activity.index') }}" class="nav-link py-2"><i class="bi bi-list-check me-2"></i>Domaines</a></li>
                            <li class="nav-item"><a href="{{ route('rule.index') }}" class="nav-link py-2"><i class="bi bi-list-check me-2"></i>Règles</a></li>
                            <li class="nav-item"><a href="{{ route('typology.index') }}" class="nav-link py-2"><i class="bi bi-list-check me-2"></i>Typologies</a></li>
                            <li class="nav-item"><a href="{{ route('reference.index') }}" class="nav-link py-2"><i class="bi bi-list-check me-2"></i>Références</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center" data-toggle="collapse" href="#ajouter">
                        <i class="bi bi-plus-circle me-2"></i> Ajouter
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse show" id="ajouter">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item"><a href="{{ route('activity.create') }}" class="nav-link py-2"><i class="bi bi-plus-square me-2"></i>Classe</a></li>
                            <li class="nav-item"><a href="{{ route('mission.create') }}" class="nav-link py-2"><i class="bi bi-plus-square me-2"></i>Domaine</a></li>
                            <li class="nav-item"><a href="{{ route('rule.create') }}" class="nav-link py-2"><i class="bi bi-plus-square me-2"></i>Règle</a></li>
                            <li class="nav-item"><a href="{{ route('typology.create') }}" class="nav-link py-2"><i class="bi bi-plus-square me-2"></i>Typologie</a></li>
                            <li class="nav-item"><a href="{{ route('reference.create') }}" class="nav-link py-2"><i class="bi bi-plus-square me-2"></i>Référence</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center" data-toggle="collapse" href="#paniers">
                        <i class="bi bi-basket me-2"></i> Paniers
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse show" id="paniers">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item"><a href="{{ route('basket.index') }}" class="nav-link py-2"><i class="bi bi-gear me-2"></i>Gérer</a></li>
                            <li class="nav-item"><a href="{{ route('basket.create') }}" class="nav-link py-2"><i class="bi bi-plus-square me-2"></i>Ajouter</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item ">
                    <a class="nav-link d-flex align-items-center" data-toggle="collapse" href="#controle">
                        <i class="bi bi-shield-check me-2"></i> Contrôle
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse show" id="controle">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item"><a href="{{ route('committee.index') }}" class="nav-link py-2"><i class="bi bi-check-circle me-2"></i>Projet de règles</a></li>
                            <li class="nav-item"><a href="{{ route('committee.examining') }}" class="nav-link py-2"><i class="bi bi-check-circle me-2"></i>Règles en examen</a></li>
                            <li class="nav-item"><a href="{{ route('committee.approved') }}" class="nav-link py-2"><i class="bi bi-hourglass-split me-2"></i>Règles approuvées</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center" data-toggle="collapse" href="#parametre">
                        <i class="bi bi-gear me-2"></i> Paramètres
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse show" id="parametre">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item"><a href="{{ route('user.show', Auth::user()->id) }}" class="nav-link py-2"><i class="bi bi-person-circle me-2"></i>Mon compte</a></li>
                            <li class="nav-item"><a href="{{ route('setting.index') }}" class="nav-link py-2"><i class="bi bi-sliders me-2"></i>Généraux</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </aside>
@endguest
