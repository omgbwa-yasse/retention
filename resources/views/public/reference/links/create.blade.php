@extends('index')

@section('content')
    <div class="container">
        <h1>Create Link</h1>

        <form action="{{ route('reference.link.store', $reference->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" name="link" id="link" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Create Link</button>
        </form>
    </div>
@endsection
