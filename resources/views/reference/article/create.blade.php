@extends('index')

@section('content')
    <h1>Create Article for Reference: {{ $reference->name }}</h1>

    <form action="{{ route('reference.article.store', $reference->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" class="form-control w-50" id="code" name="code" required>
        </div>

        <div class="form-group">
            <label for="name">Title</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('reference.show', $reference->id) }}" class="btn btn-secondary">Retour</a>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
@endsection
