@extends('index')

@section('content')
    <h1>Modifier une Typologie</h1>
    <form action="{{ route('typology.update', $typology->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="name" class="form-control" value="{{ $typology->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $typology->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="category_id">categorie</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $typology->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection
