@extends('index')

@section('content')
    <div class="container">
        <h1>Update Item</h1>

        <form action="{{ route('mission.update', $mission->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="cote">Cote</label>
                <input type="text" class="form-control" id="cote" name="cote" value="{{ $mission->cote }}" required>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $mission->title }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
