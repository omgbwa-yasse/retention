<!-- resources/views/rules/show.blade.php -->
@extends('index')

@section('content')
    <h1>Détails de la relation</h1>
    <ul>
        <li><strong>Nom de la Règle:</strong> {{ $rule->name }}</li>
        <li><strong>Classifications:</strong>
            <ul>
                @foreach($rule->classifications as $classification)
                    <li>{{ $classification->name }}</li>
                @endforeach
            </ul>
        </li>
    </ul>
    <a href="{{ route('rule.classification.index') }}">Retour à la liste</a>
@endsection
