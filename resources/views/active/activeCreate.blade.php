@extends('index')

@section('content')
<h1>Create Active</h1>

<form action="{{ route('active.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="rule_id">Rule</label>
        <select class="form-control" id="rule_id" name="rule_id" required>
            @foreach ($rules as $rule)
                <option value="{{ $rule->id }}">{{ $rule->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="duration">Duration</label>
        <input type="text" class="form-control" id="duration" name="duration" required maxlength="50">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>

    <div class="form-group">
        <label for="trigger_id">Trigger</label>
        <select class="form-control" id="trigger_id" name="trigger_id" required>
            @foreach ($triggers as $trigger)
                <option value="{{ $trigger->id }}">{{ $trigger->code }} - {{ $trigger->description }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="sort_id">Sort</label>
        <select class="form-control" id="sort_id" name="sort_id" required>
            @foreach ($sorts as $sort)
                <option value="{{ $sort->id }}">{{ $sort->name }} {{ $sort->description }} </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection
