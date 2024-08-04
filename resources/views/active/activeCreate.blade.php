@extends('index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0"><i class="fas fa-plus-circle"></i> Create Active</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('active.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="rule_id"><i class="fas fa-gavel"></i> Rule</label>
                        <select class="form-control" id="rule_id" name="rule_id" required>
                            @foreach ($rules as $rule)
                                <option value="{{ $rule->id }}">{{ $rule->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="duration"><i class="fas fa-clock"></i> Duration</label>
                        <input type="text" class="form-control" id="duration" name="duration" required maxlength="50">
                    </div>

                    <div class="form-group">
                        <label for="description"><i class="fas fa-align-left"></i> Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="trigger_id"><i class="fas fa-exclamation-triangle"></i> Trigger</label>
                        <select class="form-control" id="trigger_id" name="trigger_id" required>
                            @foreach ($triggers as $trigger)
                                <option value="{{ $trigger->id }}">{{ $trigger->code }} - {{ $trigger->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sort_id"><i class="fas fa-sort"></i> Sort</label>
                        <select class="form-control" id="sort_id" name="sort_id" required>
                            @foreach ($sorts as $sort)
                                <option value="{{ $sort->id }}">{{ $sort->name }} {{ $sort->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
