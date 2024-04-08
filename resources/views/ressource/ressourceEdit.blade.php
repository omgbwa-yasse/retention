@extends('index')

@section('content')
    <h1>Modifier la ressource</h1>

    <form action="{{ route('ressource.update', $ressource->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" class="form-control" value="{{ $ressource->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $ressource->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="link">Lien</label>
            <input type="text" name="link" class="form-control" value="{{ $ressource->link }}">
        </div>

        <div class="form-group">
            <label for="file_path">Fichier</label>
            <input type="file" name="file_path" class="form-control-file">
            @if ($ressource->file_path)
                <a href="{{ asset('storage/' . $ressource->file_path) }}" target="_blank">Télécharger le fichier actuel</a>
            @endif
        </div>

        <div class="form-group">
            <label for="reference_id">Référence</label>
            <select name="reference_id" class="form-control">
                @foreach ($references as $reference)
                    <option value="{{ $reference->id }}" @if ($reference->id == $ressource->reference_id) selected @endif>{{ $reference->title }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection
