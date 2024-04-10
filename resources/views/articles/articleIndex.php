@extends('index')

@section('content')
    <h1>Articles</h1>

    <a href="{{ route('reference.article.create', $reference->id) }}" class="btn btn-primary mb-3">Create Article</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->description }}</td>
                    <td>
                        <a href="{{ route('reference.article.edit', [$reference->id, $article->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('reference.article.destroy', [$reference->id, $article->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
