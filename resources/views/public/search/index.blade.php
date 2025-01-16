@extends('index')

@section('content')
    <div class="container text-center my-4">

        <h1><strong> Rechercher !</strong></h1>


        <div class="container my-4">
            <div class="row justify-content-center text-center">
                @if(isset($number_country))
                <!-- Nombre de pays -->
                <div class="col-md-2 col-sm-4 mb-4">
                    <div class="card shadow-sm" style="transform: scale(0.75); margin: auto;">
                        <div class="card-body">
                            <div class="mb-2">
                                <i class="bi bi-globe2 display-5 text-primary"></i>
                            </div>
                            <p class="display-6">{{ $number_country }}</p>
                            <h5 class="card-title mt-1">Pays</h5>
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($number_classes))
                <!-- Nombre de classifications -->
                <div class="col-md-2 col-sm-4 mb-4">
                    <div class="card shadow-sm" style="transform: scale(0.75); margin: auto;">
                        <div class="card-body">
                            <div class="mb-2">
                                <i class="bi bi-tags display-5 text-success"></i>
                            </div>
                            <p class="display-6">{{ $number_classes }}</p>
                            <h5 class="card-title mt-1">Classifications</h5>
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($number_rules))
                <!-- Nombre de règles -->
                <div class="col-md-2 col-sm-4 mb-4">
                    <div class="card shadow-sm" style="transform: scale(0.75); margin: auto;">
                        <div class="card-body">
                            <div class="mb-2">
                                <i class="bi bi-list-check display-5 text-danger"></i>
                            </div>
                            <p class="display-6">{{ $number_rules }}</p>
                            <h5 class="card-title mt-1">Règles</h5>
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($number_references))
                <!-- Nombre de références -->
                <div class="col-md-2 col-sm-4 mb-4">
                    <div class="card shadow-sm" style="transform: scale(0.75); margin: auto;">
                        <div class="card-body">
                            <div class="mb-2">
                                <i class="bi bi-book display-5 text-warning"></i>
                            </div>
                            <p class="display-6">{{ $number_references }}</p>
                            <h5 class="card-title mt-1">Références</h5>
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($number_articles))
                <!-- Nombre d'articles -->
                <div class="col-md-2 col-sm-4 mb-4">
                    <div class="card shadow-sm" style="transform: scale(0.75); margin: auto;">
                        <div class="card-body">
                            <div class="mb-2">
                                <i class="bi bi-file-text display-5 text-info"></i>
                            </div>
                            <p class="display-6">{{ $number_articles }}</p>
                            <h5 class="card-title mt-1">Articles</h5>
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($number_typologies))
                <!-- Nombre de typologies -->
                <div class="col-md-2 col-sm-4 mb-4">
                    <div class="card shadow-sm" style="transform: scale(0.75); margin: auto;">
                        <div class="card-body">
                            <div class="mb-2">
                                <i class="bi bi-diagram-3 display-5 text-secondary"></i>
                            </div>
                            <p class="display-6">{{ $number_typologies }}</p>
                            <h5 class="card-title mt-1">Typologies</h5>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>



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
                            <div class="ms-3">
                                @if($value['type'] === 'reference')
                                    <a href="{{ route('public.references.show', $value['id']) }}" class="btn btn-sm btn-outline-success">Voir</a>
                                @elseif ($value['type'] === 'rule')
                                    <a href="{{ route('public.rules.show', $value['id']) }}" class="btn btn-sm btn-outline-primary">Voir</a>
                                @else
                                    <div class="d-flex flex-column gap-2">
                                        <a href="{{ route('public.charter', $value['id']) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-chart-bar me-1"></i> {{ __('see_charter') }}
                                        </a>
                                        <a href="{{ route('public.classes.show', $value['id']) }}" class="btn btn-sm btn-outline-secondary">Voir</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if(method_exists($records, 'hasPages') && $records->hasPages())
                <nav aria-label="Navigation des pages">
                    <ul class="pagination justify-content-center">
                        {{-- Bouton Previous --}}
                        <li class="page-item {{ $records->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $records->appends(request()->query())->previousPageUrl() }}" aria-label="Précédent">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        {{-- Première page --}}
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

                        {{-- Pages numérotées --}}
                        @foreach(range(max(1, $records->currentPage() - 2), min($records->lastPage(), $records->currentPage() + 2)) as $page)
                            <li class="page-item {{ $page == $records->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $records->appends(request()->query())->url($page) }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Dernière page --}}
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

                        {{-- Bouton Next --}}
                        <li class="page-item {{ $records->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $records->appends(request()->query())->nextPageUrl() }}" aria-label="Suivant">
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
