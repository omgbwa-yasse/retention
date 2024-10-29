@extends('index')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Règles de classification pour {{ $activity->name }}</h2>
                <a href="{{ route('activity.rule.create', $activity) }}" class="btn btn-light btn-sm">Ajouter une règle</a>
            </div>
            <div class="card-body">
                @if($activity->rules->isEmpty())
                    <p class="text-muted">Aucune règle n'a été ajoutée pour cette activité.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($activity->rules as $rule)
                                <tr>
                                    <td>{{ $rule->name }}</td>
                                    <td>{{ Str::limit($rule->description, 100) }}</td>
                                    <td>
                                        <form action="{{ route('activity.rule.destroy', [$activity, $rule]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette règle ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <a href="{{ route('activity.show', $activity) }}" class="btn btn-secondary mt-3">Retour à l'activité</a>
    </div>
@endsection
