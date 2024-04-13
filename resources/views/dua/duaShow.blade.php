@extends('index')

@section('content')
    <div class="container">
        <h2>Détails du Dua</h2>
        <p><strong>Durée :</strong> {{ $dua->duration }}</p>
        <p><strong>Description :</strong> {{ $dua->description }}</p>
        <!-- Affichez ici les détails des clés étrangères rule_id, trigger_id, sort_id -->
        <a href="{{ route('rule.dua.index') }}" class="btn btn-primary">Retour à la liste</a>
    </div>
@endsection
