@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="text-center mb-4">
                <div class="d-inline-block bg-primary text-white rounded-circle p-3 mb-3">
                    <i class="bi bi-search fs-3"></i>
                </div>
                <h1 class="fw-bold">{{ __('search') }}</h1>
                <p class="text-muted">{{ __('search_description', ['default' => 'Find articles, references and regulations']) }}</p>
            </div>

            <form id="search-form" method="GET" action="{{ route('public.search') }}" class="d-flex flex-column justify-content-center mb-5 p-4 bg-white rounded shadow-sm">
                <div class="input-group mb-4">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="query" id="search-input" class="form-control border-start-0" placeholder="{{ __('search_placeholder') }}" value="{{ request('query') }}" />
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-folder"></i></span>
                            <select name="category" class="form-select border-start-0">
                                <option value="">{{ __('all_categories') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-geo-alt"></i></span>
                            <select name="country" class="form-select border-start-0">
                                <option value="">{{ __('all_countries') }}</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ request('country') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="search-date-start" class="form-label"><i class="bi bi-calendar3 me-2"></i>{{ __('start_date') }}</label>
                        <input type="date" id="search-date-start" name="date_start" class="form-control" value="{{ request('date_start') }}" />
                    </div>
                    <div class="col-md-6">
                        <label for="search-date-end" class="form-label"><i class="bi bi-calendar3-week me-2"></i>{{ __('end_date') }}</label>
                        <input type="date" id="search-date-end" name="date_end" class="form-control" value="{{ request('date_end') }}" />
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill shadow-sm">
                        <i class="bi bi-search me-2"></i>{{ __('search_button') }}
                    </button>
                </div>
            </form>
            </div>
        </div>



        <div id="search-results-container">
            @if(isset($searchData) && !empty($searchData))
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="mb-4 border-0 bg-white rounded shadow-sm">
                            <div class="bg-primary bg-opacity-10 py-3 px-4 mb-0 d-flex justify-content-between align-items-center rounded-top">
                                <h5 class="mb-0 fs-4 text-primary"><i class="bi bi-list-ul me-2"></i>{{ __('search_results') }}</h5>
                                <span class="badge bg-primary px-3 py-2">{{ $searchData['count'] ?? 0 }} {{ __('results_found') }}</span>
                            </div>
                            <div class="list-unstyled p-4">
                                @if(isset($searchData['results']) && count($searchData['results']) > 0)
                                    @foreach($searchData['results'] as $value)
                                        <div class="py-3 border-0 mb-3 hover-card">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <a href="{{ route('public.' . ($value['type'] === 'article' ? 'articles' : 'references') . '.show', $value['id']) }}" class="text-decoration-none">
                                                            <h2 class="h4 fw-bold mb-0 text-primary hover-underline">{{ $value['name'] }}</h2>
                                                        </a>
                                                        <span class="badge {{ $value['type'] === 'reference' ? 'bg-success' : ($value['type'] === 'rule' ? 'bg-primary' : ($value['type'] === 'article' ? 'bg-info' : 'bg-secondary')) }} ms-2 fs-6 px-3 py-2">
                                                            <i class="{{ $value['type'] === 'reference' ? 'bi bi-book' : ($value['type'] === 'article' ? 'bi bi-file-text' : 'bi bi-collection') }} me-1"></i>
                                                            {{ $value['type'] }}
                                                        </span>

                                                        @if(isset($value['relevance']))
                                                            <span class="ms-2 badge bg-light text-dark border px-3 py-2" title="{{ __('relevance_score') }}">
                                                                <i class="bi bi-star-fill me-1 text-warning"></i>
                                                                {{ $value['relevance'] }}
                                                            </span>
                                                        @endif
                                                    </div>

                                                    @if(isset($value['code']) && $value['type'] === 'article')
                                                        <div class="mb-2">
                                                            <span class="badge bg-light text-dark fs-6 px-3 py-2">{{ $value['code'] }}</span>
                                                        </div>
                                                    @endif

                                                    <p class="mb-3 fs-5 text-secondary">{{ $value['description'] }}</p>

                                                    <div class="d-flex flex-wrap text-muted fs-6">
                                                        @if($value['type'] === 'reference' && isset($value['articles_count']))
                                                            <div class="me-3 mb-1 badge bg-light text-dark py-2">
                                                                <i class="bi bi-file-text text-info"></i>
                                                                <strong>{{ $value['articles_count'] }}</strong> {{ __('articles') }}
                                                            </div>
                                                        @endif

                                                        @if(isset($value['country']) && !empty($value['country']))
                                                            <div class="me-3 mb-1 badge bg-light text-dark py-2">
                                                                <i class="bi bi-geo-alt text-danger"></i>
                                                                <strong>{{ is_array($value['country']) ? $value['country']['name'] : $value['country'] }}</strong>
                                                                @if(is_array($value['country']) && isset($value['country']['abbr']))
                                                                    ({{ $value['country']['abbr'] }})
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if(isset($value['reference']) && $value['type'] === 'article')
                                                            <div class="me-3 mb-1 badge bg-light text-dark py-2">
                                                                <i class="bi bi-bookmark text-success"></i>
                                                                <strong>{{ $value['reference'] }}</strong>
                                                            </div>
                                                        @endif

                                                        @if(isset($value['category']))
                                                            <div class="me-3 mb-1 badge bg-light text-dark py-2">
                                                                <i class="bi bi-folder text-primary"></i>
                                                                <strong>{{ is_array($value['category']) ? $value['category']['name'] : $value['category'] }}</strong>
                                                            </div>
                                                        @endif

                                                        <div class="me-3 mb-1 badge bg-light text-dark py-2">
                                                            <i class="bi bi-calendar text-secondary"></i>
                                                            @if(isset($value['created_at']))
                                                                {{ $value['created_at'] }}
                                                            @else
                                                                {{ __('date_unavailable') }}
                                                            @endif
                                                        </div>

                                                        @if(isset($value['user']))
                                                            <div class="mb-1 badge bg-light text-dark py-2">
                                                                <i class="bi bi-person text-primary"></i>
                                                                {{ is_array($value['user']) ? $value['user']['name'] : $value['user'] }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(!$loop->last)
                                            <hr class="my-3 opacity-10">
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            @if(isset($paginator) && $paginator->hasPages())
                                <div class="d-flex justify-content-center mt-4 pb-4">
                                    {{ $paginator->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @elseif(request('query'))
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="alert alert-info text-center p-5 border-0 rounded shadow-sm">
                            <div class="d-inline-block bg-info bg-opacity-25 text-info rounded-circle p-3 mb-3">
                                <i class="bi bi-search fs-3"></i>
                            </div>
                            <h4 class="mb-2">{{ __('no_results_title', ['default' => 'No Results Found']) }}</h4>
                            <p class="mb-0 fs-5 text-secondary">{{ __('no_results', ['default' => 'We could not find any results matching your search criteria.']) }}</p>
                            <div class="mt-4">
                                <button onclick="document.getElementById('search-input').focus()" class="btn btn-outline-primary rounded-pill px-4">
                                    <i class="bi bi-arrow-left me-2"></i>{{ __('modify_search', ['default' => 'Modify your search']) }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        @if(app()->getLocale() === 'ar')
        .container {
            direction: rtl;
            text-align: right;
        }
        .text-center {
            text-align: center !important;
        }
        .me-1, .me-2, .me-3 {
            margin-left: 0.25rem !important;
            margin-right: 0 !important;
        }
        .ms-2, .ms-3 {
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
        .pagination .page-item:first-child .page-link {
            border-radius: 0 0.25rem 0.25rem 0;
        }
        .pagination .page-item:last-child .page-link {
            border-radius: 0.25rem 0 0 0.25rem;
        }
        @endif

        .hover-underline:hover {
            text-decoration: underline !important;
        }

        /* Styles améliorés sans animations */
        #search-form {
            border: 1px solid rgba(0,0,0,0.05);
        }

        .form-control:focus, .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

        .input-group-text {
            color: #6c757d;
        }

        .badge {
            font-weight: 500;
        }

        .hover-card {
            border-radius: 0.5rem;
            padding: 1rem;
        }

        .rounded-top {
            border-top-left-radius: 0.5rem !important;
            border-top-right-radius: 0.5rem !important;
        }

        .rounded-pill {
            border-radius: 50px !important;
        }

        /* Amélioration de la pagination */
        .pagination {
            gap: 0.25rem;
        }

        .pagination .page-link {
            border-radius: 0.25rem;
        }

        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        /* Amélioration pour l'affichage mobile */
        @media (max-width: 767.98px) {
            .badge {
                margin-bottom: 0.5rem;
            }

            .d-flex.flex-wrap {
                gap: 0.5rem;
            }
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('search-form');
        const searchInput = document.getElementById('search-input');
        const resultsContainer = document.getElementById('search-results-container');
        const categorySelect = document.querySelector('select[name="category"]');
        const countrySelect = document.querySelector('select[name="country"]');

        // Vérifier si la recherche AJAX est activée
        const useAjaxSearch = true; // Mettre à true pour activer la recherche AJAX

        if (useAjaxSearch && searchForm && searchInput) {
            let searchTimeout;

            // Intercepter la soumission du formulaire pour utiliser AJAX
            searchForm.addEventListener('submit', function(e) {
                if (searchInput.value.trim().length > 0) {
                    e.preventDefault();
                    fetchSearchResults(searchInput.value.trim());
                }
            });

            // Recherche en temps réel (optionnelle)
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);

                if (this.value.trim().length >= 3) {
                    searchTimeout = setTimeout(() => {
                        fetchSearchResults(this.value.trim());
                    }, 500); // Délai de 500ms avant d'effectuer la recherche
                }
            });

            function fetchSearchResults(query) {
                // Récupérer les valeurs des filtres
                const categoryValue = categorySelect ? categorySelect.value : "";
                const countryValue = countrySelect ? countrySelect.value : "";
                const dateStartValue = document.querySelector('input[name="date_start"]') ? document.querySelector('input[name="date_start"]').value : "";
                const dateEndValue = document.querySelector('input[name="date_end"]') ? document.querySelector('input[name="date_end"]').value : "";

                // Afficher un indicateur de chargement
                resultsContainer.innerHTML = `
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="text-center p-5 bg-white rounded shadow-sm">
                                <div class="spinner-grow text-primary mb-3" role="status" style="width: 3rem; height: 3rem;"></div>
                                <p class="mb-0 fs-5 text-secondary">{{ __('searching', ['default' => 'Searching']) }}...</p>
                            </div>
                        </div>
                    </div>
                `;

                // Construire l'URL avec tous les paramètres
                let searchUrl = `${searchForm.action}?query=${encodeURIComponent(query)}`;

                if (categoryValue) {
                    searchUrl += `&category=${encodeURIComponent(categoryValue)}`;
                }

                if (countryValue) {
                    searchUrl += `&country=${encodeURIComponent(countryValue)}`;
                }

                if (dateStartValue) {
                    searchUrl += `&date_start=${encodeURIComponent(dateStartValue)}`;
                }

                if (dateEndValue) {
                    searchUrl += `&date_end=${encodeURIComponent(dateEndValue)}`;
                }

                // Effectuer la requête AJAX
                fetch(searchUrl, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.results && data.results.length > 0) {
                        displayResults(data);

                        // Mettre à jour les options des sélecteurs si des données sont retournées
                        if (data.categories && categorySelect) {
                            updateSelectOptions(categorySelect, data.categories, "{{ __('all_categories') }}");
                        }

                        if (data.countries && countrySelect) {
                            updateSelectOptions(countrySelect, data.countries, "{{ __('all_countries') }}");
                        }
                    } else {
                        resultsContainer.innerHTML = `
                            <div class="row">
                                <div class="col-md-8 mx-auto">
                                    <div class="alert alert-info text-center p-5 border-0 rounded shadow-sm">
                                        <div class="d-inline-block bg-info bg-opacity-25 text-info rounded-circle p-3 mb-3">
                                            <i class="bi bi-search fs-3"></i>
                                        </div>
                                        <h4 class="mb-2">{{ __('no_results_title', ['default' => 'No Results Found']) }}</h4>
                                        <p class="mb-0 fs-5 text-secondary">{{ __('no_results', ['default' => 'We could not find any results matching your search criteria.']) }}</p>
                                        <div class="mt-4">
                                            <button onclick="document.getElementById('search-input').focus()" class="btn btn-outline-primary rounded-pill px-4">
                                                <i class="bi bi-arrow-left me-2"></i>{{ __('modify_search', ['default' => 'Modify your search']) }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error fetching search results:', error);
                    resultsContainer.innerHTML = `
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <div class="alert alert-danger text-center p-5 border-0 rounded shadow-sm">
                                    <div class="d-inline-block bg-danger bg-opacity-25 text-danger rounded-circle p-3 mb-3">
                                        <i class="bi bi-exclamation-triangle fs-3"></i>
                                    </div>
                                    <h4 class="mb-2">{{ __('search_error_title', ['default' => 'An Error Occurred']) }}</h4>
                                    <p class="mb-0 fs-5 text-secondary">{{ __('search_error', ['default' => 'There was a problem processing your search. Please try again.']) }}</p>
                                    <div class="mt-4">
                                        <button onclick="location.reload()" class="btn btn-outline-danger rounded-pill px-4">
                                            <i class="bi bi-arrow-repeat me-2"></i>{{ __('try_again', ['default' => 'Try again']) }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            // Fonction pour mettre à jour les options d'un select
            function updateSelectOptions(selectElement, items, defaultLabel) {
                // Garder l'option sélectionnée actuelle
                const currentValue = selectElement.value;

                // Vider le select
                selectElement.innerHTML = '';

                // Ajouter l'option par défaut
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = defaultLabel;
                selectElement.appendChild(defaultOption);

                // Ajouter les options
                items.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.name;
                    option.selected = currentValue == item.id;
                    selectElement.appendChild(option);
                });
            }

            function displayResults(data) {
                let html = `
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <div class="mb-4 border-0 bg-white rounded shadow-sm">
                                <div class="bg-primary bg-opacity-10 py-3 px-4 mb-0 d-flex justify-content-between align-items-center rounded-top">
                                    <h5 class="mb-0 fs-4 text-primary"><i class="bi bi-list-ul me-2"></i>{{ __('search_results') }}</h5>
                                    <span class="badge bg-primary px-3 py-2">${data.count} {{ __('results_found') }}</span>
                                </div>
                                <div class="list-unstyled p-4">
                `;

                if (data.results.length > 0) {
                    data.results.forEach((value, index) => {
                        html += `
                            <div class="py-3 border-0 mb-3 hover-card">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex align-items-center mb-3">
                                            <a href="${value.type === 'article' ? '{{ route("public.references.show", "") }}/' + value.reference_id : '{{ route("public.references.show", "") }}/' + value.id}" class="text-decoration-none">
                                                <h2 class="h4 fw-bold mb-0 text-primary hover-underline">${escapeHtml(value.name)}</h2>
                                            </a>
                                            <span class="badge ${value.type === 'reference' ? 'bg-success' : (value.type === 'rule' ? 'bg-primary' : (value.type === 'article' ? 'bg-info' : 'bg-secondary'))} ms-2 fs-6 px-3 py-2">
                                                <i class="${value.type === 'reference' ? 'bi bi-book' : (value.type === 'article' ? 'bi bi-file-text' : 'bi bi-collection')} me-1"></i>
                                                ${value.type}
                                            </span>

                                            ${value.relevance ? `
                                                <span class="ms-2 badge bg-light text-dark border px-3 py-2" title="{{ __('relevance_score') }}">
                                                    <i class="bi bi-star-fill me-1 text-warning"></i>
                                                    ${value.relevance}
                                                </span>
                                            ` : ''}
                                        </div>

                                        ${value.type === 'article' && value.code ? `
                                            <div class="mb-2">
                                                <span class="badge bg-light text-dark fs-6 px-3 py-2">${escapeHtml(value.code)}</span>
                                            </div>
                                        ` : ''}

                                        <p class="mb-3 fs-5 text-secondary">${escapeHtml(value.description || '')}</p>

                                        <div class="d-flex flex-wrap text-muted fs-6">
                                            ${value.type === 'reference' && value.articles_count ? `
                                                <div class="me-3 mb-1 badge bg-light text-dark py-2">
                                                    <i class="bi bi-file-text text-info"></i>
                                                    <strong>${value.articles_count}</strong> {{ __('articles') }}
                                                </div>
                                            ` : ''}

                                            ${value.country ? `
                                                <div class="me-3 mb-1 badge bg-light text-dark py-2">
                                                    <i class="bi bi-geo-alt text-danger"></i>
                                                    <strong>${typeof value.country === 'object' ? escapeHtml(value.country.name) : escapeHtml(value.country)}</strong>
                                                    ${typeof value.country === 'object' && value.country.abbr ? `(${escapeHtml(value.country.abbr)})` : ''}
                                                </div>
                                            ` : ''}

                                            ${value.type === 'article' && value.reference ? `
                                                <div class="me-3 mb-1 badge bg-light text-dark py-2">
                                                    <i class="bi bi-bookmark text-success"></i>
                                                    <strong>${escapeHtml(value.reference)}</strong>
                                                </div>
                                            ` : ''}

                                            ${value.category ? `
                                                <div class="me-3 mb-1 badge bg-light text-dark py-2">
                                                    <i class="bi bi-folder text-primary"></i>
                                                    <strong>${typeof value.category === 'object' ? escapeHtml(value.category.name) : escapeHtml(value.category)}</strong>
                                                </div>
                                            ` : ''}

                                            <div class="me-3 mb-1 badge bg-light text-dark py-2">
                                                <i class="bi bi-calendar text-secondary"></i>
                                                ${value.created_at ? escapeHtml(value.created_at) : '{{ __("date_unavailable") }}'}
                                            </div>

                                            ${value.user ? `
                                                <div class="mb-1 badge bg-light text-dark py-2">
                                                    <i class="bi bi-person text-primary"></i>
                                                    ${typeof value.user === 'object' ? escapeHtml(value.user.name) : escapeHtml(value.user)}
                                                </div>
                                            ` : ''}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                        if (index < data.results.length - 1) {
                            html += '<hr class="my-3 opacity-10">';
                        }
                    });
                }

                html += `
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                resultsContainer.innerHTML = html;
            }

            // Fonction pour échapper les caractères HTML
            function escapeHtml(str) {
                if (!str) return '';
                return str
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }
        }
    });
    </script>
@endsection
