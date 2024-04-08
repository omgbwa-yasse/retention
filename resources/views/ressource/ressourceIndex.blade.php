@extends('index')

@section('content')
    <h1>Liste des ressources</h1>

    <a href="{{ route('ressource.create') }}" class="btn btn-primary mb-3">Ajouter une ressource</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Lien</th>
                <th>Fichier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ressources as $ressource)
                <tr>
                    <td>{{ $ressource->title }}</td>
                    <td>{{ $ressource->description }}</td>
                    <td>
                        @if ($ressource->link)
                            <a href="{{ $ressource->link }}" target="_blank">{{ $ressource->link }}</a>
                        @endif
                    </td>
                    <td>
                        @if ($ressource->file_path)
                            <a href="{{ asset('storage/' . $ressource->file_path) }}" target="_blank">{{ basename($ressource->file_path) }}</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('ressource.edit', $ressource->id) }}" class="btn btn-primary">Modifier</a>
                        <form action="{{ route('ressource.destroy', $ressource->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
