@extends('index')

@section('content')
<h1>Références</h1>
<a href="{{ route('reference.create') }}" class="btn btn-primary">Ajouter une référence</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Catégorie</th>
            <th>Ressources</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reference as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->category->title }}</td>
                <td>
                    @foreach ($item->ressource as $res)
                        <p>{{ $res->title }}</p>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('reference.edit', $item->id) }}" class="btn btn-primary">Modifier</a>
                    <form action="{{ route('reference.destroy', $item->id) }}" method="POST" class="d-inline">
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
