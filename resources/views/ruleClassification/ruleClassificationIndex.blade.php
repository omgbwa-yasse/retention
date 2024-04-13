<!-- resources/views/rules/index.blade.php -->
@extends('index')

@section('content')
    <h1>Liste des Règles</h1>
    <table>
        <thead>
            <tr>
                <th>Nom de la Règle</th>
                <th>Classifications</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rules as $rule)
                <tr>
                    <td>{{ $rule->name }}</td>
                    <td>
                        <ul>
                            @foreach($rule->classifications as $classification)
                                <li>{{ $classification->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('rule.classification.edit', $rule->id) }}">Editer</a>
                        <form action="{{ route('rule.classification.destroy', $rule->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
