@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Activity Details Card -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Afficher l'activité</h2>
                    </div>
                    <div class="card-body">
                        <!-- Activity Information -->
                        <p><strong>ID :</strong> {{ $activity->id }}</p>
                        <p><strong>Cote :</strong> {{ $activity->code }}</p>
                        <p><strong>Titre :</strong> {{ $activity->name }}</p>
                        <p><strong>Description :</strong> {{ $activity->description }}</p>
                        <p><strong>Dans :</strong> {{ $activity->parent ? $activity->parent->name : 'N/A' }}</p>

                        <!-- Associated Rules -->
                        @if($activity->rules->isNotEmpty())
                            <div class="list-group mb-3">
                                @foreach($activity->rules as $rule => $value)
                                    <a href="{{ route('rule.show', $value['id']) }}" class="list-group-item list-group-item-action">
                                        {{ $value['code'] }} - {{ $value['name'] }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <a href="{{ route('activity.index') }}" class="btn btn-secondary btn-sm">Retour</a>
                                <a href="{{ route('activity.edit', $activity->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                <form action="{{ route('activity.destroy', $activity->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </div>
                            <div>
                                <a href="{{ route('activity.typology.index', $activity ) }}" class="btn btn-light btn-sm">Ajouter une typologie</a>
                                <a href="{{ route('activity.rule.create', $activity ) }}" class="btn btn-light btn-sm">Ajouter une règle de conservation</a>
                            </div>
                        </div>

                        <!-- Typologies List -->
                        @if($activity->typologies->isNotEmpty())
                            <div class="mt-4">
                                <h4>Typologies associées</h4>
                                <ul class="list-group">
                                    @foreach($activity->typologies as $typology)
                                        <li class="list-group-item">{{ $typology->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
