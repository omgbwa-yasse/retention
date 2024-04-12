@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Détails de la règle</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $rule->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $rule->state->name }}</h6>
                    <p class="card-text">{{ $rule->description }}</p>
                    <a href="{{ route('rule.edit', $rule->id) }}" class="btn btn-primary">Modifier</a>
                    <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                    <hr>
                    <a href="{{ route('active.create', $rule->id) }}" class="btn btn-primary">Ajouter un durée active</a>
                    <a href="{{ route('active.create', $rule->id) }}" class="btn btn-primary">Ajouter un durée semi-active</a>
                    <a href="{{ route('active.create', $rule->id) }}" class="btn btn-primary">Ajouter un durée passive</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
