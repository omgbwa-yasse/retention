@extends('index')

@section('content')
<div class="container">
    <h1>Create Answer</h1>
    <form action="{{ route('forum.amswer.store', $subject) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
