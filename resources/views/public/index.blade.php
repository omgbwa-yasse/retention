<!-- resources/views/public/index.blade.php -->
@extends('index')

@section('content')
    <div class="container-fluid py-4">
        <!-- En-tête avec barre de recherche -->
        <div class="bg-primary {{ !empty($searchQuery) ? 'py-3' : 'py-5' }} rounded-3 shadow-sm mb-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center text-white">
                        <h1 class="fw-bold {{ !empty($searchQuery) ? 'h2 mb-3' : 'display-4 mb-4' }}">
                            Portail africain des délais de conservation
                        </h1>

                        @if(empty($searchQuery))
                            <p class="lead mb-4 opacity-75">
                                Accédez aux informations sur les délais de conservation des documents en Afrique
                            </p>
                        @endif

                        <!-- Barre de recherche -->
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-10">
                                <form action="{{ route('public.search') }}" method="GET" id="searchForm">
                                    <div class="input-group input-group-lg shadow-sm bg-white rounded-pill">
                                    <span class="input-group-text border-0 bg-transparent ps-4">
                                        <i class="fas fa-search text-primary"></i>
                                    </span>
                                        <input
                                            type="search"
                                            name="q"
                                            class="form-control border-0"
                                            value="{{ $searchQuery ?? '' }}"
                                            placeholder="Rechercher des classifications, règles..."
                                            autocomplete="off"
                                        >
                                        <button type="submit" class="btn btn-light border-0 rounded-pill px-4">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <input type="hidden" name="order" value="{{ $currentOrder ?? 'asc' }}">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="container">
            <div class="row">
                <!-- Filtres -->
                <div class="col-lg-3">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Filtres</h5>
                                <button class="btn btn-sm btn-outline-secondary" onclick="resetFilters()">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </div>

                            <!-- Filtres -->
                            <div class="mb-3">
                                <label class="form-label">Pays</label>
                                <select name="country" class="form-select filter-select">
                                    <option value="">Tous les pays</option>
                                    @foreach($searchResults['filters']['countries'] ?? [] as $country)
                                        <option value="{{ $country->id }}"
                                            {{ $currentCountry == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Durée de conservation</label>
                                <select name="duration" class="form-select filter-select">
                                    <option value="">Toutes les durées</option>
                                    @foreach($searchResults['filters']['durations'] ?? [] as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ $currentDuration == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Trier par</label>
                                <div class="input-group">
                                    <select name="sort" class="form-select filter-select">
                                        @foreach($searchResults['filters']['sorts'] ?? [] as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ $currentSort == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button"
                                            class="btn btn-outline-secondary"
                                            onclick="toggleSort(this)"
                                            data-order="{{ $currentOrder ?? 'asc' }}">
                                        <i class="fas fa-sort-{{ ($currentOrder ?? 'asc') == 'asc' ? 'up' : 'down' }}"></i>
                                    </button>
                                </div>
                            </div>

                            <a href="{{ route('public.search', ['show_all' => 1]) }}"
                               class="btn btn-primary w-100">
                                <i class="fas fa-list me-1"></i> Tout afficher
                            </a>
                        </div>
                    </div>

                    @if(!empty($searchResults['classifications']))
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="mb-3">Typologies</h6>
                                <div class="typology-filters">
                                    @foreach($searchResults['classifications']->keys() as $typology)
                                        <div class="form-check">
                                            <input class="form-check-input filter-checkbox"
                                                   type="checkbox"
                                                   value="{{ $typology }}"
                                                   id="type-{{ $loop->index }}">
                                            <label class="form-check-label" for="type-{{ $loop->index }}">
                                                {{ $typology }}
                                                <span class="badge bg-light text-dark ms-1">
                                                {{ $searchResults['classifications'][$typology]->count() }}
                                            </span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Résultats -->
                <div class="col-lg-9">
                    @if(!empty($searchQuery) || request()->has('show_all'))
                        <!-- En-tête des résultats -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="mb-0">
                                    @if(!empty($searchQuery))
                                        Résultats pour "{{ $searchQuery }}"
                                    @else
                                        Toutes les classifications
                                    @endif
                                </h5>
                                <small class="text-muted">
                                    @if(isset($searchResults['classifications']))
                                        {{ $searchResults['classifications']->flatten()->count() }} classifications
                                    @endif
                                    @if(isset($searchResults['rules']))
                                        • {{ $searchResults['rules']->count() }} règles
                                    @endif
                                </small>
                            </div>
                        </div>

                        <!-- Classifications -->
                        @if(isset($searchResults['classifications']))
                            @foreach($searchResults['classifications'] as $typology => $classifications)
                                <div class="card shadow-sm border-0 mb-4 result-group"
                                     data-typology="{{ $typology }}">
                                    <div class="card-header bg-light border-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">
                                                {{ $typology }}
                                                <span class="badge bg-primary ms-2">
                                                {{ $classifications->count() }}
                                            </span>
                                            </h6>
                                            <button class="btn btn-sm btn-link"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#typology-{{ Str::slug($typology) }}">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="typology-{{ Str::slug($typology) }}">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th style="width: 15%">Code</th>
                                                    <th style="width: 40%">Intitulé</th>
                                                    <th style="width: 30%">Durée légale</th>
                                                    <th style="width: 15%" class="text-end">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($classifications as $classification)
                                                    <tr>
                                                        <td class="text-primary fw-bold">
                                                            {{ $classification->code }}
                                                        </td>
                                                        <td>
                                                            <div>{{ $classification->name }}</div>
                                                            @if($classification->description)
                                                                <small class="text-muted">
                                                                    {{ Str::limit($classification->description, 100) }}
                                                                </small>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($classification->rules)
                                                                @foreach($classification->rules as $rule)
                                                                    @if($rule->duls)
                                                                        @foreach($rule->duls as $dul)
                                                                            <div class="badge bg-light text-dark mb-1">
                                                                                {{ $dul->duration }}
                                                                                <small class="text-muted">
                                                                                    ({{ $dul->trigger->name }})
                                                                                </small>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td class="text-end">
                                                            <a href="{{ route('public.charter', $classification->id) }}"
                                                               class="btn btn-sm btn-primary"
                                                               title="Voir la charte">
                                                                <i class="fas fa-chart-bar"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <!-- Règles -->
                        @if(isset($searchResults['rules']) && $searchResults['rules']->isNotEmpty())
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-header bg-light border-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">
                                            Règles de conservation
                                            <span class="badge bg-primary ms-2">
                                            {{ $searchResults['rules']->count() }}
                                        </span>
                                        </h6>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Code</th>
                                            <th>Nom</th>
                                            <th>Délai conservation</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($searchResults['rules'] as $rule)
                                            <tr>
                                                <td class="text-primary fw-bold">{{ $rule->code }}</td>
                                                <td>
                                                    <div>{{ $rule->name }}</div>
                                                    @if($rule->description)
                                                        <small class="text-muted">
                                                            {{ Str::limit($rule->description, 100) }}
                                                        </small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach($rule->duls as $dul)
                                                        <div class="badge bg-light text-dark mb-1">
                                                            {{ $dul->duration }}
                                                            <small class="text-muted">
                                                                ({{ $dul->trigger->name }})
                                                            </small>
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td class="text-end">
                                                    <button type="button"
                                                            class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ruleModal-{{ $rule->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <!-- Message si aucun résultat -->
                        @if(empty($searchResults['classifications']) && empty($searchResults['rules']))
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-search fa-3x text-muted"></i>
                                </div>
                                <h4>Aucun résultat trouvé</h4>
                                <p class="text-muted">
                                    <!-- Fin de index.blade.php -->
                                    Essayez avec d'autres mots-clés ou modifiez vos filtres
                                </p>
                            </div>
                        @endif

                    @else
                        <!-- Page d'accueil si pas de recherche -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-book-reader fa-4x text-primary opacity-50"></i>
                            </div>
                            <h4>Commencez votre recherche</h4>
                            <p class="text-muted">
                                Utilisez la barre de recherche ci-dessus ou
                                <a href="{{ route('public.search', ['show_all' => 1]) }}">
                                    consultez toutes les classifications
                                </a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function resetFilters() {
                document.querySelectorAll('.filter-select').forEach(select => select.value = '');
                document.querySelectorAll('.filter-checkbox').forEach(cb => cb.checked = false);
                document.getElementById('searchForm').submit();
            }

            function toggleSort(button) {
                const currentOrder = button.dataset.order;
                const newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
                button.dataset.order = newOrder;
                const icon = button.querySelector('i');
                icon.className = `fas fa-sort-${newOrder === 'asc' ? 'up' : 'down'}`;
                document.querySelector('input[name="order"]').value = newOrder;
                document.getElementById('searchForm').submit();
            }

            // Soumission automatique des filtres
            document.querySelectorAll('.filter-select, .filter-checkbox').forEach(element => {
                element.addEventListener('change', () => document.getElementById('searchForm').submit());
            });
        </script>
    @endpush
@endsection

