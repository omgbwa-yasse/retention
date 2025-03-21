@extends('index')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4"><strong>{{ __('search') }}</strong></h1>

                <form method="GET" action="{{ route('public.search') }}" class="d-flex justify-content-center mb-5">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" placeholder="{{ __('search_placeholder') }}" value="{{ request('query') }}" />
                        <button type="submit" class="btn btn-primary">{{ __('search_button') }}</button>
                        <a href="{{ route('public.search.advanced') }}" class="btn btn-outline-primary">{{ __('advanced_search') }}</a>
                    </div>
                </form>
            </div>
        </div>

        @if($references->isNotEmpty())
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="mb-4 border-0">
                        <div class="bg-light py-2 px-3 mb-3">
                            <h5 class="mb-0 fs-4">{{ __('search_results') }}</h5>
                        </div>
                        <div class="list-unstyled">
                            @foreach($references as $value)
                                <div class="py-3 border-0 mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mb-3">
                                                <a href="{{ route('public.references.show', $value['id']) }}" class="text-decoration-none">
                                                    <h2 class="h4 fw-bold mb-0 text-primary hover-underline">{{ $value['name'] }}</h2>
                                                </a>
                                                <span class="badge {{ $value['type'] === 'reference' ? 'bg-success' : ($value['type'] === 'rule' ? 'bg-primary' : ($value['type'] === 'class' ? 'bg-secondary' : '')) }} ms-2 fs-6">
                                                    <i class="bi bi-book me-1"></i>
                                                    {{ $value['type'] }}
                                                </span>
                                            </div>
                                            <p class="mb-3 fs-5">{{ $value['description'] }}</p>

                                            <div class="d-flex flex-wrap text-muted fs-6">
                                                @if(isset($value['articles']))
                                                    <div class="me-3 mb-1">
                                                        <i class="bi bi-file-text"></i>
                                                        <strong>{{ $value->articles->count() }}</strong> {{ __('articles') }}
                                                    </div>
                                                @endif

                                                @if(isset($value['country']))
                                                    <div class="me-3 mb-1">
                                                        <i class="bi bi-geo-alt"></i>
                                                        <strong>{{ $value['country']['name'] }}</strong> ({{ $value['country']['abbr'] }})
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
                                                        {{ $value->created_at }}
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
                                        </div>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <hr class="my-0 opacity-25">
                                @endif
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $references->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        @else
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
@endsection
