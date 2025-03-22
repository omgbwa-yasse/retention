@extends('index')

<style>
    :root {
        --transition-duration: 0.2s;
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

    .country-card {
        border-radius: 0.5rem;
        transition: transform var(--transition-duration) ease-in-out,
                    box-shadow var(--transition-duration) ease-in-out;
    }

    .country-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all var(--transition-duration) ease-in-out;
    }

    .badge-country {
        font-weight: 500;
        font-size: 0.85rem;
        padding: 0.35em 0.65em;
    }

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
</style>

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">{{ __('Countries') }}</h1>
            @if(auth()->check())
                <a href="{{ route('country.create') }}" class="btn btn-primary d-flex align-items-center">
                    <i class="bi bi-plus-lg me-2"></i>
                    {{ __('New Country') }}
                </a>
            @endif
        </div>

        {{-- Enhanced Search Bar --}}
        <div class="search-wrapper position-relative mb-4">
            <div class="input-group border rounded-3 bg-white shadow-sm hover:shadow-md transition-shadow">
                <span class="input-group-text border-0 bg-transparent">
                    <i class="bi bi-search text-gray-500"></i>
                </span>
                <input type="text"
                       id="searchInput"
                       class="form-control border-0 shadow-none py-2"
                       placeholder="{{ __('Search countries...') }}"
                       aria-label="{{ __('Search countries...') }}">
                <button class="btn btn-link text-secondary border-0"
                        type="button"
                        id="clearSearch"
                        aria-label="{{ __('Clear search') }}">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div id="searchCount" class="d-none position-absolute end-0 top-100 mt-1 small text-muted">
                <span id="searchResultCount">0</span> {{ __('results found') }}
            </div>
        </div>

        {{-- Alert Messages --}}
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Countries Grid --}}
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4" id="countriesContainer">
            @foreach ($Countries as $country)
                <div class="col searchable-item">
                    <div class="card country-card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title mb-0">
                                    <a href="{{ route('country.show', $country->id) }}" class="text-decoration-none stretched-link">
                                        {{ $country->name }}
                                    </a>
                                </h5>
                                <span class="badge badge-country bg-primary rounded-pill">{{ $country->abbr }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Empty State --}}
        @if($Countries->isEmpty())
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-globe fs-1 text-muted"></i>
                </div>
                <h3>{{ __('No Countries Found') }}</h3>
                <p class="text-muted">{{ __('No countries have been added yet.') }}</p>
                @if(auth()->check())
                    <a href="{{ route('country.create') }}" class="btn btn-primary mt-2">
                        <i class="bi bi-plus-lg me-2"></i>
                        {{ __('Add First Country') }}
                    </a>
                @endif
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const clearButton = document.getElementById('clearSearch');
            const searchCount = document.getElementById('searchCount');
            const searchResultCount = document.getElementById('searchResultCount');
            const countriesContainer = document.getElementById('countriesContainer');

            function highlightText(element, term) {
                if (!term) {
                    // Restore original text
                    if (element._originalHTML) {
                        element.innerHTML = element._originalHTML;
                    }
                    return;
                }

                // Save original HTML if not already saved
                if (!element._originalHTML) {
                    element._originalHTML = element.innerHTML;
                }

                // Escape special characters in search term
                const safeSearchTerm = term.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                const regex = new RegExp(`(${safeSearchTerm})`, 'gi');

                // Don't modify links and other elements, only text content
                const text = element.textContent;
                const newText = text.replace(regex, '<mark class="search-highlight">$1</mark>');

                // Only replace if there's a match
                if (text !== newText.replace(/<\/?mark[^>]*>/g, '')) {
                    element.innerHTML = element.innerHTML.replace(text, newText);
                }
            }

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                document.querySelectorAll('.searchable-item').forEach(item => {
                    const text = item.textContent.toLowerCase();
                    const shouldShow = searchTerm === '' || text.includes(searchTerm);

                    item.style.display = shouldShow ? '' : 'none';

                    if (shouldShow) {
                        visibleCount++;

                        if (searchTerm) {
                            // Highlight matches in title and other text elements
                            item.querySelectorAll('.card-title, .badge-country').forEach(el => {
                                highlightText(el, searchTerm);
                            });
                        }
                    } else {
                        // Restore original text
                        item.querySelectorAll('.card-title, .badge-country').forEach(el => {
                            highlightText(el, '');
                        });
                    }
                });

                // Update search count
                searchResultCount.textContent = visibleCount;
                searchCount.classList.toggle('d-none', !searchTerm);

                // Show empty state if no results
                const emptyState = document.querySelector('.text-center.py-5');
                if (emptyState) {
                    emptyState.style.display = visibleCount === 0 && searchTerm ? 'block' : 'none';
                }
            }

            if (searchInput) {
                searchInput.addEventListener('input', performSearch);
            }

            if (clearButton) {
                clearButton.addEventListener('click', () => {
                    searchInput.value = '';
                    searchInput.focus();
                    performSearch();
                });
            }

            // Handle keyboard navigation
            document.addEventListener('keydown', function(event) {
                // Clear search on Escape
                if (event.key === 'Escape' && document.activeElement === searchInput) {
                    searchInput.value = '';
                    performSearch();
                }

                // Focus search on Ctrl/Cmd + F
                if ((event.ctrlKey || event.metaKey) && event.key === 'f') {
                    event.preventDefault();
                    searchInput.focus();
                }
            });

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            if (typeof bootstrap !== 'undefined') {
                tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                    new bootstrap.Tooltip(tooltipTriggerEl, {
                        delay: { show: 500, hide: 100 }
                    });
                });
            }

            // Add loading states to buttons
            document.querySelectorAll('a.btn').forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (icon) {
                        const originalClass = icon.className;
                        icon.className = 'bi bi-hourglass-split animate-spin';

                        // Restore original icon if navigation takes too long
                        setTimeout(() => {
                            if (document.body.contains(icon)) {
                                icon.className = originalClass;
                            }
                        }, 5000);
                    }
                });
            });
        });
    </script>

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
    </style>
@endsection
