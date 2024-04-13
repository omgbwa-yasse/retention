@extends('index')

@section('content')
    <h1>Créer une nouvelle relation</h1>
    <form action="{{ route('rule.classification.store', $rule->id) }}" method="POST">
        @csrf

        <input type="text" name="rule_id" id="rule_id" value="rule_id" hidden>
        <div>
            <label for="classification_id">Classifications:</label>
            <select name="classification_id" id="classification_id">
                <option value="">Choisir la classe à lier à la règle </option>
                @foreach($classifications as $classification)
                    <option value="{{ $classification->id }}">{{ $classification->cote }} : {{ $classification->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Créer</button>
    </form>
@endsection
