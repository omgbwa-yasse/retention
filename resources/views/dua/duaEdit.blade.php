@extends('index')

@section('content')
    <div class="container">
        <h2>Modifier le Dua</h2>
        <form action="{{ route('rule.dua.update', $dua->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="duration">Durée :</label>
                <input type="text" class="form-control" id="duration" name="duration" value="{{ $dua->duration }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea class="form-control" id="description" name="description">{{ $dua->description }}</textarea>
            </div>
            <!-- Ajoutez ici les champs pour les clés étrangères rule_id, trigger_id, sort_id -->
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>
@endsection
