<!-- resources/views/public/search/index.blade.php -->
@extends('index')

@section('content')
    <div class="container my-4">
        <!-- En-tête de recherche -->
        <div class="mb-4">
            <h1 class="text-primary fw-bold">Recherche</h1>
            <form action="{{ route('public.search') }}" method="GET" class="mt-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="search"
                                           name="q"
                                           class="form-control form-control-lg"
                                           placeholder="Rechercher..."
                                           value="{{ request('q') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="type" class="form-select form-select-lg">
                                    <option value="">Tous les types</option>
                                    <option value="activity" {{ request('type') == 'activity' ? 'selected' : '' }}>Classifications</option>
                                    <option value="reference" {{ request('type') == 'reference' ? 'selected' : '' }}>Références</option>
                                    <option value="rule" {{ request('type') == 'rule' ? 'selected' : '' }}>Règles</option>
                                    <option value="typology" {{ request('type') == 'typology' ? 'selected' : '' }}>Typologies</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @if(request('q'))
            <!-- Résultats de recherche -->
            @if(empty($results))
                <div class="alert alert-info shadow-sm">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun résultat trouvé pour "{{ request('q') }}"
                </div>
            @else
                @foreach($results as $type => $items)
                    @if(count($items) > 0)
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h3 class="card-title mb-0">
                                    @switch($type)
                                        @case('activities')
                                            <i class="fas fa-folder me-2"></i>Classifications
                                            @break
                                        @case('references')
                                            <i class="fas fa-book me-2"></i>Références
                                            @break
                                        @case('rules')
                                            <i class="fas fa-gavel me-2"></i>Règles
                                            @break
                                        @case('typologies')
                                            <i class="fas fa-th-large me-2"></i>Typologies
                                            @break
                                    @endswitch
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    @foreach($items as $item)
                                        <div class="list-group-item list-group-item-action p-3">
                                            <div class="d-flex w-100 justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="mb-1 fw-bold">{{ $item->name }}</h5>
                                                    @if(isset($item->code))
                                                        <p class="mb-1 text-muted small">Code: {{ $item->code }}</p>
                                                    @endif
                                                    <p class="mb-1">{{ Str::limit($item->description, 150) }}</p>
                                                </div>
                                                <a href="{{ route('public.' . Str::singular($type) . '.show', $item->id) }}"
                                                   class="btn btn-outline-primary btn-sm">
                                                    Voir détails
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if(count($items) >= 5)
                                <div class="card-footer text-center">
                                    <a href="{{ route('public.' . $type) }}?q={{ request('q') }}"
                                       class="text-decoration-none">
                                        Voir tous les résultats
                                        <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            @endif
        @else
            <!-- Message d'accueil quand aucune recherche n'est effectuée -->
            <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h3 class="text-muted">Commencez votre recherche</h3>
                <p class="text-muted">
                    Utilisez la barre de recherche ci-dessus pour trouver des classifications, références, règles ou typologies
                </p>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
        .list-group-item:hover {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }
        .btn-outline-primary:hover {
            color: #fff;
        }
    </style>
@endpush
