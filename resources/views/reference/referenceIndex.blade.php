@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4 text-primary fw-bold">Référentiels juridiques</h1>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <a href="{{ route('reference.create') }}" class="btn btn-primary me-2">
                            <i class="fas fa-plus"></i> Ajouter une référence
                        </a>
                        <a href="#" class="btn btn-danger me-2">
                            <i class="fas fa-shopping-cart"></i> Panier
                        </a>
                        <a href="#" class="btn btn-secondary">
                            <i class="fas fa-print"></i> Imprimer
                        </a>
                    </div>

                    <form action="{{ route('reference.index') }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher une référence...">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="list-group shadow-sm">
                    @foreach ($references as $reference)
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="reference-{{ $reference->id }}">
                                    <label class="form-check-label" for="reference-{{ $reference->id }}">
                                        <h5 class="mb-1 fw-bold">{{ $reference->name }}</h5>
                                    </label>
                                </div>
                                <a href="{{ route('reference.show', $reference->id) }}" class="btn btn-sm btn-outline-primary">Voir plus</a>
                            </div>
                            <p class="mb-1">{{ $reference->description }}</p>
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
                </div>

                <div class="mt-4">
                    {{-- {{ $references->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .list-group-item:hover {
            background-color: #f8f9fa;
        }
        .form-check-input:checked + .form-check-label h5 {
            text-decoration: line-through;
            color: #6c757d;
        }
    </style>
@endpush
