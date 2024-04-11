@extends('index')

@section('content')
    <h1>Article: {{ $article->name }}</h1>

    <p><strong>Description:</strong> {{ $article->description }}</p>

    <a href="{{ route('article.edit', [$reference, $article]) }}" class="btn btn-sm btn-secondary">Edit</a>
    <form action="{{ route('article.destroy', [$reference, $article]) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" href="{{ route('article.destroy', [$reference, $article]) }}">Delete</button>
    </form>
@endsection
