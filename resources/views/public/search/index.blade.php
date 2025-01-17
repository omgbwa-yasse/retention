@extends('index')

@section('content')
    <div class="container text-center my-4">
        <h1><strong>{{ __('search') }}</strong></h1>

        <div class="container my-4">
            <div class="row justify-content-center text-center">
                @if(isset($number_country))
                    <div class="col-md-2 col-sm-4 mb-4">
                        <div class="card shadow-sm" style="transform: scale(0.75); margin: auto;">
                            <div class="card-body">
                                <div class="mb-2">
                                    <i class="bi bi-globe2 display-5 text-primary"></i>
                                </div>
                                <p class="display-6">{{ $number_country }}</p>
                                <h5 class="card-title mt-1">{{ __('statistics.countries') }}</h5>
                            </div>
                        </div>
                    </div>
                @endif

                @if(isset($number_classes))
                    <div class="col-md-2 col-sm-4 mb-4">
                        <div class="card shadow-sm" style="transform: scale(0.75); margin: auto;">
                            <div class="card-body">
                                <div class="mb-2">
                                    <i class="bi bi-tags display-5 text-success"></i>
                                </div>
                                <p class="display-6">{{ $number_classes }}</p>
                                <h5 class="card-title mt-1">{{ __('statistics.classifications') }}</h5>
                            </div>
                        </div>
                    </div>
                @endif

                @if(isset($number_rules))
                    <div class="col-md-2 col-sm-4 mb-4">
                        <div class="card shadow-sm" style="transform: scale(0.75); margin: auto;">
                            <div class="card-body">
                                <div class="mb-2">
                                    <i class="bi bi-list-check display-5 text-danger"></i>
                                </div>
                                <p class="display-6">{{ $number_rules }}</p>
                                <h5 class="card-title mt-1">{{ __('statistics.rules') }}</h5>
                            </div>
                        </div>
                    </div>
                @endif

                @if(isset($number_references))
                    <div class="col-md-2 col-sm-4 mb-4">
                        <div class="card shadow-sm" style="transform: scale(0.75); margin: auto;">
                            <div class="card-body">
                                <div class="mb-2">
                                    <i class="bi bi-book display-5 text-warning"></i>
                                </div>
                                <p class="display-6">{{ $number_references }}</p>
                                <h5 class="card-title mt-1">{{ __('statistics.references') }}</h5>
                            </div>
                        </div>
                    </div>
                @endif

                @if(isset($number_articles))
                    <div class="col-md-2 col-sm-4 mb-4">
                        <div class="card shadow-sm" style="transform: scale(0.75); margin: auto;">
                            <div class="card-body">
                                <div class="mb-2">
                                    <i class="bi bi-file-text display-5 text-info"></i>
                                </div>
                                <p class="display-6">{{ $number_articles }}</p>
                                <h5 class="card-title mt-1">{{ __('statistics.articles') }}</h5>
                            </div>
                        </div>
                    </div>
                @endif

                @if(isset($number_typologies))
                    <div class="col-md-2 col-sm-4 mb-4">
                        <div class="card shadow-sm" style="transform: scale(0.75); margin: auto;">
                            <div class="card-body">
                                <div class="mb-2">
                                    <i class="bi bi-diagram-3 display-5 text-secondary"></i>
                                </div>
                                <p class="display-6">{{ $number_typologies }}</p>
                                <h5 class="card-title mt-1">{{ __('statistics.typologies') }}</h5>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <form method="GET" action="{{ route('public.search') }}" class="d-flex justify-content-center">
            <input type="text" name="query" class="form-control me-2" placeholder="{{ __('search_placeholder') }}" value="{{ request('query') }}" />
            <button type="submit" class="btn btn-primary me-2">{{ __('search_button') }}</button>
            <a href="{{ route('public.search.advanced') }}" class="btn btn-primary">{{ __('advanced_search') }}</a>
        </form>
    </div>

    @if($records->isNotEmpty())
        <div class="container">
            @foreach($records as $key => $value)
                <div class="list-group mb-3">
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h2 class="fw-bold mb-2">
                                    {{ $value['name'] }}
                                    <span class="badge {{ $value['type'] === 'reference' ? 'bg-success' : ($value['type'] === 'rule' ? 'bg-primary' : ($value['type'] === 'class' ? 'bg-secondary' : '')) }} text-white badge-sm ms-2" style="font-size: 0.7rem; padding: 0.2em 0.4em;">
                                        @if($value['type'] === 'reference')
                                            <i class="bi bi-book" style="font-size: 0.7rem;"></i>
                                        @elseif($value['type'] === 'rule')
                                            <i class="bi bi-archive" style="font-size: 0.7rem;"></i>
                                        @elseif($value['type'] === 'class')
                                            <i class="bi bi-folder" style="font-size: 0.7rem;"></i>
                                        @endif
                                        {{ __('type.' . $value['type']) }}
                                    </span>
                                </h2>
                                <p class="mb-1">{{ $value['description'] }}</p>

                                @if(isset($value['parent']))
                                    <p class="mb-0">
                                        {{ __('also_see') }} : {{ $value['parent']['name'] ?? "" }}
                                    </p>
                                @endif

                                <small class="text-muted">
                                    @if(isset($value['country']))
                                        {{ $value['country']['name'] }}
                                        ({{ $value['country']['abbr'] }}),
                                    @endif

                                    @if(isset($value['created_at']))
                                        {{ \Carbon\Carbon::parse($value['created_at'])->format('d/m/Y') }}
                                    @else
                                        {{ __('date_unavailable') }}
                                    @endif

                                    @if(isset($value['user']))
                                        {{ __('by') }} {{ $value['user']['name'] }}
                                    @endif
                                </small>
                            </div>
                            <div class="ms-3">
                                @if($value['type'] === 'reference')
                                    <a href="{{ route('public.references.show', $value['id']) }}" class="btn btn-sm btn-outline-success">{{ __('see_details') }}</a>
                                @elseif ($value['type'] === 'rule')
                                    <a href="{{ route('public.rules.show', $value['id']) }}" class="btn btn-sm btn-outline-primary">{{ __('see_details') }}</a>
                                @else
                                    <div class="d-flex flex-column gap-2">
                                        <a href="{{ route('public.charter', $value['id']) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-chart-bar me-1"></i> {{ __('see_charter') }}
                                        </a>
                                        <a href="{{ route('public.classes.show', $value['id']) }}" class="btn btn-sm btn-outline-secondary">{{ __('see_details') }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if(method_exists($records, 'hasPages') && $records->hasPages())
                <nav aria-label="{{ __('pagination.pages') }}">
                    <ul class="pagination justify-content-center">
                        <li class="page-item {{ $records->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $records->appends(request()->query())->previousPageUrl() }}" aria-label="{{ __('pagination.previous') }}">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        @if($records->currentPage() > 3)
                            <li class="page-item">
                                <a class="page-link" href="{{ $records->appends(request()->query())->url(1) }}">1</a>
                            </li>
                            @if($records->currentPage() > 4)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                        @endif

                        @foreach(range(max(1, $records->currentPage() - 2), min($records->lastPage(), $records->currentPage() + 2)) as $page)
                            <li class="page-item {{ $page == $records->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $records->appends(request()->query())->url($page) }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if($records->currentPage() < $records->lastPage() - 2)
                            @if($records->currentPage() < $records->lastPage() - 3)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                            <li class="page-item">
                                <a class="page-link" href="{{ $records->appends(request()->query())->url($records->lastPage()) }}">{{ $records->lastPage() }}</a>
                            </li>
                        @endif

                        <li class="page-item {{ $records->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $records->appends(request()->query())->nextPageUrl() }}" aria-label="{{ __('pagination.next') }}">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif
        </div>
    @else
        <div class="alert alert-info text-center">
            {{ __('no_results') }}
        </div>
    @endif

    <style>
        @if(app()->getLocale() === 'ar')
        .container {
            direction: rtl;
            text-align: right;
        }
        .text-center {
            text-align: center !important;
        }
        .me-1, .me-2 {
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
    </style>
@endsection
