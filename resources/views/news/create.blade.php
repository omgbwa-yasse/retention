<!-- resources/views/items/create.blade.php -->

@extends('index')

@section('content')
    <div class="container">
        <h1>Create New Item</h1>
        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" name="user_id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
