@extends('index')

@section('content')
<h1>Edit Typology for {{ $activity->name }}</h1>

<form action="{{ route('activity.typology.update', [$activity, $typology]) }}" method="PUT">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $typology->name }}" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control">{{ $typology->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" class="form-control">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $typology->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
