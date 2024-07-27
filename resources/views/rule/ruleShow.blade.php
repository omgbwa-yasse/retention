@extends('index')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">{{ $rule->name }}</h1>
                <h6 class="mb-0">{{ $rule->code }} - Pays non vide</h6>
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
                                <p class="mb-1"><strong>Statut :</strong>
                                    <a href="{{ route('rule.show', $rule->id) }}" class="badge bg-danger text-decoration-none">
                                        {{ $rule->status->name }}
                                    </a>
                                </p>
                                <p class="mb-0"><strong>Articles :</strong>
                                    <a href="{{ route('rule.show', $rule->id) }}">10 articles</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="mt-4">Cycle de vie</h3>
                @foreach(['Active', 'Semi-active', 'Définitive'] as $phase)
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">{{ $phase }}</h5>
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
                                @php
                                    $items = $phase === 'Active' ? $rule->actives : ($phase === 'Semi-active' ? $rule->duas : $rule->duls);
                                @endphp
                                @forelse($items as $item)
                                    <tr>
                                        <td>{{ $item->duration }} ans</td>
                                        <td>{{ $item->trigger->code }} - {{ $item->trigger->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->sort->code }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">N/A</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach

                <h3 class="mt-4">Activités</h3>
                <ul class="list-group mb-4">
                    @forelse($rule->classifications as $classification)
                        <li class="list-group-item">{{ $classification->code }} - {{ $classification->name }}</li>
                    @empty
                        <li class="list-group-item">Aucune règle</li>
                    @endforelse
                </ul>

                <div class="d-flex flex-wrap gap-2 mb-4">
                    <a href="{{ route('active.create', $rule->id) }}" class="btn btn-outline-primary btn-sm">Durée active</a>
                    <a href="{{ route('rule.dua.create', $rule->id) }}" class="btn btn-outline-primary btn-sm">Durée semi-active</a>
                    <a href="{{ route('rule.dul.create', $rule->id) }}" class="btn btn-outline-primary btn-sm">Durée passive</a>
                    <a href="{{ route('rule.classification.create', $rule->id) }}" class="btn btn-outline-primary btn-sm">Aux activités</a>
                </div>

                <hr>

                <div class="d-flex gap-2">
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
