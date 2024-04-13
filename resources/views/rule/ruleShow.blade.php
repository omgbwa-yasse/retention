@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mt-5 mb-4">Détails de la règle</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $rule->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $rule->state->name }}</h6>
                    <p class="card-text">{{ $rule->description }}</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="{{ route('rule.edit', $rule->id) }}" class="btn btn-primary me-md-2 mb-2 mb-md-0">Modifier</a>
                        <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                    <hr>
                    Ajouter
                    <div class="d-grid gap-2 d-md-flex">
                        <a href="{{ route('active.create', $rule->id) }}" class="btn btn-primary btn-sm me-md-2">Durée active</a>
                        <a href="{{ route('rule.dua.create', $rule->id) }}" class="btn btn-primary btn-sm me-md-2">Durée semi-active</a>
                        <a href="{{ route('rule.dul.create', $rule->id) }}" class="btn btn-primary btn-sm me-md-2">Durée passive</a>
                        <a href="{{ route('rule.classification.create', $rule->id) }}" class="btn btn-primary btn-sm">Aux activités</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
