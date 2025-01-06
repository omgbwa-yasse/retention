@extends('index')

@section('content')
    <div class="container text-center my-4">
        <h1>Trouvez vos délais de conservation !</h1>
        <form method="GET" action="{{ route('public.search') }}" class="d-flex justify-content-center">
            <input type="text"
                   name="query"
                   class="form-control me-2"
                   placeholder="Search..."
                   value="{{ request('query') }}" {{-- Garde la valeur de recherche --}}
            />
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    @if($records->isNotEmpty())
        <div class="container">
            @foreach($records as $key => $value)
                <div class="list-group mb-3">
                    <div class="list-group-item">
                        <h2 class="fw-bold">
                            {{ $value['name'] }}
                            <span class="badge {{ $value['type'] === 'reference' ? 'bg-success' : ($value['type'] === 'rule' ? 'bg-primary' : ($value['type'] === 'class' ? 'bg-secondary' : '')) }} text-white">
                                {{ ucfirst($value['type']) }}
                            </span>
                        </h2>
                        <p class="mb-1">{{ $value['description'] }}</p>

                        @if(isset($value['parent']))
                            <p class="mb-0">
                                Voir aussi : {{ $value['parent']['name'] ?? "" }}
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
                                {{ 'Date non disponible' }}
                            @endif

                            @if(isset($value['user']))
                                par {{ $value['user']['name'] }}
                            @endif
                        </small>
                    </div>
                </div>
            @endforeach


            @if($records instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{-- Bouton Previous --}}
                        <li class="page-item {{ ($records->currentPage() == 1) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $records->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        {{-- Numéros de page --}}
                        @for ($i = max(1, $records->currentPage() - 2); $i <= min($records->lastPage(), $records->currentPage() + 2); $i++)
                            <li class="page-item {{ ($records->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $records->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Bouton Next --}}
                        <li class="page-item {{ ($records->currentPage() == $records->lastPage()) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $records->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif
        </div>
    @else
        <div class="alert alert-info text-center">
            Aucun résultat trouvé.
        </div>
    @endif
@endsection
