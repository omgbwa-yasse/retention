<!-- resources/views/rules/show.blade.php -->
@extends('index')

@section('content')
    <h1>Détails de la relation</h1>
    <ul>
        <li><strong>Nom de la Règle:</strong> {{ $rule->name }}</li>
        <li><strong>Classifications:</strong>
            <ul>
                @foreach($rule->activities as $activity)
                    <li>{{ $activity->name }}</li>
                @endforeach
            </ul>
        </li>
    </ul>
    <a href="{{ route('rule.activity.index') }}">Retour à la liste</a>
@endsection
