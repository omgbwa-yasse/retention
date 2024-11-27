@guest
@else
    <aside class="sidebar bg-dark" style="width: 220px;">
        <nav class="nav-menu">
            <ul class="nav flex-column py-2">
                <!-- Recherche -->
                <li class="nav-item">
                    <a class="nav-link link-light d-flex align-items-center py-2" data-bs-toggle="collapse" href="#recherche">
                        <i class="bi bi-search"></i>
                        <span class="ms-2 me-auto">Recherche</span>
                        <i class="bi bi-chevron-down fs-8"></i>
                    </a>
                    <ul class="collapse show nav flex-column ps-3 small" id="recherche">
                        <li><a href="{{ route('charter.index') }}" class="nav-link link-light py-1"><i class="bi bi-list-check"></i><span class="ms-2">Tableau de gestion</span></a></li>
                        <li><a href="{{ route('mission.index') }}" class="nav-link link-light py-1"><i class="bi bi-list-check"></i><span class="ms-2">Domaines</span></a></li>
                        <li><a href="{{ route('activity.index') }}" class="nav-link link-light py-1"><i class="bi bi-list-check"></i><span class="ms-2">Activités</span></a></li>
                        <li><a href="{{ route('rule.index') }}" class="nav-link link-light py-1"><i class="bi bi-list-check"></i><span class="ms-2">Règles</span></a></li>
                        <li><a href="{{ route('typology.index') }}" class="nav-link link-light py-1"><i class="bi bi-list-check"></i><span class="ms-2">Typologies</span></a></li>
                        <li><a href="{{ route('reference.index') }}" class="nav-link link-light py-1"><i class="bi bi-list-check"></i><span class="ms-2">Références</span></a></li>
                    </ul>
                </li>

                <!-- Ajouter -->
                <li class="nav-item">
                    <a class="nav-link link-light d-flex align-items-center py-2" data-bs-toggle="collapse" href="#ajouter">
                        <i class="bi bi-plus-circle"></i>
                        <span class="ms-2 me-auto">Ajouter</span>
                        <i class="bi bi-chevron-down fs-8"></i>
                    </a>
                    <ul class="collapse show nav flex-column ps-3 small" id="ajouter">
                        <li><a href="{{ route('activity.create') }}" class="nav-link link-light py-1"><i class="bi bi-plus-square"></i><span class="ms-2">Classe</span></a></li>
                        <li><a href="{{ route('mission.create') }}" class="nav-link link-light py-1"><i class="bi bi-plus-square"></i><span class="ms-2">Domaine</span></a></li>
                        <li><a href="{{ route('rule.create') }}" class="nav-link link-light py-1"><i class="bi bi-plus-square"></i><span class="ms-2">Règle</span></a></li>
                        <li><a href="{{ route('typology.create') }}" class="nav-link link-light py-1"><i class="bi bi-plus-square"></i><span class="ms-2">Typologie</span></a></li>
                        <li><a href="{{ route('reference.create') }}" class="nav-link link-light py-1"><i class="bi bi-plus-square"></i><span class="ms-2">Référence</span></a></li>
                    </ul>
                </li>

{{--                <!-- Paniers -->--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link link-light d-flex align-items-center py-2" data-bs-toggle="collapse" href="#paniers">--}}
{{--                        <i class="bi bi-basket"></i>--}}
{{--                        <span class="ms-2 me-auto">Paniers</span>--}}
{{--                        <i class="bi bi-chevron-down fs-8"></i>--}}
{{--                    </a>--}}
{{--                    <ul class="collapse show nav flex-column ps-3 small" id="paniers">--}}
{{--                        <li><a href="{{ route('basket.index') }}" class="nav-link link-light py-1"><i class="bi bi-gear"></i><span class="ms-2">Gérer</span></a></li>--}}
{{--                        <li><a href="{{ route('basket.create') }}" class="nav-link link-light py-1"><i class="bi bi-plus-square"></i><span class="ms-2">Ajouter</span></a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

                <!-- Contrôle -->
                <li class="nav-item">
                    <a class="nav-link link-light d-flex align-items-center py-2" data-bs-toggle="collapse" href="#controle">
                        <i class="bi bi-shield-check"></i>
                        <span class="ms-2 me-auto">Contrôle</span>
                        <i class="bi bi-chevron-down fs-8"></i>
                    </a>
                    <ul class="collapse show nav flex-column ps-3 small" id="controle">
                        <li><a href="{{ route('committee.index') }}" class="nav-link link-light py-1"><i class="bi bi-check-circle"></i><span class="ms-2">Projet de règles</span></a></li>
                        <li><a href="{{ route('committee.examining') }}" class="nav-link link-light py-1"><i class="bi bi-check-circle"></i><span class="ms-2">Règles en examen</span></a></li>
                        <li><a href="{{ route('committee.approved') }}" class="nav-link link-light py-1"><i class="bi bi-hourglass-split"></i><span class="ms-2">Règles approuvées</span></a></li>
                    </ul>
                </li>

                <!-- Paramètres -->
                <li class="nav-item">
                    <a class="nav-link link-light d-flex align-items-center py-2" data-bs-toggle="collapse" href="#parametre">
                        <i class="bi bi-gear"></i>
                        <span class="ms-2 me-auto">Paramètres</span>
                        <i class="bi bi-chevron-down fs-8"></i>
                    </a>
                    <ul class="collapse show nav flex-column ps-3 small" id="parametre">
                        <li><a href="{{ route('user.show', Auth::user()->id) }}" class="nav-link link-light py-1"><i class="bi bi-person-circle"></i><span class="ms-2">Mon compte</span></a></li>
                        <li><a href="{{ route('setting.index') }}" class="nav-link link-light py-1"><i class="bi bi-sliders"></i><span class="ms-2">Généraux</span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>

    <style>
        .sidebar {
            min-height: 100vh;
            transition: width 0.3s;
        }

        .nav-menu .nav-link {
            border-radius: 4px;
            margin: 2px 8px;
            transition: all 0.2s;
        }

        .nav-menu .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-menu .nav-link i {
            font-size: 0.9rem;
        }

        .nav-menu .collapse {
            transition: all 0.2s;
        }

        .nav-menu .collapse .nav-link {
            padding-left: 0.5rem;
            opacity: 0.8;
        }

        .nav-menu .collapse .nav-link:hover {
            opacity: 1;
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-menu .bi-chevron-down {
            transition: transform 0.2s;
        }

        .nav-menu .collapsed .bi-chevron-down {
            transform: rotate(-90deg);
        }
    </style>
@endguest
