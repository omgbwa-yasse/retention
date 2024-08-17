@extends('index')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Réponses</h1>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Nom</th>
                <th>Utilisateur</th>
                <th>Sujet</th>
                <th>Créé le</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($answers as $answer)
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

        <h1 class="mb-4 mt-5">Sujets</h1>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Dernier Post</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->description }}</td>
                    <td>{{ $subject->latestPost ? $subject->latestPost->name : 'Aucun' }}</td>
                    <td>
                        <a href="{{ route('subject.show', $subject->id) }}" class="btn btn-sm btn-primary">Voir</a>
                        <a href="{{ route('subject.edit', $subject->id) }}" class="btn btn-sm btn-secondary">Modifier</a>
                        <form action="{{ route('subject.destroy', $subject->id) }}" method="POST" style="display: inline;">
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
