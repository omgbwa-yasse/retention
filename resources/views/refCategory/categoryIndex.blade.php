@extends('index')

@section('content')
    <div class="container">
        <h1>Articles for Reference: {{ $reference->name }}</h1>

        @if ($articles->isEmpty())
            <p>No articles associated with this reference.</p>
        @else
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach ($articles as $article)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $article->reference }} : {{ $article->name }}</h5>
                                <p class="card-text">{{ $article->description }}</p>
                                <p class="card-text"><strong>Reference:</strong> {{ $reference->name }}</p>
                                <div class="mt-3">
                                    <form action="{{ route('article.destroy', [$reference->id, $article->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <a href="{{ route('article.edit', [$reference->id, $article->id]) }}" class="btn btn-primary">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
