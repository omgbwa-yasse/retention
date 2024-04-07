<!-- show_item.blade.php -->

@extends('index')

@section('content')
    <h1>Show Activity</h1>
    <p><strong>ID:</strong> {{ $item->id }}</p>
    <p><strong>Cote:</strong> {{ $item->cote }}</p>
    <p><strong>Title:</strong> {{ $item->title }}</p>
    <p><strong>Parent ID:</strong> {{ $item->parent_id }}</p>
    <a href="{{ route('activity.index') }}" class="btn btn-secondary">Back</a>
@endsection
