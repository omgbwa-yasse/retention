@extends('index')

@section('content')
    <h1>Article: {{ $article->title }}</h1>

    <p><strong>Description:</strong> {{ $article->description }}</p>

    <a href="{{ route('reference.articles.edit', [$reference->id, $article->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
    <form action="{{ route('reference.articles.destroy', [$reference->id, $article->id]) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>
@endsection
