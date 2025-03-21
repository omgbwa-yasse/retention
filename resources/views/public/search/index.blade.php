@extends('index')

@section('content')
    <div class="container text-center my-4">
        <h1><strong>{{ __('search') }}</strong></h1>

        <form method="GET" action="{{ route('public.search') }}" class="d-flex justify-content-center">
            <input type="text" name="query" class="form-control me-2" placeholder="{{ __('search_placeholder') }}" value="{{ request('query') }}" />
            <button type="submit" class="btn btn-primary me-2">{{ __('search_button') }}</button>
            <a href="{{ route('public.search.advanced') }}" class="btn btn-primary">{{ __('advanced_search') }}</a>
        </form>
    </div>

    @if($references->isNotEmpty())
        <div class="container">
            @foreach($references as $value)
                <div class="list-group mb-3">
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h2 class="fw-bold mb-2">
                                     {{ $value['name'] }}
                                    <span class="badge {{ $value['type'] === 'reference' ? 'bg-success' : ($value['type'] === 'rule' ? 'bg-primary' : ($value['type'] === 'class' ? 'bg-secondary' : '')) }} text-white badge-sm ms-2" style="font-size: 0.7rem; padding: 0.2em 0.4em;">
                                            <i class="bi bi-book" style="font-size: 0.7rem;"></i>
                                    </span>
                                </h2>
                                <p class="mb-1">{{ $value['description'] }}</p>

                                @if(isset($value['articles']))
                                    <strong class="text-primary">{{ $value->articles->count() }} articles</strong> |
                                @endif

                                <small class="text-muted">
                                    @if(isset($value['country']))
                                        ({{ $value['country']['abbr'] }})  <strong class="text-primary">{{ $value['country']['name'] }}</strong> |
                                    @endif

                                    @if(isset($value['category']))
                                        Categorie : <strong class="text-primary">{{  $value->category->name }}</strong> |
                                    @endif

                                    @if(isset($value['created_at']))
                                        {{ $value->created_at }}
                                    @else
                                        {{ __('date_unavailable') }}
                                    @endif

                                    @if(isset($value['user']))
                                        {{ __('by') }} {{ $value['user']['name'] }}
                                    @endif
                                </small>
                            </div>
                            <div class="ms-3">
                                    <a href="{{ route('public.references.show', $value['id']) }}" class="btn btn-sm btn-outline-success">{{ __('see_details') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

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
