@extends('index')
<style>
    body {
        background-color: #f8f9fa;
    }
    .container {
        max-width: 1200px;
    }
    .card {
        border: none;
        border-radius: 0.5rem;
        transition: all 0.3s ease-in-out;
    }
    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-5px);
    }
    .btn {
        border-radius: 0.25rem;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
    .card-footer {
        background-color: transparent;
        border-top: 1px solid rgba(0,0,0,.125);
        padding-top: 1rem;
    }
</style>
@section('content')
    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="display-4 text-primary"><i class="bi bi-diagram-3 me-3"></i>Typologies documentaires</h1>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('typology.create') }}" class="btn btn-primary btn-lg me-2">
                    <i class="bi bi-plus-circle me-2"></i>Créer une Typologie
                </a>
                <a href="{{ route('typology.export') }}" class="btn btn-success btn-lg">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Exporter en PDF
                </a>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('typology.index') }}" method="GET">
                    <div class="input-group input-group-lg">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher une typologie..." value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-search me-2"></i>Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($typologies as $typology)
                <div class="col">
                    <div class="card h-100 shadow-sm hover-shadow">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-primary mb-3">{{ $typology->name }}</h5>
                            <p class="card-text mb-3">{{ Str::limit($typology->description, 100) }}</p>
                            <p class="card-text">
                                <small class="text-muted">Domaine : <span class="fw-bold">{{ $typology->category ? $typology->category->name : 'N/A' }}</span></small>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 text-end">
                            <a href="{{ route('typology.show', $typology->id) }}" class="btn btn-outline-primary">
                                <i class="bi bi-eye me-2"></i>Voir détails
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $typologies->links() }}
        </div>
    </div>
@endsection
