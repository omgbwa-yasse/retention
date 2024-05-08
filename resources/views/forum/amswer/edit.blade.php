@extends('index')

@section('content')
<div class="container">
    <h1>Edit Answer</h1>
    <form action="{{ route('answers.update', $answer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $answer->name }}" required>
        </div>
        <div class="form-group">
            <label for="parent_id">Parent Answer</label>
            <select class="form-control" name="parent_id">
                <option value="0">None</option>
                @foreach ($subject->answers as $answer)
                    <option value="{{ $answer->id }}" @if($answer->id == $answer->parent_id) selected @endif>{{ $answer->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
