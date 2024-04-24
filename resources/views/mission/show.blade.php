<!-- show_item.blade.php -->

@extends('index')

@section('content')
    <h1>Item Details</h1>
    <p><strong>ID:</strong> {{ $item->id }}</p>
    <p><strong>Cote:</strong> {{ $item->code }}</p>
    <p><strong>Title:</strong> {{ $item->name }}</p>
    <p><strong>Description :</strong> {{ $item->description }}</p>
    <p><strong>Level:</strong> {{ $item->level }}</p>
    <p><strong>Parent ID:</strong> {{ $item->parent_id }}</p>
    <a href="{{ route('mission.index') }}" class="btn btn-secondary">Back</a>
@endsection
