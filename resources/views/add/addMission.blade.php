@extends('index')

@section('content')

<form action="#" method="POST">
    @csrf

    <div class="form-group">
        <label for="cote">Cote</label>
        <input type="text" class="form-control" id="cote" name="cote" required>
    </div>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <div class="form-group">
        <label for="level">Level</label>
        <input type="text" class="form-control" id="level" name="level" required>
    </div>

    <div class="form-group">
        <label for="parent_id">Parent ID</label>
        <input type="number" class="form-control" id="parent_id" name="parent_id">
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection
