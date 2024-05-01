@extends('index')

@section('content')

<h1> Ajouter un règle </h1>
<hr/>
Classe : {{ $activity->name }} <br>
Description : {{ $activity->description }} <hr/>

<form action="{{ route('activity.rule.store', $activity) }}" method="POST">
    @csrf
    <div>
        <label for="rule_id">Choisir la règle :</label>
        <select name="rule_id" required>
            @foreach ($rules as $rule)
                <option value="{{ $rule->id }}">{{ $rule->code }} - {{ $rule->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <button type="submit">Add Rule</button>
    </div>
</form>
@endsection
