@extends('index')

@section('content')
    <div class="container">
        <h2>Liste des rule dul</h2>
        <a href="{{ route('rule.dul.create', $rule) }}" class="btn btn-primary mb-3">Ajouter un Dul</a>
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
                @foreach ($duls as $dul)
                    <tr>
                        <td>{{ $dul->id }}</td>
                        <td>{{ $dul->duration }}</td>
                        <td>{{ $dul->description }}</td>
                        <td>
                            <a href="{{ route('rule.dul.show', [$rule->id, $dul->id]) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('rule.dul.edit', [$rule->id , $dul->id]) }}" class="btn btn-primary btn-sm">Modifier</a>
                            <form action="{{ route('rule.dul.destroy', [$rule->id, $dul->id]) }}" method="POST" style="display: inline;">
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
