@extends('index')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Recherche Avancée</h1>
        <form action="{{ route('search.advanced') }}" method="GET" id="advancedSearchForm">
            <div class="mb-3">
                <label for="type" class="form-label">Type de recherche</label>
                <select class="form-select" id="type" name="type">
                    <option value="">Sélectionnez un type</option>
                    <option value="classification">Classification</option>
                    <option value="reference">Référence</option>
                    <option value="rule">Règle</option>
                    <option value="typology">Typologie</option>
                    <option value="basket">Panier</option>
                </select>
            </div>

            <div class="collapse" id="commonFields">
                <div class="card card-body mb-3">
                    <h3>Champs communs</h3>
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name">

                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
            </div>

            <div class="collapse" id="classificationFields">
                <div class="card card-body mb-3">
                    <h3>Champs de Classification</h3>
                    <label for="code" class="form-label">Code</label>
                    <input type="text" class="form-control" id="code" name="code">

                    <label for="parent_id" class="form-label">Parent ID (pour les missions)</label>
                    <input type="number" class="form-control" id="parent_id" name="parent_id">

                    <label for="country_id" class="form-label">Pays</label>
                    <select class="form-select" id="country_id" name="country_id">
                        <!-- Populate with countries -->
                    </select>
                </div>
            </div>

            <div class="collapse" id="referenceFields">
                <div class="card card-body mb-3">
                    <h3>Champs de Référence</h3>
                    <label for="category_id" class="form-label">Catégorie</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <!-- Populate with reference categories -->
                    </select>
                </div>
            </div>

            <div class="collapse" id="ruleFields">
                <div class="card card-body mb-3">
                    <h3>Champs de Règle</h3>
                    <label for="rule_code" class="form-label">Code</label>
                    <input type="text" class="form-control" id="rule_code" name="rule_code">

                    <label for="status_id" class="form-label">Statut</label>
                    <select class="form-select" id="status_id" name="status_id">
                        <!-- Populate with statuses -->
                    </select>
                </div>
            </div>

            <div class="collapse" id="typologyFields">
                <div class="card card-body mb-3">
                    <h3>Champs de Typologie</h3>
                    <label for="typology_category_id" class="form-label">Catégorie</label>
                    <select class="form-select" id="typology_category_id" name="typology_category_id">
                        <!-- Populate with typology categories -->
                    </select>
                </div>
            </div>

            <div class="collapse" id="basketFields">
                <div class="card card-body mb-3">
                    <h3>Champs de Panier</h3>
                    <label for="basket_type_id" class="form-label">Type de panier</label>
                    <select class="form-select" id="basket_type_id" name="basket_type_id">
                        <!-- Populate with basket types -->
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        @if(isset($results))
            <div class="mt-5">
                <h2>Résultats de recherche pour : {{ ucfirst($type) }}</h2>
                @if(count($results) == 0)
                    <p>Aucun résultat trouvé.</p>
                @else
                    <ul class="list-group">
                        @foreach($results as $result)
                            <li class="list-group-item">
                                <h5>{{ $result->name }}</h5>
                                <p>{{ $result->description }}</p>
                                <!-- Add more fields as needed -->
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var typeSelect = document.getElementById('type');
            var allFields = document.querySelectorAll('.collapse');
            var commonFields = document.getElementById('commonFields');

            typeSelect.addEventListener('change', function() {
                // Hide all fields
                allFields.forEach(function(field) {
                    bootstrap.Collapse.getOrCreateInstance(field).hide();
                });

                // Show common fields and specific fields based on selection
                if (this.value) {
                    bootstrap.Collapse.getOrCreateInstance(commonFields).show();
                    var specificFields = document.getElementById(this.value + 'Fields');
                    if (specificFields) {
                        bootstrap.Collapse.getOrCreateInstance(specificFields).show();
                    }
                }
            });
        });
    </script>
@endpush
