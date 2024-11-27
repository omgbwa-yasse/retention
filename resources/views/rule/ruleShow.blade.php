@extends('index')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">{{ $rule->name }}</h1>
                <h6 class="mb-0">{{ $rule->code }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="card-title">Description</h5>
                        <p class="card-text">{{ $rule->description }}</p>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Informations</h5>
                                <p class="mb-1">
                                    <strong>Statut :</strong>
                                    <span class="badge bg-{{ $rule->status->color ?? 'secondary' }}">
                                        {{ $rule->status->name }}
                                    </span>
                                </p>
                                <p class="mb-1">
                                    <strong>Pays concernés :</strong>
                                    @forelse($rule->countries as $country)
                                        <span class="badge bg-info">{{ $country }}</span>
                                    @empty
                                        <span class="text-muted">Aucun pays spécifié</span>
                                    @endforelse
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="mt-4">Durée légale</h3>
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Définitive</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0">
                            <thead>
                            <tr>
                                <th>Durée</th>
                                <th>Déclencheur</th>
                                <th>Description</th>
                                <th>Sort</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($rule->duls ?? collect() as $item)
                                <tr>
                                    <td>{{ $item->duration }} ans</td>
                                    <td>
                                        @if($item->trigger)
                                            {{ $item->trigger->code }} - {{ $item->trigger->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        @if($item->sort)
                                            {{ $item->sort->code }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Aucune donnée disponible</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <h3 class="mt-4">Classifications</h3>
                <div class="table-responsive mb-4">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($rule->classifications as $classification)
                            <tr>
                                <td>{{ $classification->code }}</td>
                                <td>{{ $classification->name }}</td>
                                <td>{{ $classification->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Aucune classification</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex flex-wrap gap-2 mb-4">
                    <a href="{{ route('rule.dul.create', $rule->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus"></i> Durée définitive
                    </a>
                    <a href="{{ route('rule.classification.create', $rule->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus"></i> Ajouter une classification
                    </a>
                </div>

                <hr>

                <div class="d-flex gap-2">
                    <a href="{{ route('rule.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                    <a href="{{ route('rule.edit', $rule->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette règle ?')">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
