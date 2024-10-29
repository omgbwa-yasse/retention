@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">Détails de l'activité</h2>
                        <div>
                            <a href="{{ route('activity.edit', $activity->id) }}" class="btn btn-light btn-sm mr-2">Modifier</a>
                            <form action="{{ route('activity.destroy', $activity->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette activité ?')">Supprimer</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>ID :</strong> {{ $activity->id }}</p>
                                <p><strong>Code :</strong> {{ $activity->code }}</p>
                                <p><strong>Titre :</strong> {{ $activity->name }}</p>
                                <p><strong>Description :</strong> {{ $activity->description }}</p>
                                <p><strong>Dans :</strong> {{ $activity->parent ? $activity->parent->name : 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h4>Actions</h4>
                                <a href="{{ route('activity.typology.index', $activity ) }}" class="btn btn-outline-primary btn-sm mb-2 d-block">Gérer les typologies</a>
                                <a href="{{ route('activity.rule.index', $activity ) }}" class="btn btn-outline-primary btn-sm mb-2 d-block">Gérer les règles de conservation</a>
                            </div>
                        </div>

                        @if($activity->rules->isNotEmpty())
                            <div class="mt-4">
                                <h4>Règles associées</h4>
                                <div class="list-group">
                                    @foreach($activity->rules as $rule)
                                        <a href="{{ route('rule.show', $rule->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            {{ $rule->code }} - {{ $rule->name }}
                                            <span class="badge badge-primary badge-pill">{{ $rule->typologies_count ?? 0 }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($activity->typologies->isNotEmpty())
                            <div class="mt-4">
                                <h4>Typologies associées</h4>
                                <ul class="list-group">
                                    @foreach($activity->typologies as $typology)
                                        <a href="{{ route('typology.show', $typology->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

                                            <li class="">{{ $typology->name }}</li>
                                        </a>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <a href="{{ route('activity.index') }}" class="btn btn-secondary mt-3">Retour à la liste des activités</a>
            </div>
        </div>
    </div>
@endsection
