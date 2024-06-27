@extends('index')

@section('content')
    <div class="container">
        <h1>Activités</h1>
        <a href="{{ route('activity.create') }}" class="btn btn-primary mb-2">Créer un nouvel élément</a>

        <form action="{{ route('activity.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher une activité...">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Rechercher</button>
                </div>
            </div>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Cote</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Parent</th>
                <th scope="col">Sous-classes</th>
                <th scope="col">Pays</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($activities as $activity)
                <tr>
                    <td>{{ $activity->code }}</td>
                    <td>
                        {{ $activity->name }}
                    </td>
                    <td>{{ $activity->description }}</td>
                    <td>
                        {{-- à revoir      {{ $activity->parent->name }} --}}
                        "a revoir ( nom parent )"
                    </td>
                    <td>
                        @if ($activity->children)
                            {{ $activity->children->count() }}
                        @endif
                    </td>
                    <td>
                        {{ $activity->countries->name }}
                    </td>
                    <td>
                        <a href="{{ route('activity.show', $activity->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('activity.edit', $activity->id) }}" class="btn btn-primary btn-sm">Editer</a>
                        <form action="{{ route('activity.destroy', $activity->id) }}" method="POST"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
