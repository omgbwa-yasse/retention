@extends('index')

@section('content')
    <div class="container">
        <h1>Edit Link</h1>

        <form action="{{ route('reference.link.update', [$reference->id, $link->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $link->name }}" required>
            </div>

            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" name="link" id="link" class="form-control" value="{{ $link->link }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Link</button>
        </form>
    </div>
@endsection
