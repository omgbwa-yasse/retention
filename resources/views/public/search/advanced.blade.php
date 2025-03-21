@extends('index')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10 mx-auto">
                <h1 class="text-center mb-4"><strong>{{ __('advanced_search') }}</strong></h1>

                <!-- Search form -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <form action="{{ route('public.search.advanced.results') }}" method="GET">
                            <!-- Recherche principale -->
                            <div class="mb-4">
                                <h5 class="mb-3">Mots clés</h5>
                                <input type="hidden" id="searchQuery" name="searchQuery" value="{{ request('searchQuery') }}">

                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg" id="newTerm"
                                            placeholder="Entrez vos termes de recherche">
                                        <button type="button" class="btn btn-primary" id="addTermBtn">
                                            <i class="bi bi-plus-lg"></i> Ajouter
                                        </button>
                                    </div>
                                    <div class="form-text">Ajoutez plusieurs mots clés pour affiner votre recherche</div>
                                </div>

                                <div id="searchTermsContainer" class="d-flex flex-wrap gap-2 mb-2">
                                    <!-- Tags de recherche ajoutés dynamiquement -->
                                    <div class="alert alert-info text-center w-100 mb-0 py-2" id="noTermsMessage">
                                        Ajoutez des mots clés pour commencer votre recherche
                                    </div>
                                </div>
                            </div>

                            <!-- Options de filtrage -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <h5 class="mb-0">Filtres</h5>
                                    <button type="button" class="btn btn-link ms-auto" id="resetFilters">
                                        <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                                    </button>
                                </div>

                                <div class="row g-3">
                                    <!-- Pays -->
                                    <div class="col-md-4">
                                        <label for="countries" class="form-label">Pays</label>
                                        <select class="form-select" id="countries" name="country">
                                            <option value="">Tous les pays</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" {{ request('country') == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }} ({{ $country->abbr }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Dates -->
                                    <div class="col-md-4">
                                        <label for="date_from" class="form-label">Date de début</label>
                                        <input type="date" class="form-control" id="date_from" name="date_from"
                                               value="{{ request('date_from') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="date_to" class="form-label">Date de fin</label>
                                        <input type="date" class="form-control" id="date_to" name="date_to"
                                               value="{{ request('date_to') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Bouton de recherche -->
                            <div>
                                <button type="submit" class="btn btn-primary btn-lg w-100" id="searchBtn">
                                    <i class="bi bi-search me-2"></i> Rechercher
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Résultats de recherche -->
                @if(isset($references) && $references->count() > 0)
                    <div class="border-0">
                        <div class="bg-light py-2 px-3 mb-3 d-flex align-items-center">
                            <h5 class="mb-0 fs-4">{{ __('search_results') }}</h5>
                            <span class="ms-2 badge bg-secondary">{{ $references->total() }} résultats</span>
                        </div>
                        <div class="list-unstyled">
                            @foreach($references as $value)
                                <div class="bg-white p-3 mb-3 rounded shadow-sm">
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="{{ route('public.references.show', $value['id']) }}" class="text-decoration-none">
                                            <h2 class="h5 fw-bold mb-0 text-primary hover-underline">{{ $value['name'] }}</h2>
                                        </a>
                                        <span class="badge {{ $value['type'] === 'reference' ? 'bg-success' : ($value['type'] === 'rule' ? 'bg-primary' : ($value['type'] === 'class' ? 'bg-secondary' : '')) }} ms-2">
                                            <i class="bi bi-book me-1"></i>
                                            {{ $value['type'] }}
                                        </span>
                                    </div>

                                    <p class="mb-3">{{ Str::limit($value['description'], 150) }}</p>

                                    <div class="d-flex flex-wrap text-muted small">
                                        @if(isset($value['country']))
                                            <div class="me-3 mb-1">
                                                <i class="bi bi-geo-alt"></i>
                                                <strong>{{ $value['country']['name'] }}</strong>
                                                @if(isset($value['country']['abbr']))
                                                    ({{ $value['country']['abbr'] }})
                                                @endif
                                            </div>
                                        @endif

                                        @if(isset($value['category']))
                                            <div class="me-3 mb-1">
                                                <i class="bi bi-folder"></i>
                                                <strong>{{ $value->category->name }}</strong>
                                            </div>
                                        @endif

                                        <div class="me-3 mb-1">
                                            <i class="bi bi-calendar"></i>
                                            @if(isset($value['created_at']))
                                                {{ date('d/m/Y', strtotime($value['created_at'])) }}
                                            @else
                                                {{ __('date_unavailable') }}
                                            @endif
                                        </div>

                                        @if(isset($value['user']))
                                            <div class="mb-1">
                                                <i class="bi bi-person"></i>
                                                {{ $value['user']['name'] }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mt-2">
                                        <a href="{{ route('public.references.show', $value['id']) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye me-1"></i> Voir le détail
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if(method_exists($references, 'links'))
                            <div class="d-flex justify-content-center mt-4">
                                {{ $references->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                @elseif(request()->has('searchQuery'))
                    <div class="alert alert-info text-center p-4 border-0 shadow-sm">
                        <i class="bi bi-search fs-4 mb-2 d-block"></i>
                        <p class="mb-0 fs-5">{{ __('no_results') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        input, textarea, select {
            box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .card {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 0.5rem;
        }

        .hover-underline:hover {
            text-decoration: underline !important;
        }

        /* Badges de termes de recherche */
        .search-term {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            background-color: #e3f2fd;
            color: #0d47a1;
            border: 1px solid #bbdefb;
            transition: all 0.2s;
        }

        .search-term:hover {
            background-color: #bbdefb;
        }

        .search-term-remove {
            margin-left: 0.75rem;
            font-size: 1.25rem;
            line-height: 1;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .search-term-remove:hover {
            opacity: 1;
        }

        /* Améliorations visuelles */
        .form-control-lg {
            height: calc(1.5em + 1rem + 2px);
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #90caf9;
            box-shadow: 0 0 0 0.25rem rgba(33, 150, 243, 0.15);
        }

        /* Styles RTL */
        @if(app()->getLocale() === 'ar')
        .container {
            direction: rtl;
            text-align: right;
        }
        .text-center {
            text-align: center !important;
        }
        .me-1, .me-2, .me-3 {
            margin-left: 0.5rem !important;
            margin-right: 0 !important;
        }
        .ms-2 {
            margin-right: 0.5rem !important;
            margin-left: 0 !important;
        }
        .bi {
            margin-left: 0.5rem;
            margin-right: 0;
        }
        .btn .bi {
            margin-left: 0.5rem;
            margin-right: 0;
        }
        .d-flex {
            flex-direction: row-reverse;
        }
        .input-group {
            flex-direction: row-reverse;
        }
        .pagination {
            flex-direction: row-reverse;
        }
        .search-term-remove {
            margin-right: 0.75rem;
            margin-left: 0;
        }
        @endif
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sélecteurs DOM
            const searchQueryInput = document.getElementById('searchQuery');
            const newTermInput = document.getElementById('newTerm');
            const addTermBtn = document.getElementById('addTermBtn');
            const searchTermsContainer = document.getElementById('searchTermsContainer');
            const noTermsMessage = document.getElementById('noTermsMessage');
            const resetFiltersBtn = document.getElementById('resetFilters');

            // Tableau des termes de recherche
            let searchTerms = [];

            // Initialiser les termes de recherche à partir du query existant
            if (searchQueryInput.value) {
                try {
                    const parsedValue = JSON.parse(searchQueryInput.value);
                    // Convertir l'ancien format avec sélecteurs au nouveau format simple
                    if (Array.isArray(parsedValue)) {
                        searchTerms = parsedValue.map(item => {
                            // Si c'est l'ancien format avec sélecteur, extraire uniquement le terme
                            if (item && typeof item === 'object' && item.term) {
                                return item.term;
                            }
                            // Si c'est déjà une chaîne simple, la conserver
                            return typeof item === 'string' ? item : '';
                        }).filter(term => term !== '');
                    }
                    renderSearchTerms();
                } catch (e) {
                    console.error('Erreur lors du parsing du query', e);
                }
            }

            // Ajouter un terme avec le bouton
            addTermBtn.addEventListener('click', function() {
                addSearchTerm();
            });

            // Ajouter un terme avec la touche Enter
            newTermInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addSearchTerm();
                }
            });

            // Réinitialiser les filtres
            resetFiltersBtn.addEventListener('click', function() {
                document.getElementById('countries').value = '';
                document.getElementById('date_from').value = '';
                document.getElementById('date_to').value = '';
            });

            function addSearchTerm() {
                const term = newTermInput.value.trim();
                if (term) {
                    // Éviter les doublons
                    if (!searchTerms.includes(term)) {
                        searchTerms.push(term);
                        newTermInput.value = '';
                        newTermInput.focus();
                        renderSearchTerms();
                        updateSearchInput();
                    } else {
                        // Avertir l'utilisateur que le terme existe déjà
                        highlightExistingTerm(term);
                    }
                }
            }

            function highlightExistingTerm(term) {
                const existingTerms = document.querySelectorAll('.search-term');
                existingTerms.forEach(termEl => {
                    if (termEl.textContent.trim().replace('×', '') === term) {
                        // Animation de mise en évidence
                        termEl.style.transform = 'scale(1.1)';
                        termEl.style.boxShadow = '0 0 0 3px rgba(25, 118, 210, 0.4)';

                        setTimeout(() => {
                            termEl.style.transform = '';
                            termEl.style.boxShadow = '';
                        }, 800);
                    }
                });
            }

            function renderSearchTerms() {
                // Vider le conteneur des termes de recherche
                Array.from(searchTermsContainer.children)
                    .filter(el => el.id !== 'noTermsMessage')
                    .forEach(el => el.remove());

                // Afficher ou masquer le message "pas de termes"
                noTermsMessage.style.display = searchTerms.length === 0 ? 'block' : 'none';

                // Créer les badges pour chaque terme
                searchTerms.forEach((term, index) => {
                    const termElement = document.createElement('div');
                    termElement.className = 'search-term';
                    termElement.innerHTML = `
                        ${term}
                        <span class="search-term-remove" data-index="${index}">&times;</span>
                    `;

                    searchTermsContainer.appendChild(termElement);
                });

                // Ajouter les écouteurs d'événements pour la suppression
                document.querySelectorAll('.search-term-remove').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-index'));
                        searchTerms.splice(index, 1);
                        renderSearchTerms();
                        updateSearchInput();
                    });
                });
            }

            function updateSearchInput() {
                searchQueryInput.value = JSON.stringify(searchTerms);
            }

            // Soumission du formulaire
            document.querySelector('form').addEventListener('submit', function(e) {
                // S'assurer que searchQuery est à jour
                updateSearchInput();

                // Ne soumettre que si des termes ont été ajoutés ou si des filtres sont définis
                if (searchTerms.length === 0 &&
                    !document.getElementById('countries').value &&
                    !document.getElementById('date_from').value &&
                    !document.getElementById('date_to').value) {
                    e.preventDefault();
                    alert('Veuillez ajouter au moins un mot clé ou sélectionner un filtre.');
                }
            });
        });
    </script>
@endsection
