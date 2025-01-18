
@extends('index')
<style>
    :root {
        --transition-duration: 0.2s;
    }

    .charter-content {
        min-height: 200px;
    }

    .card {
        border: 1px solid rgba(0,0,0,0.1);
        transition: box-shadow var(--transition-duration) ease-in-out;
    }

    .card:hover {
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.1);
    }

    .search-wrapper {
        transition: box-shadow var(--transition-duration) ease-in-out;
    }

    .search-wrapper:focus-within {
        box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.1);
    }

    .btn-group .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem;
        transition: all var(--transition-duration) ease-in-out;
    }

    .btn-light:hover {
        background-color: #f8f9fa;
    }

    .badge {
        font-weight: 500;
    }

    .transition-shadow {
        transition: box-shadow var(--transition-duration) ease-in-out;
    }

    @if(app()->getLocale() === 'ar')
.me-1, .me-2 {
        margin-left: 0.25rem !important;
        margin-right: 0 !important;
    }

    .ms-1, .ms-2 {
        margin-right: 0.25rem !important;
        margin-left: 0 !important;
    }

    .rounded-start {
        border-radius: 0 0.375rem 0.375rem 0 !important;
    }

    .rounded-end {
        border-radius: 0.375rem 0 0 0.375rem !important;
    }
    @endif
</style>
<style>
    .search-highlight {
        background-color: #fff3cd;
        padding: 0.1em 0.2em;
        border-radius: 0.2em;
        margin: 0 -0.2em;
        transition: background-color 0.2s ease-in-out;
        box-decoration-break: clone;
        -webkit-box-decoration-break: clone;
    }

    @media (prefers-color-scheme: dark) {
        .search-highlight {
            background-color: #665e00;
            color: #fff;
        }
    }

    #searchCount {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
        background-color: rgba(0, 0, 0, 0.05);
        border-radius: 0.25rem;
        z-index: 1000;
    }

</style>
<style>
    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }

    /* Amélioration de l'accessibilité */
    .btn:focus,
    .btn:focus-visible {
        outline: 2px solid #0d6efd;
        outline-offset: 2px;
    }

    /* Support écrans haute résolution */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
        .card {
            border-width: 0.5px;
        }
    }

    /* Support mode sombre du système */
    @media (prefers-color-scheme: dark) {
        .card {
            border-color: rgba(255,255,255,0.1);
        }

        .btn-light {
            background-color: rgba(255,255,255,0.1);
            border-color: transparent;
        }

        .btn-light:hover {
            background-color: rgba(255,255,255,0.15);
        }
    }

    /* Optimisations pour les appareils tactiles */
    @media (hover: none) {
        .card:hover {
            box-shadow: none;
        }

        .btn-light:hover {
            background-color: initial;
        }
    }
