@extends('index')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary fw-bold">Typologies documentaires</h1>
            <div>
                <a href="{{ route('typology.create') }}" class="btn btn-primary me-2">
                    <i class="bi bi-plus-circle"></i> Créer une Typologie
                </a>
                <a href="{{ route('typology.export') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-pdf"></i> Exporter en PDF
                </a>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('typology.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-lg" placeholder="Rechercher une typologie..." value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-search"></i> Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($typologies as $typology)
                <div class="col">
                    <div class="card h-100 shadow-sm hover-shadow">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-primary">{{ $typology->name }}</h5>
                            <p class="card-text">{{ Str::limit($typology->description, 100) }}</p>
                            <p class="card-text">
                                <small class="text-muted">Domaine :
                                    <span class="fw-bold">{{ $typology->category ? $typology->category->name : 'N/A' }}</span>
                                </small>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 text-end">
                            <a href="{{ route('typology.show', $typology->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye"></i> Voir détails
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $typologies->links() }}
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .hover-shadow:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
            transition: box-shadow 0.3s ease-in-out;
        }
    </style>
@endpush
