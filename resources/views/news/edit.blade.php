<!-- resources/views/items/edit.blade.php -->

@extends('index')

@section('content')
    <div class="container">
        <h1>Edit Item</h1>
        <form action="{{ route('items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ $item->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" name="user_id" class="form-control" value="{{ $item->user_id }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
