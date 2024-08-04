@extends('index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0"><i class="fas fa-plus-circle"></i> Ajouter un Dua pour la règle "{{ $rule->name }}"</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('rule.dua.store', $rule->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="rule_id" value="{{ $rule->id }}">

                    <div class="form-group">
                        <label for="duration"><i class="fas fa-clock"></i> Durée :</label>
                        <input type="text" class="form-control" id="duration" name="duration" required>
                    </div>

                    <div class="form-group">
                        <label for="description"><i class="fas fa-align-left"></i> Description :</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="trigger_id"><i class="fas fa-exclamation-triangle"></i> Trigger :</label>
                        <select class="form-control" id="trigger_id" name="trigger_id" required>
                            <option value="">Sélectionner Trigger</option>
                            @foreach ($triggers as $trigger)
                                <option value="{{ $trigger->id }}">{{ $trigger->code }} - {{ $trigger->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sort_id"><i class="fas fa-sort"></i> Sort :</label>
                        <select class="form-control" id="sort_id" name="sort_id" required>
                            <option value="">Sélectionner Sort</option>
                            @foreach ($sorts as $sort)
                                <option value="{{ $sort->id }}">{{ $sort->name }} - {{ $sort->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
