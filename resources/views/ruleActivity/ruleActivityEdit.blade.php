<!-- resources/views/rules/edit.blade.php -->
@extends('index')

@section('content')
    <h1>Modifier la relation</h1>
    <form action="{{ route('rule.activity.update', $rule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nom de la Règle:</label>
            <input type="text" name="name" id="name" value="{{ $rule->name }}">
        </div>
        <div>
            <label for="activities">Classifications:</label>
            <select name="activities[]" id="activities" multiple>
                @foreach($activities as $activity)
                    <option value="{{ $activity->id }}" {{ $rule->activities->contains($activity->id) ? 'selected' : '' }}>{{ $activity->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Enregistrer</button>
    </form>
@endsection
