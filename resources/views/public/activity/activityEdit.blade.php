@extends('index')

@section('content')
    <h1>Modifier la Classification</h1>

    <form action="{{ route('activity.update', $activity->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="code">Cote</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ $activity->code }}" required>
        </div>

        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $activity->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $activity->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="parent_id">Catégorie Parent</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">Créer un nouveau domaine</option>
                @foreach ($activities as $parent)
                    <option value="{{ $parent->id }}" @selected($activity->parent_id == $parent->id)>{{$parent->code }} - {{$parent->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="country_id" value="{{ $auth->country_id }}">

        <button type="submit" class="btn btn-primary">Sauvegarder</button>
        <a href="{{ route('activity.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
