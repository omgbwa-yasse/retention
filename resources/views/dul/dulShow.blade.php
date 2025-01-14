@extends('index')

@section('content')
    <h1>{{ $rule->id }} - {{ $rule->name }}</h1>
    <div class="container">
        <h2>Détails du Dul </h2>
        <p><strong>Durée :</strong> {{ $dul->duration }}</p>
        <p><strong>Description :</strong> {{ $dul->description }}</p>
        <!-- Affichez ici les détails des clés étrangères rule_id, trigger_id, sort_id -->
        <a href="{{ route('rule.dul.index', [$rule->id , $dul->id]) }}" class="btn btn-primary">Retour à la liste</a>

    </div>
@endsection
