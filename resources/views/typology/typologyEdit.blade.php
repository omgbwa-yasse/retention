@extends('index')

@section('content')
    <h1>Edit Typology</h1>
    <form action="{{ route('typology.update', $typology->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $typology->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $typology->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="typology_category_id">Category</label>
            <select name="typology_category_id" class="form-control" required>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}" {{ $typology->category_id == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
