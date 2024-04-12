@extends('index')

@section('content')
    <h1>Edit Article for categorie: {{ $category->name }}</h1>

    <form action="{{ route('reference-category.update',$category) }}" method="PUT">
        @csrf

        <div class="form-group">
            <label for="name">Title</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $category->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
