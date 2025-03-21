@extends('index')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4"><strong>{{ __('search') }}</strong></h1>

                <form id="search-form" method="GET" action="{{ route('public.search') }}" class="d-flex justify-content-center mb-5">
                    <div class="input-group">
                        <input type="text" name="query" id="search-input" class="form-control" placeholder="{{ __('search_placeholder') }}" value="{{ request('query') }}" />
                        <button type="submit" class="btn btn-primary">{{ __('search_button') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="search-results-container">
            @if(isset($searchData) && !empty($searchData))
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="mb-4 border-0">
                            <div class="bg-light py-2 px-3 mb-3 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fs-4">{{ __('search_results') }}</h5>
                                <span class="badge bg-secondary">{{ $searchData['count'] ?? 0 }} {{ __('results_found') }}</span>
                            </div>
                            <div class="list-unstyled">
                                @if(isset($searchData['results']) && count($searchData['results']) > 0)
                                    @foreach($searchData['results'] as $value)
                                        <div class="py-3 border-0 mb-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <a href="{{ route('public.' . ($value['type'] === 'article' ? 'articles' : 'references') . '.show', $value['id']) }}" class="text-decoration-none">
                                                            <h2 class="h4 fw-bold mb-0 text-primary hover-underline">{{ $value['name'] }}</h2>
                                                        </a>
                                                        <span class="badge {{ $value['type'] === 'reference' ? 'bg-success' : ($value['type'] === 'rule' ? 'bg-primary' : ($value['type'] === 'article' ? 'bg-info' : 'bg-secondary')) }} ms-2 fs-6">
                                                            <i class="{{ $value['type'] === 'reference' ? 'bi bi-book' : ($value['type'] === 'article' ? 'bi bi-file-text' : 'bi bi-collection') }} me-1"></i>
                                                            {{ $value['type'] }}
                                                        </span>

                                                        @if(isset($value['relevance']))
                                                            <span class="ms-2 badge bg-light text-dark border" title="{{ __('relevance_score') }}">
                                                                <i class="bi bi-star-fill me-1 text-warning"></i>
                                                                {{ $value['relevance'] }}
                                                            </span>
                                                        @endif
                                                    </div>

                                                    @if(isset($value['code']) && $value['type'] === 'article')
                                                        <div class="mb-2">
                                                            <span class="badge bg-light text-dark fs-6">{{ $value['code'] }}</span>
                                                        </div>
                                                    @endif

                                                    <p class="mb-3 fs-5">{{ $value['description'] }}</p>

                                                    <div class="d-flex flex-wrap text-muted fs-6">
                                                        @if($value['type'] === 'reference' && isset($value['articles_count']))
                                                            <div class="me-3 mb-1">
                                                                <i class="bi bi-file-text"></i>
                                                                <strong>{{ $value['articles_count'] }}</strong> {{ __('articles') }}
                                                            </div>
                                                        @endif

                                                        @if(isset($value['country']) && !empty($value['country']))
                                                            <div class="me-3 mb-1">
                                                                <i class="bi bi-geo-alt"></i>
                                                                <strong>{{ is_array($value['country']) ? $value['country']['name'] : $value['country'] }}</strong>
                                                                @if(is_array($value['country']) && isset($value['country']['abbr']))
                                                                    ({{ $value['country']['abbr'] }})
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if(isset($value['reference']) && $value['type'] === 'article')
                                                            <div class="me-3 mb-1">
                                                                <i class="bi bi-bookmark"></i>
                                                                <strong>{{ $value['reference'] }}</strong>
                                                            </div>
                                                        @endif

                                                        @if(isset($value['category']))
                                                            <div class="me-3 mb-1">
                                                                <i class="bi bi-folder"></i>
                                                                <strong>{{ is_array($value['category']) ? $value['category']['name'] : $value['category'] }}</strong>
                                                            </div>
                                                        @endif

                                                        <div class="me-3 mb-1">
                                                            <i class="bi bi-calendar"></i>
                                                            @if(isset($value['created_at']))
                                                                {{ $value['created_at'] }}
                                                            @else
                                                                {{ __('date_unavailable') }}
                                                            @endif
                                                        </div>

                                                        @if(isset($value['user']))
                                                            <div class="mb-1">
                                                                <i class="bi bi-person"></i>
                                                                {{ is_array($value['user']) ? $value['user']['name'] : $value['user'] }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(!$loop->last)
                                            <hr class="my-0 opacity-25">
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            @if(isset($paginator) && $paginator->hasPages())
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $paginator->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @elseif(request('query'))
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="alert alert-info text-center p-4 border-0">
                            <i class="bi bi-search fs-4 mb-2"></i>
                            <p class="mb-0 fs-5">{{ __('no_results') }}</p>
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
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('search-form');
        const searchInput = document.getElementById('search-input');
        const resultsContainer = document.getElementById('search-results-container');

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
                // Afficher un indicateur de chargement
                resultsContainer.innerHTML = `
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="text-center p-5">
                                <div class="spinner-border text-primary" role="status"></div>
                                <p class="mt-2">{{ __('searching') }}...</p>
                            </div>
                        </div>
                    </div>
                `;

                // Effectuer la requête AJAX
                fetch(`${searchForm.action}?query=${encodeURIComponent(query)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.results && data.results.length > 0) {
                        displayResults(data);
                    } else {
                        resultsContainer.innerHTML = `
                            <div class="row">
                                <div class="col-md-8 mx-auto">
                                    <div class="alert alert-info text-center p-4 border-0">
                                        <i class="bi bi-search fs-4 mb-2"></i>
                                        <p class="mb-0 fs-5">{{ __('no_results') }}</p>
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
                                <div class="alert alert-danger text-center p-4">
                                    <i class="bi bi-exclamation-triangle fs-4 mb-2"></i>
                                    <p class="mb-0 fs-5">{{ __('search_error') }}</p>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            function displayResults(data) {
                let html = `
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <div class="mb-4 border-0">
                                <div class="bg-light py-2 px-3 mb-3 d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 fs-4">{{ __('search_results') }}</h5>
                                    <span class="badge bg-secondary">${data.count} {{ __('results_found') }}</span>
                                </div>
                                <div class="list-unstyled">
                `;

                if (data.results.length > 0) {
                    data.results.forEach((value, index) => {
                        html += `
                            <div class="py-3 border-0 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex align-items-center mb-3">
                                            <a href="${value.type === 'article' ? '{{ route("public.references.show", "") }}/' + value.reference_id : '{{ route("public.references.show", "") }}/' + value.id}" class="text-decoration-none">
                                                <h2 class="h4 fw-bold mb-0 text-primary hover-underline">${escapeHtml(value.name)}</h2>
                                            </a>
                                            <span class="badge ${value.type === 'reference' ? 'bg-success' : (value.type === 'rule' ? 'bg-primary' : (value.type === 'article' ? 'bg-info' : 'bg-secondary'))} ms-2 fs-6">
                                                <i class="${value.type === 'reference' ? 'bi bi-book' : (value.type === 'article' ? 'bi bi-file-text' : 'bi bi-collection')} me-1"></i>
                                                ${value.type}
                                            </span>

                                            ${value.relevance ? `
                                                <span class="ms-2 badge bg-light text-dark border" title="{{ __('relevance_score') }}">
                                                    <i class="bi bi-star-fill me-1 text-warning"></i>
                                                    ${value.relevance}
                                                </span>
                                            ` : ''}
                                        </div>

                                        ${value.type === 'article' && value.code ? `
                                            <div class="mb-2">
                                                <span class="badge bg-light text-dark fs-6">${escapeHtml(value.code)}</span>
                                            </div>
                                        ` : ''}

                                        <p class="mb-3 fs-5">${escapeHtml(value.description || '')}</p>

                                        <div class="d-flex flex-wrap text-muted fs-6">
                                            ${value.type === 'reference' && value.articles_count ? `
                                                <div class="me-3 mb-1">
                                                    <i class="bi bi-file-text"></i>
                                                    <strong>${value.articles_count}</strong> {{ __('articles') }}
                                                </div>
                                            ` : ''}

                                            ${value.country ? `
                                                <div class="me-3 mb-1">
                                                    <i class="bi bi-geo-alt"></i>
                                                    <strong>${typeof value.country === 'object' ? escapeHtml(value.country.name) : escapeHtml(value.country)}</strong>
                                                    ${typeof value.country === 'object' && value.country.abbr ? `(${escapeHtml(value.country.abbr)})` : ''}
                                                </div>
                                            ` : ''}

                                            ${value.type === 'article' && value.reference ? `
                                                <div class="me-3 mb-1">
                                                    <i class="bi bi-bookmark"></i>
                                                    <strong>${escapeHtml(value.reference)}</strong>
                                                </div>
                                            ` : ''}

                                            ${value.category ? `
                                                <div class="me-3 mb-1">
                                                    <i class="bi bi-folder"></i>
                                                    <strong>${typeof value.category === 'object' ? escapeHtml(value.category.name) : escapeHtml(value.category)}</strong>
                                                </div>
                                            ` : ''}

                                            <div class="me-3 mb-1">
                                                <i class="bi bi-calendar"></i>
                                                ${value.created_at ? escapeHtml(value.created_at) : '{{ __("date_unavailable") }}'}
                                            </div>

                                            ${value.user ? `
                                                <div class="mb-1">
                                                    <i class="bi bi-person"></i>
                                                    ${typeof value.user === 'object' ? escapeHtml(value.user.name) : escapeHtml(value.user)}
                                                </div>
                                            ` : ''}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                        if (index < data.results.length - 1) {
                            html += '<hr class="my-0 opacity-25">';
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
