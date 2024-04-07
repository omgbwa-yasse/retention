@extends('index')

@section('content')
    <h1>Typology: {{ $typology->title }}</h1>
    <p><strong>Description:</strong> {{ $typology->description }}</p>
    <p><strong>Category:</strong> {{ $category->title }}</p>
    <p><strong>Created At:</strong> {{ $typology->created_at->format('Y-m-d H:i:s') }}</p>
    <p><strong>Updated At:</strong> {{ $typology->updated_at->format('Y-m-d H:i:s') }}</p>
    <a href="{{ route('typology.edit', $typology->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('typology.destroy', $typology->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
