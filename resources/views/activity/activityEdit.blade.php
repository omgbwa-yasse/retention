@extends('index')

@section('content')
<h1>Edit Classification</h1>

<form action="{{ route('activity.update', $activity->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="cote">Cote</label>
        <input type="text" class="form-control" id="cote" name="cote" value="{{ $activity->cote }}" required>
    </div>

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $activity->name }}" required>
    </div>

    <div class="form-group">
        <label for="parent_id">Parent Category</label>
        <select class="form-control" id="parent_id" name="parent_id">
            <option value="">Creer un nouveau domaine</option>
            @foreach ($activities as $parent)
                <option value="{{ $parent->id }}" @selected($activity->parent_id == $parent->id)>{{$parent->cote }} - {{$parent->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('activity.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
