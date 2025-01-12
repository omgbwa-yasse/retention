@extends('index')

@section('content')
    <div class="container text-center my-4">
        <h1>Trouvez tout ici !</h1>
        <form method="GET" action="{{ route('public.search') }}" class="d-flex justify-content-center">
            <input type="text" name="query" class="form-control me-2" placeholder="Search..." value="{{ request('query') }}" />
            <button type="submit" class="btn btn-primary me-2">Rechercher</button>
            <a href="{{ route('public.search.advanced') }}" class="btn btn-primary">Avancée</a>
        </form>
    </div>

    @if($records->isNotEmpty())
        <div class="container">
            @foreach($records as $key => $value)
                <div class="list-group mb-3">
                    <div class="list-group-item">
                        <h2 class="fw-bold">
                            {{ $value['name'] }}

                            @if($value['type'] === 'reference')
                                <a href="{{ route('public.references.show', $value['id']) }}" class="btn btn-sm btn-outline-success">Voir</a>
                            @elseif ($value['type'] === 'rule')
                                <a href="{{ route('public.rules.show', $value['id']) }}" class="btn btn-sm btn-outline-primary">Voir</a>
                            @else
                                <a href="{{ route('public.charter', $value['id']) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-chart-bar me-1"></i> {{ __('see_charter') }}
                                </a>
                                <a href="{{ route('public.classes.show', $value['id']) }}" class="btn btn-sm btn-outline-secondary">Voir</a>
                            @endif

                            <span class="badge {{ $value['type'] === 'reference' ? 'bg-success' : ($value['type'] === 'rule' ? 'bg-primary' : ($value['type'] === 'class' ? 'bg-secondary' : '')) }} text-white">
                                @if($value['type'] === 'reference')
                                    <i class="bi bi-book me-1"></i>
                                @elseif($value['type'] === 'rule')
                                    <i class="bi bi-archive me-1"></i>
                                @elseif($value['type'] === 'class')
                                    <i class="bi bi-folder me-1"></i>
                                @endif
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
                            <a class="page-link" href="{{ $records->url($i) }}{{ $searchTerm ? 'query=' . $searchTerm : '' }}">{{ $i }}</a>
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
