@extends('index')

@section('content')
    <div class="container my-2">
        <h1 class="mb-4 text-primary fw-bold">Recherche Avancée</h1>
        <form action="{{ route('search.advanced') }}" method="GET" id="advancedSearchForm">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title text-secondary mb-3">Type de recherche</h3>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <select class="form-select form-select-lg shadow-sm" id="type" name="type">
                                <option value="">Rechercher Partout</option>
                                <option value="activity">Classification</option>
                                <option value="reference">Référence</option>
                                <option value="rule">Règle</option>
                                <option value="typology">Typologie</option>
                                <option value="basket">Panier</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div id="commonFields" class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title text-secondary mb-3">Champs communs</h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control form-control-lg" id="description" name="description">
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion mb-4" id="searchAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#classificationFields">
                            Classification
                        </button>
                    </h2>
                    <div id="classificationFields" class="accordion-collapse collapse" data-bs-parent="#searchAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="code" class="form-label">Code</label>
                                    <input type="text" class="form-control form-control-lg" id="code" name="code">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="parent_id" class="form-label">Parent</label>
                                    <select class="form-select form-select-lg" name="parent_id">
                                        <option value="">N/A</option>
                                        @foreach ($activities->groupBy('parent_id') as $parentId => $groupedActivities)
                                            <optgroup label="Parent ID: {{ $parentId }}">
                                                @foreach ($groupedActivities as $activity)
                                                    <option value="{{ $activity->id }}">{{ $activity->code }} - {{ $activity->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="country_id" class="form-label">Pays</label>
                                    <select class="form-select form-select-lg" id="country_id" name="country_id">
                                        <option value="">Sélectionnez un pays</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reference section -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#referenceFields">
                            Référence
                        </button>
                    </h2>
                    <div id="referenceFields" class="accordion-collapse collapse" data-bs-parent="#searchAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="ref_code" class="form-label">Code de référence</label>
                                    <input type="text" class="form-control form-control-lg" id="ref_code" name="ref_code">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ref_type" class="form-label">Type de référence</label>
                                    <select class="form-select form-select-lg" id="ref_type" name="ref_type">
                                        <option value="">Sélectionnez un type</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rule section -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ruleFields">
                            Règle
                        </button>
                    </h2>
                    <div id="ruleFields" class="accordion-collapse collapse" data-bs-parent="#searchAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="rule_code" class="form-label">Code de règle</label>
                                    <input type="text" class="form-control form-control-lg" id="rule_code" name="rule_code">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="rule_category" class="form-label">Catégorie de règle</label>
                                    <select class="form-select form-select-lg" id="rule_category" name="rule_category">
                                        <option value="">Sélectionnez une catégorie</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Typology section -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#typologyFields">
                            Typologie
                        </button>
                    </h2>
                    <div id="typologyFields" class="accordion-collapse collapse" data-bs-parent="#searchAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="typology_code" class="form-label">Code de typologie</label>
                                    <input type="text" class="form-control form-control-lg" id="typology_code" name="typology_code">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="typology_category" class="form-label">Catégorie de typologie</label>
                                    <select class="form-select form-select-lg" id="typology_category" name="typology_category">
                                        <option value="">Sélectionnez une catégorie</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Basket section -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#basketFields">
                            Panier
                        </button>
                    </h2>
                    <div id="basketFields" class="accordion-collapse collapse" data-bs-parent="#searchAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="basket_code" class="form-label">Code de panier</label>
                                    <input type="text" class="form-control form-control-lg" id="basket_code" name="basket_code">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="basket_type" class="form-label">Type de panier</label>
                                    <select class="form-select form-select-lg" id="basket_type" name="basket_type">
                                        <option value="">Sélectionnez un type</option>
                                        {{--                                        @foreach ($basketTypes as $type)--}}
                                        {{--                                            <option value="{{ $type->id }}">{{ $type->name }}</option>--}}
                                        {{--                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5 shadow">Rechercher</button>
            </div>
        </form>

        @if(isset($results))
            <div class="mt-5">
                <h2 class="mb-4 text-primary fw-bold">Résultats de recherche</h2>
                @if(empty($results))
                    <div class="alert alert-info shadow-sm">Aucun résultat trouvé.</div>
                @else
                    @foreach($results as $table => $items)
                        <h3 class="mb-3 text-secondary fw-bold">{{ ucfirst($table) }}</h3>
                        <div class="list-group shadow-sm">
                            @foreach($items as $item)
                                <div class="list-group-item list-group-item-action">
                                    <h5 class="mb-1 fw-bold">{{ $item->name }}</h5>
                                    <p class="mb-1 text-muted">{{ $item->description }}</p>
                                    <!-- Add more fields as needed -->
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .form-label {
            font-weight: 600;
        }
        .accordion-button:not(.collapsed) {
            background-color: #f8f9fa;
            color: #0d6efd;
        }
        .list-group-item:hover {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .card-body {
            padding: 2rem;
        }
        .form-select, .form-control {
            border-radius: 8px;
        }
        .btn-primary {
            border-radius: 8px;
        }
    </style>
@endpush
