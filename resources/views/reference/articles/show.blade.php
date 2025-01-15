@extends('index')

@section('content')
    <h1>Article: {{ $article->code }} - {{ $article->name }} </h1>

    <p><strong>code:</strong> {{ $article->code }}</p>
    <p><strong>Description:</strong> {{ $article->description }}</p>
    <a href="{{ route('reference.article.edit', [$reference, $article]) }}" class="btn btn-secondary">Edit</a>
    <form action="{{ route('reference.article.destroy', [$reference->id, $article->id]) }}" method="POST" class="d-inline">
        @csrf
        @method('PUT')
        <button type="submit" class="btn  btn-danger">Delete</button>
    </form>
    <a name="" id=""  class="btn btn-primary" href="{{ route('reference.show', $reference->id)}}" role="button" >Retour</a>
@endsection
