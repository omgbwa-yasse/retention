@guest
@else
    <!-- Pour debug -->
    <div >

    </div>
    <aside class="sidebar bg-dark" style="width: 220px;">
        <nav class="nav-menu">
            <ul class="nav flex-column py-2">
                <!-- Search -->
                <li class="nav-item">
                    <a class="nav-link link-light d-flex align-items-center py-2" data-bs-toggle="collapse" href="#recherche">
                        <i class="bi bi-search"></i>
                        <span class="ms-2 me-auto">{{ __('Recherche') }}</span>
                        <i class="bi bi-chevron-down fs-8"></i>
                    </a>
                    <ul class="collapse show nav flex-column ps-3 small" id="recherche">
                        <li><a href="{{ route('charter.index') }}" class="nav-link link-light py-1"><i class="bi bi-list-check"></i><span class="ms-2">{{ __('Tableau de gestion') }}</span></a></li>
                        <li><a href="{{ route('mission.index') }}" class="nav-link link-light py-1"><i class="bi bi-list-check"></i><span class="ms-2">{{ __('Domaines') }}</span></a></li>
                        <li><a href="{{ route('activity.index') }}" class="nav-link link-light py-1"><i class="bi bi-list-check"></i><span class="ms-2">{{ __('Activités') }}</span></a></li>
                        <li><a href="{{ route('rule.index') }}" class="nav-link link-light py-1"><i class="bi bi-list-check"></i><span class="ms-2">{{ __('Règles') }}</span></a></li>
                        <li><a href="{{ route('typology.index') }}" class="nav-link link-light py-1"><i class="bi bi-list-check"></i><span class="ms-2">{{ __('Typologies') }}</span></a></li>
                        <li><a href="{{ route('reference.index') }}" class="nav-link link-light py-1"><i class="bi bi-list-check"></i><span class="ms-2">{{ __('Références') }}</span></a></li>
                    </ul>
                </li>

                <!-- Add -->
                <li class="nav-item">
                    <a class="nav-link link-light d-flex align-items-center py-2" data-bs-toggle="collapse" href="#ajouter">
                        <i class="bi bi-plus-circle"></i>
                        <span class="ms-2 me-auto">{{ __('Ajouter') }}</span>
                        <i class="bi bi-chevron-down fs-8"></i>
                    </a>
                    <ul class="collapse show nav flex-column ps-3 small" id="ajouter">
                        <li><a href="{{ route('activity.create') }}" class="nav-link link-light py-1"><i class="bi bi-plus-square"></i><span class="ms-2">{{ __('Classe') }}</span></a></li>
                        <li><a href="{{ route('mission.create') }}" class="nav-link link-light py-1"><i class="bi bi-plus-square"></i><span class="ms-2">{{ __('Domaine') }}</span></a></li>
                        <li><a href="{{ route('rule.create') }}" class="nav-link link-light py-1"><i class="bi bi-plus-square"></i><span class="ms-2">{{ __('Règle') }}</span></a></li>
                        <li><a href="{{ route('typology.create') }}" class="nav-link link-light py-1"><i class="bi bi-plus-square"></i><span class="ms-2">{{ __('Typologie') }}</span></a></li>
                        <li><a href="{{ route('reference.create') }}" class="nav-link link-light py-1"><i class="bi bi-plus-square"></i><span class="ms-2">{{ __('Référence') }}</span></a></li>
                    </ul>
                </li>

                <!-- Control -->
                <li class="nav-item">
                    <a class="nav-link link-light d-flex align-items-center py-2" data-bs-toggle="collapse" href="#controle">
                        <i class="bi bi-shield-check"></i>
                        <span class="ms-2 me-auto">{{ __('Contrôle') }}</span>
                        <i class="bi bi-chevron-down fs-8"></i>
                    </a>
                    <ul class="collapse show nav flex-column ps-3 small" id="controle">
                        <li><a href="{{ route('committee.index') }}" class="nav-link link-light py-1"><i class="bi bi-check-circle"></i><span class="ms-2">{{ __('Projet de règles') }}</span></a></li>
                        <li><a href="{{ route('committee.examining') }}" class="nav-link link-light py-1"><i class="bi bi-check-circle"></i><span class="ms-2">{{ __('Règles en examen') }}</span></a></li>
                        <li><a href="{{ route('committee.approved') }}" class="nav-link link-light py-1"><i class="bi bi-hourglass-split"></i><span class="ms-2">{{ __('Règles approuvées') }}</span></a></li>
                    </ul>
                </li>

                <!-- Settings -->
                <li class="nav-item">
                    <a class="nav-link link-light d-flex align-items-center py-2" data-bs-toggle="collapse" href="#parametre">
                        <i class="bi bi-gear"></i>
                        <span class="ms-2 me-auto">{{ __('Paramètres') }}</span>
                        <i class="bi bi-chevron-down fs-8"></i>
                    </a>
                    <ul class="collapse show nav flex-column ps-3 small" id="parametre">
                        <li><a href="{{ route('user.show', Auth::user()->id) }}" class="nav-link link-light py-1"><i class="bi bi-person-circle"></i><span class="ms-2">{{ __('Mon compte') }}</span></a></li>
                        <li><a href="{{ route('setting.index') }}" class="nav-link link-light py-1"><i class="bi bi-sliders"></i><span class="ms-2">{{ __('Généraux') }}</span></a></li>
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
