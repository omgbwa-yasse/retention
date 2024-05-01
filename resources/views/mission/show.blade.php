<!-- show_item.blade.php -->

@extends('index')

@section('content')
    <h1><p><strong> Mission :</strong> {{ $item->name }}</p></h1>
    <p><strong>ID:</strong> {{ $item->id }}</p>
    <p><strong>Cote:</strong> {{ $item->code }}</p>
    <p><strong>Description :</strong> {{ $item->description }}</p>
    <p><strong>Pays:</strong> {{ $item->countries->name }}</p>
    <a href="{{ route('mission.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('mission.edit', $item->id) }}" class="btn btn-primary">Edit</a>

    <form action="{{ route('mission.destroy', $item->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
