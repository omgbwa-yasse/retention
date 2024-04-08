@extends('index')

@section('content')
    <h1>{{ $ressource->title }}</h1>

    <p>Description : {{ $ressource->description }}</p>

    @if ($ressource->link)
        <p><a href="{{ $ressource->link }}" target="_blank">Lien</a></p>
    @endif

    @if ($ressource->file_path)
        <p><a href="{{ asset('storage/' . $ressource->file_path) }}" target="_blank">Télécharger le fichier</a></p>
    @endif

    <h2>Références associées</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Catégorie</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ressource->references as $reference)
                <tr>
                    <td>{{ $reference->title }}</td>
                    <td>{{ $reference->description }}</td>
                    <td>{{ $reference->category->title }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('ressource.index') }}" class="btn btn-primary">Retour à la liste des ressources</a>
@endsection
