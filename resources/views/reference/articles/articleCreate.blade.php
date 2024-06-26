@extends('index')

@section('content')
    <h1>Create Article for Reference: {{ $reference->name }}</h1>

    <form action="{{ route('reference.article.store', $reference->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="reference">Reference</label>
            <input type="text" class="form-control" id="reference" name="reference" required>
        </div>

        <div class="form-group">
            <label for="name">Title</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