</style>
@section('content')
    <div class="container-fluid py-4">
        {{-- Enhanced Search Bar --}}
        <div class="search-wrapper position-relative">
            <div class="input-group border rounded-3 bg-white shadow-sm hover:shadow-md transition-shadow">
        <span class="input-group-text border-0 bg-transparent">
            <i class="bi bi-search text-gray-500"></i>
        </span>
                <input type="text"
                       id="searchInput"
                       class="form-control border-0 shadow-none py-2"
                       placeholder="{{ __('search_placeholder') }}"
                       aria-label="{{ __('search_placeholder') }}">
                <div id="searchCount" class="d-none position-absolute end-0 top-100 mt-1 small text-muted">
                    <span id="searchResultCount">0</span> {{ __('results_found') }}
                </div>
                <button class="btn btn-link text-secondary border-0"
                        type="button"
                        id="clearSearch"
                        aria-label="{{ __('clear_search') }}">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="charter-content">
            @if($domaines->isEmpty())
                <div class="alert alert-warning py-3 rounded-3 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                        <span>{{ __('no_domains') }}</span>
                    </div>
                </div>
            @else
                @foreach($domaines as $domaine)
                    <div class="card mb-4 rounded-3 shadow-sm hover:shadow transition-shadow">
                        <div class="card-header bg-white py-3 px-4 border-bottom">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h2 class="h5 mb-0 d-flex align-items-center">
                                        <span class="badge bg-primary rounded-pill me-2">{{ $domaine->code }}</span>
                                        <span class="text-dark">{{ $domaine->name }}</span>
                                        @if(isset($country))
                                            <span class="text-muted ms-2">- {{ $country->name }}</span>
                                        @endif
                                    </h2>
                                </div>
                                <div class="col-auto">
                                    <div class="action-buttons d-flex gap-2">
                                        <button type="button"
                                                class="btn btn-light btn-sm rounded-pill shadow-sm hover:shadow-md transition-shadow"
                                                onclick="toggleDescription({{ $domaine->id }})"
                                                aria-expanded="false"
                                                aria-controls="description-{{ $domaine->id }}">
                                            <i class="bi bi-info-circle"></i>
                                            <span class="ms-1 d-none d-sm-inline">{{ __('Info') }}</span>
                                        </button>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('charter.print', $domaine->id) }}"
                                               class="btn btn-light rounded-start shadow-sm hover:shadow-md transition-shadow"
                                               title="{{ __('Print') }}">
                                                <i class="bi bi-printer"></i>
                                            </a>
                                            <a href="{{ route('charter.export', $domaine->id) }}"
                                               class="btn btn-light shadow-sm hover:shadow-md transition-shadow"
                                               title="{{ __('Export') }}">
                                                <i class="bi bi-download"></i>
                                            </a>
                                            <a href="{{ route('subject.create', ['class_id' => $domaine->id]) }}"
                                               class="btn btn-light shadow-sm hover:shadow-md transition-shadow"
                                               title="{{ __('Share') }}">
                                                <i class="bi bi-share"></i>
                                            </a>
                                            <a href="{{ route('subject.index') }}"
                                               class="btn btn-light rounded-end shadow-sm hover:shadow-md transition-shadow"
                                               title="{{ __('Subjects') }}">
                                                <i class="bi bi-chat-dots"></i>
                                                <span class="badge bg-secondary rounded-pill ms-1">
                                                {{ $domaine->subjects->count() }}
                                            </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="collapse" id="description-{{ $domaine->id }}">
                            <div class="card-body bg-light py-3 px-4 border-bottom">
                                <p class="mb-0 text-muted">{{ $domaine->description }}</p>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            @include('charter.classes', ['classes' => $domaine->children])
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const clearButton = document.getElementById('clearSearch');
            const searchCount = document.getElementById('searchCount');
            const searchResultCount = document.getElementById('searchResultCount');

            function highlightText(element, term) {
                const text = element.textContent;
                if (!term) {
                    // Restaurer le texte original
                    if (element._originalText) {
                        element.innerHTML = element._originalText;
                    }
                    return;
                }

                // Sauvegarder le texte original si pas déjà fait
                if (!element._originalText) {
                    element._originalText = text;
                }

                // Échapper les caractères spéciaux dans le terme de recherche
                const safeSearchTerm = term.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                const regex = new RegExp(`(${safeSearchTerm})`, 'gi');
                element.innerHTML = text.replace(regex, '<mark class="search-highlight">$1</mark>');
            }

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                let visibleRowCount = 0;

                document.querySelectorAll('.searchable-row').forEach(row => {
                    const text = row.textContent.toLowerCase();
                    const shouldShow = text.includes(searchTerm);
                    row.style.display = shouldShow ? '' : 'none';

                    if (shouldShow) {
                        visibleRowCount++;
                        if (searchTerm) {
                            // Mettre en surbrillance dans chaque cellule
                            row.querySelectorAll('td').forEach(cell => {
                                // Éviter les éléments interactifs
                                if (!cell.querySelector('button, .btn')) {
                                    const textElements = cell.querySelectorAll('.fw-medium, span:not(.badge)');
                                    textElements.forEach(el => highlightText(el, searchTerm));
                                }
                            });
                        }
                    } else {
                        // Restaurer le texte original
                        row.querySelectorAll('td .fw-medium, td span:not(.badge)').forEach(el => {
                            highlightText(el, '');
                        });
                    }

                    // Gérer les lignes enfants
                    const childrenRow = row.nextElementSibling;
                    if (childrenRow && childrenRow.classList.contains('children-row')) {
                        childrenRow.style.display = shouldShow ?
                            (childrenRow.classList.contains('d-none') ? 'none' : '') : 'none';
                    }
                });

                // Mettre à jour le compteur de résultats
                searchResultCount.textContent = visibleRowCount;
                searchCount.classList.toggle('d-none', !searchTerm);
            }

            searchInput.addEventListener('input', performSearch);
            clearButton.addEventListener('click', () => {
                searchInput.value = '';
                searchInput.focus();
                performSearch();
            });
        });
    </script>

@endsection
