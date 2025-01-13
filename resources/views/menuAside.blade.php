@guest
@else
    <aside class="sidebar bg-dark">
        <nav class="nav-menu">
            <ul class="nav flex-column">
                <!-- Search -->
                <li class="nav-item">
                    <a class="nav-link link-light d-flex align-items-center" data-bs-toggle="collapse" href="#recherche">
                        <i class="bi bi-search"></i>
                        <span>{{ __('Recherche') }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul class="collapse show nav flex-column" id="recherche">
                        <li><a href="{{ route('charter.index') }}" class="nav-link link-light"><i class="bi bi-list-check"></i>{{ __('Tableau de gestion') }}</a></li>
                        <li><a href="{{ route('mission.index') }}" class="nav-link link-light"><i class="bi bi-list-check"></i>{{ __('Domaines') }}</a></li>
                        <li><a href="{{ route('activity.index') }}" class="nav-link link-light"><i class="bi bi-list-check"></i>{{ __('Activités') }}</a></li>
                        <li><a href="{{ route('rule.index') }}" class="nav-link link-light"><i class="bi bi-list-check"></i>{{ __('Règles') }}</a></li>
                        <li><a href="{{ route('typology.index') }}" class="nav-link link-light"><i class="bi bi-list-check"></i>{{ __('Typologies') }}</a></li>
                        <li><a href="{{ route('reference.index') }}" class="nav-link link-light"><i class="bi bi-list-check"></i>{{ __('Références') }}</a></li>
                    </ul>
                </li>

                <!-- Add -->
                <li class="nav-item">
                    <a class="nav-link link-light d-flex align-items-center" data-bs-toggle="collapse" href="#ajouter">
                        <i class="bi bi-plus-circle"></i>
                        <span>{{ __('Ajouter') }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul class="collapse show nav flex-column" id="ajouter">
                        <li><a href="{{ route('activity.create') }}" class="nav-link link-light"><i class="bi bi-plus-square"></i>{{ __('Classe') }}</a></li>
                        <li><a href="{{ route('mission.create') }}" class="nav-link link-light"><i class="bi bi-plus-square"></i>{{ __('Domaine') }}</a></li>
                        <li><a href="{{ route('rule.create') }}" class="nav-link link-light"><i class="bi bi-plus-square"></i>{{ __('Règle') }}</a></li>
                        <li><a href="{{ route('typology.create') }}" class="nav-link link-light"><i class="bi bi-plus-square"></i>{{ __('Typologie') }}</a></li>
                        <li><a href="{{ route('reference.create') }}" class="nav-link link-light"><i class="bi bi-plus-square"></i>{{ __('Référence') }}</a></li>
                    </ul>
                </li>

                <!-- Control -->
                <li class="nav-item">
                    <a class="nav-link link-light d-flex align-items-center" data-bs-toggle="collapse" href="#controle">
                        <i class="bi bi-shield-check"></i>
                        <span>{{ __('Contrôle') }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul class="collapse show nav flex-column" id="controle">
                        <li><a href="{{ route('committee.index') }}" class="nav-link link-light"><i class="bi bi-check-circle"></i>{{ __('Projet de règles') }}</a></li>
                        <li><a href="{{ route('committee.examining') }}" class="nav-link link-light"><i class="bi bi-check-circle"></i>{{ __('Règles en examen') }}</a></li>
                        <li><a href="{{ route('committee.approved') }}" class="nav-link link-light"><i class="bi bi-hourglass-split"></i>{{ __('Règles approuvées') }}</a></li>
                    </ul>
                </li>

                <!-- Settings -->
                <li class="nav-item">
                    <a class="nav-link link-light d-flex align-items-center" data-bs-toggle="collapse" href="#parametre">
                        <i class="bi bi-gear"></i>
                        <span>{{ __('Paramètres') }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul class="collapse show nav flex-column" id="parametre">
                        <li><a href="{{ route('user.show', Auth::user()->id) }}" class="nav-link link-light"><i class="bi bi-person-circle"></i>{{ __('Mon compte') }}</a></li>
                        <li><a href="{{ route('setting.index') }}" class="nav-link link-light"><i class="bi bi-sliders"></i>{{ __('Généraux') }}</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>

    <style>
        .sidebar {
            width: 200px;
            min-height: 100vh;
            background-color: #212529;
        }

        .nav-menu .nav-link {
            padding: 8px 12px;
            color: rgba(255, 255, 255, 0.85);
        }

        .nav-menu .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .nav-menu .nav-link i {
            font-size: 14px;
        }

        .nav-menu .nav-link span {
            margin-left: 8px;
            margin-right: auto;
        }

        .nav-menu .bi-chevron-down {
            font-size: 12px;
            margin-left: 4px;
        }

        .nav-menu .collapse .nav-link {
            padding: 6px 12px 6px 32px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.75);
        }

        .nav-menu .collapse .nav-link:hover {
            color: #fff;
        }

        .nav-menu .collapse .nav-link i {
            margin-right: 6px;
        }

        .nav-item {
            margin-bottom: 2px;
        }
    </style>
@endguest
