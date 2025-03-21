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
                            <!-- First row: Search term -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control" id="term" name="term"
                                               value="{{ request('term') }}" placeholder="{{ __('search_placeholder') }}">
                                        <label for="term">{{ __('search_term') }}</label>
                                    </div>
                                    <input type="hidden" id="searchQuery" name="searchQuery" value="{{ request('searchQuery') }}">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="input-group">
                                            <select class="form-select" id="termSelector">
                                                <option value="contains">Contient</option>
                                                <option value="starts">Commence par</option>
                                                <option value="except">Sauf</option>
                                            </select>
                                            <input type="text" class="form-control" id="newTerm" placeholder="Ajouter un terme">
                                            <button type="button" class="btn btn-success" id="addTermBtn">
                                                <i class="bi bi-plus-lg"></i> Ajouter
                                            </button>
                                        </div>
                                    </div>
                                    <div id="searchTerms" class="mb-2 d-flex flex-wrap gap-2">
                                        <!-- Search terms will be displayed here -->
                                    </div>
                                </div>
                            </div>

                            <!-- Second row: Type, Country, Dates -->
                            <div class="row mb-4">
                                <!-- Search type -->
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <div class="form-floating">
                                        <select class="form-select" id="type" name="type">
                                            <option value="reference" {{ request('type') == 'reference' ? 'selected' : '' }}>{{ __('references') }}</option>
                                        </select>
                                        <label for="type">{{ __('type') }}</label>
                                    </div>
                                </div>

                                <!-- Country -->
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <div class="form-floating">
                                        <select class="form-select" id="countries" name="country">
                                            @foreach($countries as $country)
                                                <option value="">
                                                    Tous les pays
                                                </option>
                                                <option value="{{ $country->id }}">
                                                    {{ $country->name }} ({{ $country->abbr }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="countries">{{ __('country') }}</label>
                                    </div>
                                </div>

                                <!-- Dates -->
                                <div class="col-md-6">
                                    <div class="row g-3">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="date_from" name="date_from"
                                                       value="{{ request('date_from') }}">
                                                <label for="date_from">{{ __('date_start') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="date_to" name="date_to"
                                                       value="{{ request('date_to') }}">
                                                <label for="date_to">{{ __('date_end') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Third row: Search button -->
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100 py-2" id="searchBtn">
                                        <i class="bi bi-search me-2"></i> {{ __('search') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Search results -->
                @if(isset($references) && $references->count() > 0)
                    <div class="card border-0 shadow-sm">
                        <div class="bg-light py-2 px-3 mb-3">
                            <h5 class="mb-0 fs-4">{{ __('search_results') }} ({{ $references->count() }} {{ __('results_found') }})</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                    <tr>
                                        <th>{{ __('table.type') }}</th>
                                        <th>{{ __('table.name') }}</th>
                                        <th>{{ __('table.description') }}</th>
                                        <th>{{ __('table.country') }}</th>
                                        <th>{{ __('table.date') }}</th>
                                        <th>{{ __('table.actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($references as $record)
                                        <tr>
                                            <td>
                                                <span class="badge bg-info">{{ __('badges.reference') }}</span>
                                            </td>
                                            <td class="fw-medium">{{ $record['name'] }}</td>
                                            <td>{{ Str::limit($record['description'], 100) }}</td>
                                            <td>{{ $record['country']['name'] ?? __('not_available') }}</td>
                                            <td>{{ $record['created_at'] ? date('d/m/Y', strtotime($record['created_at'])) : __('not_available') }}</td>
                                            <td>
                                                @switch($record['type'])
                                                    @case('rule')
                                                        <a href="{{ route('public.rules.show', $record['id']) }}" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-eye me-1"></i> {{ __('view') }}
                                                        </a>
                                                        @break
                                                    @case('class')
                                                        <a href="{{ route('public.classes.show', $record['id']) }}" class="btn btn-sm btn-success">
                                                            <i class="bi bi-eye me-1"></i> {{ __('view') }}
                                                        </a>
                                                        @break
                                                    @case('reference')
                                                        <a href="{{ route('public.references.show', $record['id']) }}" class="btn btn-sm btn-info">
                                                            <i class="bi bi-eye me-1"></i> {{ __('view') }}
                                                        </a>
                                                        @break
                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @elseif(request()->has('term'))
                    <div class="alert alert-info text-center p-4 border-0">
                        <i class="bi bi-search fs-4 mb-2 d-block"></i>
                        <p class="mb-0 fs-5">{{ __('no_results') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        input, textarea, select {
            box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
        }

        .hover-underline:hover {
            text-decoration: underline !important;
        }

        @if(app()->getLocale() === 'ar')
        .container {
            direction: rtl;
            text-align: right;
        }
        .text-center {
            text-align: center !important;
        }
        .me-1, .me-2 {
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
        @endif

        .search-term-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            border-radius: 1rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .search-term-badge .remove-term {
            margin-left: 0.5rem;
            cursor: pointer;
        }

        .contains-term {
            background-color: #dff0d8;
            color: #3c763d;
        }

        .starts-term {
            background-color: #d9edf7;
            color: #31708f;
        }

        .except-term {
            background-color: #f2dede;
            color: #a94442;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateExact = document.getElementById('date');
            const dateFrom = document.getElementById('date_from');
            const dateTo = document.getElementById('date_to');

            // Advanced search with term selectors
            const termInput = document.getElementById('term');
            const newTermInput = document.getElementById('newTerm');
            const termSelector = document.getElementById('termSelector');
            const addTermBtn = document.getElementById('addTermBtn');
            const searchTermsContainer = document.getElementById('searchTerms');
            const searchQueryInput = document.getElementById('searchQuery');
            const searchBtn = document.getElementById('searchBtn');

            let searchTerms = [];

            // Load any existing search query
            if (searchQueryInput.value) {
                try {
                    searchTerms = JSON.parse(searchQueryInput.value);
                    renderSearchTerms();
                } catch (e) {
                    console.error('Error parsing search query', e);
                }
            }

            // Add term button click
            addTermBtn.addEventListener('click', function() {
                addSearchTerm();
            });

            // Enter key in newTerm input
            newTermInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addSearchTerm();
                }
            });

            function addSearchTerm() {
                const term = newTermInput.value.trim();
                if (term) {
                    const selector = termSelector.value;
                    searchTerms.push({
                        selector: selector,
                        term: term
                    });

                    newTermInput.value = '';
                    renderSearchTerms();
                    updateSearchInput();
                }
            }

            function renderSearchTerms() {
                searchTermsContainer.innerHTML = '';

                if (searchTerms.length === 0) {
                    return;
                }

                searchTerms.forEach((item, index) => {
                    const termBadge = document.createElement('div');
                    termBadge.className = `search-term-badge ${item.selector}-term`;

                    let selectorText = '';
                    switch (item.selector) {
                        case 'contains':
                            selectorText = 'Contient';
                            break;
                        case 'starts':
                            selectorText = 'Commence par';
                            break;
                        case 'except':
                            selectorText = 'Sauf';
                            break;
                    }

                    termBadge.innerHTML = `
                        <span><strong>${selectorText}:</strong> ${item.term}</span>
                        <span class="remove-term" data-index="${index}">×</span>
                    `;

                    searchTermsContainer.appendChild(termBadge);
                });

                // Add event listeners to remove buttons
                document.querySelectorAll('.remove-term').forEach(btn => {
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

                // Update the main term input with a formatted representation
                let formattedQuery = searchTerms.map(item => {
                    switch (item.selector) {
                        case 'contains':
                            return item.term;
                        case 'starts':
                            return `^${item.term}`;
                        case 'except':
                            return `-${item.term}`;
                        default:
                            return item.term;
                    }
                }).join(' ');

                termInput.value = formattedQuery;
            }

            function toggleDateFields() {
                const isDateExactFilled = dateExact?.value !== '';
                if (dateFrom && dateTo && dateExact) {
                    dateFrom.disabled = isDateExactFilled;
                    dateTo.disabled = isDateExactFilled;

                    if (isDateExactFilled) {
                        dateFrom.value = '';
                        dateTo.value = '';
                    }
                }
            }

            if (dateExact) {
                dateExact.addEventListener('change', toggleDateFields);
                toggleDateFields();
            }

            // Form submission
            document.querySelector('form').addEventListener('submit', function(e) {
                // Make sure the searchQuery is updated
                updateSearchInput();
            });
        });
    </script>
@endsection
