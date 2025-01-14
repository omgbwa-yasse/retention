@extends('index') <!-- Assurez-vous que le layout principal est correctement référencé -->

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Liste des paniers</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Paniers Disponibles</h2>
                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#basketList">
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </div>
                    <div class="collapse show" id="basketList">
                        <div class="card-body">
{{--                            <input type="text" class="form-control mb-3" id="basketSearch" placeholder="Rechercher un panier...">--}}
                            <ul class="list-group list-group-flush" id="basketItems">
                                @foreach($baskets as $basket)
                                    <li class="list-group-item">
                                        <a href="#basket-{{ $basket->id }}" class="text-decoration-none text-dark">
                                            {{ $basket->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                @foreach($baskets as $basket)
                    <div class="card mb-4" id="basket-{{ $basket->id }}">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="h4 mb-0">{{ $basket->name }}</h2>
                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#basketDetails-{{ $basket->id }}">
                                <i class="bi bi-chevron-down"></i>
                            </button>
                        </div>
                        <div class="collapse show" id="basketDetails-{{ $basket->id }}">
                            <div class="card-body">
                                <p class="card-text">{{ $basket->description }}</p>

                                <h3 class="h5 mt-4">Références associées</h3>
                                <ul class="list-unstyled">
                                    @foreach($basket->references as $reference)
                                        <li><i class="bi bi-link me-2"></i>{{ $reference->name }}</li>
                                    @endforeach
                                </ul>

                                <h3 class="h5 mt-4">Règles associées</h3>
                                <ul class="list-unstyled">
                                    @foreach($basket->rules as $rule)
                                        <li><i class="bi bi-clipboard-check me-2"></i>{{ $rule->name }}</li>
                                    @endforeach
                                </ul>

                                <h3 class="h5 mt-4">Classifications associées</h3>
                                <ul class="list-unstyled">
                                    @foreach($basket->classes as $class)
                                        <li><i class="bi bi-tag me-2"></i>{{ $class->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('basketSearch');
            const basketItems = document.getElementById('basketItems').getElementsByTagName('li');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                Array.from(basketItems).forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        });
    </script>
@endpush
