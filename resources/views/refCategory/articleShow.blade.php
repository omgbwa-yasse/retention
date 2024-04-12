@extends('index')

@section('content')
    <h1> Categorie : {{ $category->name }}</h1>

    <p><strong> Description : </strong> {{ $category->description }}</p>

    <a href="{{ route('reference-category.edit', $category->id) }}" class="btn btn-sm btn-secondary">Edit</a>
    <form action="{{ route('reference-category.destroy', $category->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" href="{{ route('reference-category.destroy', $category->id) }}">Delete</button>
    </form>
@endsection
