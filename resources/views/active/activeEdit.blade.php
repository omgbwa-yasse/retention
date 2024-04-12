@extends('index')

@section('content')
<h1>Edit Active</h1>

<form action="{{ route('active.update', $active->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="duration">Duration</label>
        <input type="text" class="form-control" id="duration" name="duration" required maxlength="50" value="{{ $active->duration }}">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description">{{ $active->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="rule_id">Rule</label>
        <select class="form-control" id="rule_id" name="rule_id" required>
            @foreach ($rules as $id => $name)
                <option value="{{ $id }}" {{ $active->rule_id == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="trigger_id">Trigger</label>
        <select class="form-control" id="trigger_id" name="trigger_id" required>
            @foreach ($triggers as $id => $name)
                <option value="{{ $id }}" {{ $active->trigger_id == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="sort_id">Sort</label>
        <select class="form-control" id="sort_id" name="sort_id" required>
            @foreach ($sorts as $id => $name)
                <option value="{{ $id }}" {{ $active->sort_id == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
