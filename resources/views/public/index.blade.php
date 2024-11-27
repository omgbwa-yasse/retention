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
                            {{ __('portal_title') }}
                        </h1>

                        @if(empty($searchQuery))
                            <p class="lead mb-4 opacity-75">
                                {{ __('portal_description') }}
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
                                            placeholder="{{ __('search_placeholder') }}"
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
                                <h5 class="card-title mb-0">{{ __('filters') }}</h5>
                                <button class="btn btn-sm btn-outline-secondary" onclick="resetFilters()">
                                    <i class="fas fa-undo"></i> {{ __('reset') }}
                                </button>
                            </div>

                            <!-- Filtres -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('all_countries') }}</label>
                                <select name="country" class="form-select filter-select">
                                    <option value="">{{ __('all_countries') }}</option>
                                    @foreach($searchResults['filters']['countries'] ?? [] as $country)
                                        <option value="{{ $country->id }}"
                                            {{ $currentCountry == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('retention_period') }}</label>
                                <select name="duration" class="form-select filter-select">
                                    <option value="">{{ __('all_durations') }}</option>
                                    @foreach($searchResults['filters']['durations'] ?? [] as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ $currentDuration == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">{{ __('sort_by') }}</label>
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
                                <i class="fas fa-list me-1"></i> {{ __('show_all') }}
                            </a>
                        </div>
                    </div>

                    @if(!empty($searchResults['classifications']))
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="mb-3">{{ __('typologies') }}</h6>
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
                                        {{ __('results_for') }} "{{ $searchQuery }}"
                                    @else
                                        {{ __('all_classifications') }}
                                    @endif
                                </h5>
                                <small class="text-muted">
                                    @if(isset($searchResults['classifications']))
                                        {{ $searchResults['classifications']->flatten()->count() }} {{ __('classifications') }}
                                    @endif
                                    @if(isset($searchResults['rules']))
                                        • {{ $searchResults['rules']->count() }} {{ __('rules') }}
                                    @endif
                                </small>
                            </div>
                        </div>

                        <!-- Classifications -->
                        @if(isset($searchResults['classifications']))
                            @foreach($searchResults['classifications'] as $typology => $classifications)
                                <div class="search-results-group mb-4" data-typology="{{ $typology }}">
                                    <h6 class="text-muted mb-3">
                                        {{ $typology }}
                                        <span class="badge bg-light text-dark ms-2">
                                            {{ $classifications->count() }} {{ __('results') }}
                                        </span>
                                    </h6>

                                    @foreach($classifications as $classification)
                                        <div class="search-result mb-4">
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <span class="badge bg-primary text-white">{{ $classification->code }}</span>
                                                @if($classification->country)
                                                    <span class="badge bg-light text-dark">{{ $classification->country->name }}</span>
                                                @endif
                                            </div>

                                            <h3 class="h5 mb-2">
                                                <a href="{{ route('public.charter', $classification->id) }}"
                                                   class="text-decoration-none text-primary">
                                                    {{ $classification->name }}
                                                </a>
                                            </h3>

                                            @if($classification->description)
                                                <p class="text-muted mb-2">
                                                    {{ Str::limit($classification->description, 200) }}
                                                </p>
                                            @endif

                                            <div class="d-flex flex-wrap gap-2 mb-2">
                                                @if($classification->rules)
                                                    @foreach($classification->rules as $rule)
                                                        @if($rule->duls)
                                                            @foreach($rule->duls as $dul)
                                                                <span class="badge bg-light text-dark">
                                                                    {{ $dul->duration }}
                                                                    <small class="text-muted">({{ $dul->trigger->name }})</small>
                                                                </span>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>

                                            <div class="mt-2">
                                                <div class="btn-group">
                                                    <a href="{{ route('public.charter', $classification->id) }}"
                                                       class="btn btn-sm btn-primary">
                                                        <i class="fas fa-chart-bar me-1"></i> {{ __('see_charter') }}
                                                    </a>
                                                    <a href="{{ route('public.charter.pdf', $classification->id) }}"
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-file-pdf"></i> PDF
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @endif

                        <!-- Règles -->
                        @if(isset($searchResults['rules']) && $searchResults['rules']->isNotEmpty())
                            <div class="search-results-group mb-4">
                                <h6 class="text-muted mb-3">
                                    {{ __('retention_rules') }}
                                    <span class="badge bg-light text-dark ms-2">
                                        {{ $searchResults['rules']->count() }} {{ __('results') }}
                                    </span>
                                </h6>

                                @foreach($searchResults['rules'] as $rule)
                                    <div class="search-result mb-4">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="badge bg-primary text-white">{{ $rule->code }}</span>
                                            @if($rule->country)
                                                <span class="badge bg-light text-dark">{{ $rule->country->name }}</span>
                                            @endif
                                        </div>

                                        <h3 class="h5 mb-2">
                                            @if($rule->classifications->isNotEmpty())
                                                <a href="{{ route('public.charter', $rule->classifications->first()->id) }}"
                                                   class="text-decoration-none text-primary">
                                                    {{ $rule->name }}
                                                </a>
                                            @else
                                                {{ $rule->name }}
                                            @endif
                                        </h3>

                                        @if($rule->description)
                                            <p class="text-muted mb-2">
                                                {{ Str::limit($rule->description, 200) }}
                                            </p>
                                        @endif

                                        <div class="d-flex flex-wrap gap-2 mb-2">
                                            @foreach($rule->duls as $dul)
                                                <span class="badge bg-light text-dark">
                                                    {{ $dul->duration }}
                                                    <small class="text-muted">({{ $dul->trigger->name }})</small>
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="mt-2">
                                            @if($rule->classifications->isNotEmpty())
                                                <div class="btn-group">
                                                    <a href="{{ route('public.charter', $rule->classifications->first()->id) }}"
                                                       class="btn btn-sm btn-primary">
                                                        <i class="fas fa-chart-bar me-1"></i> {{ __('see_charter') }}
                                                    </a>
                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ruleDetailsModal-{{ $rule->id }}">
                                                        <i class="fas fa-info-circle me-1"></i> {{ __('details') }}
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Message si aucun résultat -->
                        @if(empty($searchResults['classifications']) && empty($searchResults['rules']))
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-search fa-3x text-muted"></i>
                                </div>
                                <h4>{{ __('no_results') }}</h4>
                                <p class="text-muted">
                                    {{ __('try_other') }}
                                </p>
                            </div>
                        @endif
                    @else
                        <!-- Page d'accueil si pas de recherche -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-book-reader fa-4x text-primary opacity-50"></i>
                            </div>
                            <h4>{{ __('start_search') }}</h4>
                            <p class="text-muted">
                                {{ __('use_search') }}
                                <a href="{{ route('public.search', ['show_all' => 1]) }}">
                                    {{ __('view_all_classifications') }}
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
