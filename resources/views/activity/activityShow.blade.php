<!-- show_item.blade.php -->

@extends('index')

@section('content')
    <h1>Show Activity</h1>
    <p><strong>ID :</strong> {{ $activity->id }}</p>
    <p><strong>Cote :</strong> {{ $activity->code }}</p>
    <p><strong>Title :</strong> {{ $activity->name }}</p>
    <p><strong>Description :</strong> {{ $activity->description }}</p>
    <p><strong>Dans :</strong> @if ($activity->parent) {{ $activity->parent->name }} @endif </p>
    <hr/>
    <a href="{{ route('activity.index') }}" class="btn btn-secondary btn-sm">Back</a>
    <a href="{{ route('activity.edit', $activity->id) }}" class="btn btn-primary btn-sm">Edit</a>
    <a href="{{ route('activity.destroy', $activity->id) }}" class="btn btn-primary btn-sm bg-danger border">supprimer</a>
    <hr/>
    <a href="{{ route('activity.typology.index', $activity ) }}" class="btn btn-light btn-sm">Ajouter une typologie</a>
    <ul>
        @foreach($activity->typologies as $typology)
            <li>{{ $typology->name }}</li>
        @endforeach
    </ul>

@endsection
