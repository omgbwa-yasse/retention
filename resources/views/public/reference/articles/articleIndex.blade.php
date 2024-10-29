@extends('index')

@section('content')
    <div class="container">
        <h1>Articles for Reference: {{ $reference->name }}</h1>
        <a name="" id=""  class="btn btn-primary" href="{{ route('reference.show', $reference->id)}}" role="button" >Retour</a>

        @if ($articles->isEmpty())
            <p>No articles associated with this reference.</p>
        @else


                @foreach ($articles as $article)
<div class="list-group">
    <label class="list-group-item">
        <input class="form-check-input me-1" type="checkbox" value="" />
        <h2>{{ $article->reference }} : {{ $article->name }}</h2>
        {{ $article->description }}
        <br>
        <strong>Reference:</strong> {{ $reference->name }}
        <form action="{{ route('reference.article.destroy', [$reference->id, $article->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <a href="{{ route('reference.article.edit', [$reference->id, $article->id]) }}" class="btn btn-primary">Edit</a>
    </label>
</div>


    @endforeach



        @endif
    </div>
@endsection
