@extends('index')

@section('content')
    <div class="container">
        <h1>Modifier la mission | {{ $mission->name }} </h1>

        <form action="{{ route('mission.update', $mission->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="code">Cote</label>
                <input type="text" class="form-control" id="code" name="code" value="{{ $mission->code }}" required>
            </div>
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $mission->name }}" required>
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $mission->description }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
