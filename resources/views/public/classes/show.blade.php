@extends('index')

@section('content')
    <div class="container py-4">
        <!-- En-tête du document -->
        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="display-6 mb-2">{{ $class->name }}</h1>
                        <p class="text-muted mb-0">Code de référence: {{ $class->code }}</p>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small">
                            Créé par: {{ $class->user->name }}
                            <br>
                            Pays: {{ $class->country->name }}
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">Description</h6>
                    <p class="mb-0">{{ $class->description }}</p>
                </div>

                <!-- Classification -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">Classification</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <th class="bg-light w-25">Parent</th>
                                    <td>{{ $class->parent ? $class->parent->name : 'Non défini' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Sous-classes -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">Sous-classes</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($class->childrenRecursive as $child)
                                <tr>
                                    <td>{{ $child->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted">Aucune sous-classe enregistrée</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Règles -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">Règles applicables</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>Règle</th>
                                <th>Duls</th>
                                <th>Trigger</th>
                                <th>Articles</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($class->rules as $rule)
                                <tr>
                                    <td class="fw-medium">{{ $rule->name }}</td>
                                    <td>{{ $rule->duls->name }}</td>
                                    <td>{{ $rule->duls->trigger->name }}</td>
                                    <td>
                                        @foreach($rule->articles as $article)
                                            <span class="badge bg-light text-dark me-1">{{ $article->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted">Aucune règle définie</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Typologies -->
                <div>
                    <h6 class="text-uppercase text-muted small mb-2">Typologies</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>Nom de la typologie</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($class->typologies as $typology)
                                <tr>
                                    <td>{{ $typology->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted">Aucune typologie associée</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pied de page du document -->
            <div class="card-footer bg-light text-muted small p-3">
                <div class="d-flex justify-content-between">
                    <span>Document généré le {{ date('d/m/Y') }}</span>
                    <span>Référence: {{ $class->code }}</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table {
            margin-bottom: 0;
        }
        .table > :not(caption) > * > * {
            padding: 0.5rem;
        }
        .badge {
            font-weight: normal;
        }
    </style>
@endsection@extends('index')

@section('content')
    <div class="container py-4">
        <!-- En-tête du document -->
        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                       <h1 class="display-6 mb-2"><b>{{ $class->name }}</b></h1>
                        <p class="text-muted mb-0">Code de référence: {{ $class->code }}</p>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small">
                            Créé par: {{ $class->user->name }}
                            <br>
                            Pays: {{ $class->country->name }}
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">Description</h6>
                    <p class="mb-0">{{ $class->description }}</p>
                </div>

                <!-- Classification -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">Classification</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <th class="bg-light w-25">Parent</th>
                                    <td>{{ $class->parent ? $class->parent->name : 'Non défini' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Sous-classes -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">Sous-classes</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($class->childrenRecursive as $child)
                                <tr>
                                    <td>{{ $child->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted">Aucune sous-classe enregistrée</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Règles -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">Règles applicables</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>Règle</th>
                                <th>Duls</th>
                                <th>Trigger</th>
                                <th>Articles</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($class->rules as $rule)
                                <tr>
                                    <td class="fw-medium">{{ $rule->name }}</td>
                                    <td>{{ $rule->duls->name }}</td>
                                    <td>{{ $rule->duls->trigger->name }}</td>
                                    <td>
                                        @foreach($rule->articles as $article)
                                            <span class="badge bg-light text-dark me-1">{{ $article->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted">Aucune règle définie</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Typologies -->
                <div>
                    <h6 class="text-uppercase text-muted small mb-2">Typologies</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>Nom de la typologie</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($class->typologies as $typology)
                                <tr>
                                    <td>{{ $typology->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted">Aucune typologie associée</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pied de page du document -->
            <div class="card-footer bg-light text-muted small p-3">
                <div class="d-flex justify-content-between">
{{--                    <span>Document généré le {{ date('d/m/Y') }}</span>--}}
                    <span>Référence: {{ $class->code }}</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table {
            margin-bottom: 0;
        }
        .table > :not(caption) > * > * {
            padding: 0.5rem;
        }
        .badge {
            font-weight: normal;
        }
    </style>
@endsection
