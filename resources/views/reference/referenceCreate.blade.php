@extends('index')

@section('content')
<h1>Ajouter une référence</h1>
<form action="{{ route('reference.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" class="form-control" required maxlength="50">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" maxlength="500"></textarea>
    </div>
    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($category as $categ)
                <option value="{{ $categ->id }}">{{ $categ->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="ressources">Ressources</label>
        <select name="ressources[]" id="ressources" class="form-control" multiple>
            @foreach ($ressource as $res)
                <option value="{{ $res->id }}">{{ $res->title }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
@endsection
