@extends('index')

@section('content')
<h1>Modifier la règle {{ $rule->name }}</h1>

<form action="{{ route('rule.update', $rule->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Nom de la règle</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $rule->name) }}" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required>{{ old('description', $rule->description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="state_id">État</label>
        <select class="form-control" id="state_id" name="state_id" required>
            @foreach ($states as $state)
                <option value="{{ $state->id }}" {{ old('state_id', $rule->state_id) == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>
@endsection
