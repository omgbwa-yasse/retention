@extends('index')

@section('content')
    <h1>Article: {{ $article->code }} - {{ $article->name }} </h1>

    <p><strong>Code:</strong> {{ $article->code }}</p>
    <p><strong>Description:</strong> {{ $article->description }}</p>

    <a href="{{ route('reference.article.edit', [$reference->id, $article->id]) }}" class="btn btn-secondary">Edit</a>

    <form action="{{ route('reference.article.destroy', [$reference->id, $article->id]) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette association ?')">Delete</button>
    </form>

    <a href="{{ route('reference.show', $reference->id) }}" class="btn btn-primary" role="button">Retour</a>
@endsection
