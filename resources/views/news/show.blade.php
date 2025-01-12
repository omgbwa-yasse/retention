<!-- resources/views/items/show.blade.php -->

@extends('index')

@section('content')
    <div class="container">
        <h1>Item Details</h1>
        <p><strong>Name:</strong> {{ $item->name }}</p>
        <p><strong>Description:</strong> {{ $item->description }}</p>
        <p><strong>User ID:</strong> {{ $item->user_id }}</p>
        <p><strong>Created At:</strong> {{ $item->created_at }}</p>
        <p><strong>Updated At:</strong> {{ $item->updated_at }}</p>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
