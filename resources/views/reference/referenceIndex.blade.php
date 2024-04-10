<!-- resources/views/references/index.blade.php -->

@extends('index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>List of Reference</h1>
                <a href="{{ route('reference.create') }}" class="btn btn-primary mb-3">Ajouter une référence</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Catégorie</th>
                            <th>Pays</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($references as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->category_name }}</td>
                                <td>{{ $item->country_name }}</td>
                                <td>
                                    <a href="{{ route('reference.edit', $item->id) }}"
                                        class="btn btn-sm btn-primary">Modifier</a>
                                    <form action="{{ route('reference.destroy', $item->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                    <a href="{{ route('reference.show', $item->id) }}" class="btn btn-sm btn-success">Voir
                                        plus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
