@extends('index')

@section('content')
    <h1>Create Article for Reference: {{ $reference->title }}</h1>

    <form action="{{ route('reference.articles.store', $reference->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
