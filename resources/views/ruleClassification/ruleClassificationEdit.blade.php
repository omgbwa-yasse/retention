<!-- resources/views/rules/edit.blade.php -->
@extends('index')

@section('content')
    <h1>Modifier la relation</h1>
    <form action="{{ route('rule.classification.update', $rule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nom de la Règle:</label>
            <input type="text" name="name" id="name" value="{{ $rule->name }}">
        </div>
        <div>
            <label for="classifications">Classifications:</label>
            <select name="classifications[]" id="classifications" multiple>
                @foreach($classifications as $classification)
                    <option value="{{ $classification->id }}" {{ $rule->classifications->contains($classification->id) ? 'selected' : '' }}>{{ $classification->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Enregistrer</button>
    </form>
@endsection
