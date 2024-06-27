@extends('index')

@section('content')
    <h1>Typologie: {{ $typology->name }}</h1>
    <p><strong>Description:</strong> {{ $typology->description }}</p>
    <p><strong>Categorie :</strong> {{ $typology->category->name }}</p>
    <p><strong>Creer a :</strong> {{ $typology->created_at->format('Y-m-d H:i:s') }}</p>
    <p><strong>Mis a jour a:</strong> {{ $typology->updated_at->format('Y-m-d H:i:s') }}</p>
    <a href="{{ route('typology.edit', $typology->id) }}" class="btn btn-primary">Modifier</a>
    <form action="{{ route('typology.destroy', $typology->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
@endsection
