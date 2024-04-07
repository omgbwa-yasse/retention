@extends('index')

@section('content')
    <h1>Create Typology</h1>
    <form action="{{ route('typology.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="typology_category_id">Category</label>
            <select name="typology_category_id" class="form-control" required>
                @foreach ($category as $items)
                    <option value="{{ $items->id }}">{{ $items->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
