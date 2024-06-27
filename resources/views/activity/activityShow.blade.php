<!-- show_item.blade.php -->

@extends('index')

@section('content')
    <h1>Afficher l'activité</h1>
    <p><strong>ID :</strong> {{ $activity->id }}</p>
    <p><strong>Cote :</strong> {{ $activity->code }}</p>
    <p><strong>Titre :</strong> {{ $activity->name }}</p>
    <p><strong>Description :</strong> {{ $activity->description }}</p>
    <p><strong>Dans :</strong> @if ($activity->parent) {{ $activity->parent->name }} @endif </p>
    @foreach($activity->rules as $rule => $value)
        <div class="list-group">
            <a href="{{ route('rule.show', $value['id']) }}" class="list-group-item list-group-item-action" > {{ $value['code'] }} - {{ $value['name'] }} </a>
        </div>
    @endforeach
    <hr/>
    <a href="{{ route('activity.index') }}" class="btn btn-secondary btn-sm">Retour</a>
    <a href="{{ route('activity.edit', $activity->id) }}" class="btn btn-primary btn-sm">Modifier</a>
    <a href="{{ route('activity.destroy', $activity->id) }}" class="btn btn-primary btn-sm bg-danger border">Supprimer</a>
    <hr/>
    <a href="{{ route('activity.typology.index', $activity ) }}" class="btn btn-light btn-sm">Ajouter une typologie</a>
    <a href="{{ route('activity.rule.create', $activity ) }}" class="btn btn-light btn-sm">Ajouter une règle de conservation</a>
    <ul>
        @foreach($activity->typologies as $typology)
            <li>{{ $typology->name }}</li>
        @endforeach
    </ul>
@endsection
