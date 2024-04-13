@extends('index')

@section('content')
    <div class="container">
        <h2>Liste des rule.dua</h2>
        <a href="{{ route('rule.dua.create', $rule) }}" class="btn btn-primary mb-3">Ajouter un Dua</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Durée</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($duas as $dua)
                    <tr>
                        <td>{{ $dua->id }}</td>
                        <td>{{ $dua->duration }}</td>
                        <td>{{ $dua->description }}</td>
                        <td>
                            <a href="{{ route('rule.dua.show', [$rule->id,$dua->id]) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('rule.dua.edit', [$rule->id ,$dua->id]) }}" class="btn btn-primary btn-sm">Modifier</a>
                            <form action="{{ route('rule.dua.destroy', [$rule->id,$dua->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce Dua ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
