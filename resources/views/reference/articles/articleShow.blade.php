@extends('index')

@section('content')


    <h1>Article: {{ $article->name }}</h1>
    <a name="" id=""  class="btn btn-primary" href="{{ route('reference.show', $reference->id)}}" role="button" >Retour</a>
    <p><strong>code:</strong> {{ $article->reference }}</p>
    <p><strong>Description:</strong> {{ $article->description }}</p>
    <a href="{{ route('reference.article.edit', [$reference, $article]) }}" class="btn btn-sm btn-secondary">Edit</a>
    <form action="{{ route('reference.article.destroy', [$reference, $article]) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" href="{{ route('reference.article.destroy', [$reference, $article]) }}">Delete</button>
    </form>
@endsection
