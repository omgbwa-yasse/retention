@extends('index')

@section('content')
<h1>Modifier la référence</h1>
<form action="{{ route('reference.update', $reference->id) }}" method="PUT">
    @csrf
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" class="form-control" required maxlength="50" value="{{ $reference->title }}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" maxlength="500">{{ $reference->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $reference->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="ressources">Ressources</label>
        <select name="ressources[]" id="ressources" class="form-control" multiple>
            @foreach ($ressources as $ressource)
                <option value="{{ $ressource->id }}" {{ in_array($ressource->id, $referenceRessources) ? 'selected' : '' }}>{{ $ressource->title }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>
@endsection
