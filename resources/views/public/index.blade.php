<!-- resources/views/public/index.blade.php -->
@extends('index')

@section('content')
    <div class="container-fluid px-4">
        <!-- Hero Section -->
        <div class="bg-primary text-white p-5 rounded-3 mb-4 shadow-sm">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="fw-bold mb-3">Portail africain des délais de conservation</h1>
                        <p class="lead mb-4">Accédez aux informations sur les délais de conservation des documents en Afrique</p>

                        <!-- Barre de recherche principale -->
                        <form action="{{ route('public.search') }}" method="GET" class="mb-3">
                            <div class="input-group input-group-lg shadow-sm">
                                <input type="search"
                                       name="q"
                                       class="form-control"
                                       placeholder="Rechercher des classifications, références, règles..."
                                       aria-label="Recherche">
                                <button class="btn btn-light" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="{{ route('public.search') }}" class="btn btn-light">
                                    <i class="fas fa-sliders-h"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 d-none d-lg-block">
                        <i class="fas fa-book-reader fa-6x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-3 p-3 bg-primary bg-opacity-10">
                                    <i class="fas fa-folder fa-2x text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-0">Classifications</h6>
                                <h3 class="fw-bold mb-0">{{ number_format($activities) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-3 p-3 bg-success bg-opacity-10">
                                    <i class="fas fa-book fa-2x text-success"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-0">Références</h6>
                                <h3 class="fw-bold mb-0">{{ number_format($references) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-3 p-3 bg-warning bg-opacity-10">
                                    <i class="fas fa-gavel fa-2x text-warning"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-0">Règles</h6>
                                <h3 class="fw-bold mb-0">{{ number_format($rules) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-3 p-3 bg-info bg-opacity-10">
                                    <i class="fas fa-th-large fa-2x text-info"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-0">Typologies</h6>
                                <h3 class="fw-bold mb-0">{{ number_format($typologies) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Sections -->
        <div class="row g-4">
            <!-- Classifications Section -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-folder text-primary me-2"></i>Classifications
                            </h3>
                            <a href="" class="btn btn-outline-primary">
                                Voir tout
                                <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($latestActivities as $activity)
                                <a href="{{ route('activity.show', $activity) }}"
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $activity->name }}</h6>
                                        <small class="text-muted">{{ $activity->code }}</small>
                                    </div>
                                    <p class="mb-1 text-muted small">{{ Str::limit($activity->description, 100) }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Références Section -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-book text-success me-2"></i>Références
                            </h3>
                            <a href="{{ route('public.references') }}" class="btn btn-outline-success">
                                Voir tout
                                <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($latestReferences as $reference)
                                <a href="{{ route('reference.show', $reference) }}"
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $reference->name }}</h6>
                                        <small class="text-muted">{{ optional($reference->category)->name }}</small>
                                    </div>
                                    <p class="mb-1 text-muted small">{{ Str::limit($reference->description, 100) }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Règles Section -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-gavel text-warning me-2"></i>Règles
                            </h3>
                            <a href="{{ route('public.rules') }}" class="btn btn-outline-warning">
                                Voir tout
                                <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($latestRules as $rule)
                                <a href="{{ route('rule.show', $rule) }}"
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $rule->name }}</h6>
                                        <small class="text-muted">{{ $rule->code }}</small>
                                    </div>
                                    <p class="mb-1 text-muted small">{{ Str::limit($rule->description, 100) }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Typologies Section -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-th-large text-info me-2"></i>Typologies
                            </h3>
                            <a href="{{ route('public.typologies') }}" class="btn btn-outline-info">
                                Voir tout
                                <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($latestTypologies as $typology)
                                <a href="{{ route('typology.show', $typology) }}"
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $typology->name }}</h6>
                                        <small class="text-muted">{{ optional($typology->category)->name }}</small>
                                    </div>
                                    <p class="mb-1 text-muted small">{{ Str::limit($typology->description, 100) }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            transition: transform 0.2s ease-in-out;
            border: none;
            border-radius: 10px;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .list-group-item-action:hover {
            background-color: #f8f9fa;
        }

        .bg-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        }

        .input-group-lg .form-control {
            border: none;
        }

        .input-group-lg .btn {
            border: none;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .rounded-3 {
            border-radius: 0.5rem !important;
        }
    </style>
@endpush
