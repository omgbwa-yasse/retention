@extends('index')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="display-4 text-primary mb-4"><i class="fas fa-book-open me-3"></i>Référentiels juridiques</h1>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <a href="{{ route('reference.create') }}" class="btn btn-primary me-2">
                                    <i class="fas fa-plus"></i> Ajouter une référence
                                </a>
                                <a href="#" class="btn btn-secondary">
                                    <i class="fas fa-print"></i> Imprimer
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('reference.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Rechercher une référence...">
                                        <button class="btn btn-outline-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow">
                    <div class="card-body">
                        <div class="list-group">
                            @if ($references->isEmpty())
                                <div class="alert alert-info" role="alert">
                                    Aucune référence trouvée.
                                </div>
                            @else
                                @foreach ($references as $reference)
                                    <div class="list-group-item list-group-item-action border-0 mb-3 shadow-sm rounded">
                                        <div class="d-flex w-100 justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $reference->id }}" id="reference-{{ $reference->id }}">
                                                <label class="form-check-label" for="reference-{{ $reference->id }}">
                                                    <h5 class="mb-1 fw-bold">{{ $reference->name }}</h5>
                                                </label>
                                            </div>
                                            <div>
                                                <a href="{{ route('reference.show', $reference->id) }}" class="btn btn-sm btn-outline-primary me-2">Voir plus</a>
                                            </div>
                                        </div>
                                        <p class="mb-1 mt-2">{{ $reference->description }}</p>
                                        <small class="text-muted">
                                            @unless(optional($reference->articles)->isEmpty())
                                                <span class="badge bg-info text-dark me-2">{{ optional($reference->articles)->count() }} article(s)</span>
                                            @endunless
                                            <a href="{{ route('reference-category.show', $reference->category->id) }}" class="text-decoration-none me-2">
                                                <i class="fas fa-folder"></i> {{ $reference->category->name }}
                                            </a>
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-globe"></i> {{ $reference->country_name }}
                                            </a>
                                        </small>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $references->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


