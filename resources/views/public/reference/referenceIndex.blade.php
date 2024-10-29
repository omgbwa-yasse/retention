@extends('index')
<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-radius: 0.5rem;
    }
    .list-group-item {
        transition: all 0.3s ease;
    }
    .list-group-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .form-check-input:checked + .form-check-label h5 {
        text-decoration: line-through;
        color: #6c757d;
    }
    .btn {
        border-radius: 0.25rem;
    }
    .modal-content {
        border: none;
        border-radius: 0.5rem;
    }
    .pagination {
        justify-content: center;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var addToBasketModal = document.getElementById('addToBasketModal');
        addToBasketModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var referenceId = button.getAttribute('data-reference-id');
            var modalBodyInput = addToBasketModal.querySelector('#reference_id');
            modalBodyInput.value = referenceId;
        });
    });
</script>
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
                                <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#viewBasketModal">
                                    <i class="fas fa-shopping-cart"></i> Panier
                                </button>
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
                                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addToBasketModal" data-reference-id="{{ $reference->id }}">
                                                    Ajouter au panier
                                                </button>
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

    <!-- Modal pour ajouter au panier -->
    <div class="modal fade" id="addToBasketModal" tabindex="-1" aria-labelledby="addToBasketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addToBasketModalLabel">Ajouter au panier</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('reference.addToBasket') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="reference_id" id="reference_id">
                        <div class="mb-3">
                            <label for="basket_id" class="form-label">Sélectionner un panier</label>
                            <select class="form-select" name="basket_id" id="basket_id" required>
                                @foreach ($baskets as $basket)
                                    <option value="{{ $basket->id }}">{{ $basket->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal pour consulter le panier -->
    <div class="modal fade" id="viewBasketModal" tabindex="-1" aria-labelledby="viewBasketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="viewBasketModalLabel">Consulter le panier</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach ($baskets as $basket)
                            <li class="list-group-item">
                                <h5 class="mb-2">{{ $basket->name }}</h5>
                                <ul class="list-unstyled">
{{--                                    @foreach ($basket->references as $reference)--}}
{{--                                        <li class="mb-1"><i class="fas fa-book me-2"></i>{{ $reference->name }}</li>--}}
{{--                                    @endforeach--}}
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush
