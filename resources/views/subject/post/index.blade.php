@extends('index')

@section('content')
    <div class="container">
        <h1>Réponses</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Utilisateur</th>
                <th>Sujet</th>
                <th>Créé le</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($answer as $answer)
                <tr>
                    <td>{{ $answer->name }}</td>
                    <td>{{ $answer->user->name }}</td>
                    <td>{{ $answer->subject->name }}</td>
                    <td>{{ $answer->created_at }}</td>
                    <td>
                        <a href="{{ route('subject.answer.show', $answer->id) }}" class="btn btn-sm btn-primary">Voir</a>
                        <a href="{{ route('subject.answer.edit', $answer->id) }}" class="btn btn-sm btn-secondary">Modifier</a>
                        <form action="{{ route('subject.answer.destroy', $answer->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
