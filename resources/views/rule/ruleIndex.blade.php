@extends('index')

@section('content')
    <div class="container">
        <h1>Règles de conservation </h1>
        <a href="{{ route('rule.create') }}" class="btn btn-success mb-2">Ajouter</a>
        <a href="" class="btn btn-grey mb-2">Imprimer</a>
        <a href="{{ route('rule.export') }}" class="btn btn-grey mb-2">Exporter (PDF)</a>
        <a href="" class="btn btn-grey mb-2">Panier</a>

        <!-- Ajouter le formulaire de recherche -->
        <form action="{{ route('rule.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher une règle...">
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
                <th scope="col">Code</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Statut</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($rules as $rule)
                <tr>
                    <th scope="row">{{ $rule->code }}</th>
                    <td>{{ $rule->name }}</td>
                    <td> {{ $rule->description }} </td>
                    <td>
                        @if( $rule->status->name == 'En examen')
                            <span class="badge badge-success">
                        @elseif($rule->status->name == 'Projet')
                                    <span class="badge badge-primary">
                        @elseif($rule->status->name == 'Acceptée')
                                            <span class="badge badge-primary">
                        @endif

                                                {{ $rule->status->name }} </span></td>
                    <td>
                        <a href="{{ route('rule.show', $rule->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('rule.edit', $rule->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                        <form action="{{ route('rule.destroy', $rule->id) }}" method="POST"
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
