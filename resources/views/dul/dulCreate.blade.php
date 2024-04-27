@extends('index')

@section('content')
    <div class="container">
        <h2>Ajouter un Dul pour la règle "{{ $rule->name }}"</h2>
        <form action="{{ route('rule.dul.store', $rule->id ) }}" method="POST">
            @csrf
            <input type="hidden" name="country_id" value="{{ $country->id }}">
            <input type="hidden" name="rule_id" value="{{ $rule->id }}">
            <div class="form-group">
                <label for="duration">Durée :</label>
                <input type="text" class="form-control" id="duration" name="duration" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="trigger_id">Trigger :</label>
                <select class="form-control" id="trigger_id" name="trigger_id" required>
                    <option value="">Sélectionner Trigger</option>
                    @foreach ($triggers as $trigger)
                        <option value="{{ $trigger->id }}">{{ $trigger->code }} - {{ $trigger->description }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="sort_id">Sort :</label>
                <select class="form-control" id="sort_id" name="sort_id" required>
                    <option value="">Sélectionner Sort</option>
                    @foreach ($sorts as $sort)
                        <option value="{{ $sort->id }}">{{ $sort->name }} - {{ $sort->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="sort_id">Articles :</label>
                <select class="form-control" id="sort_id" name="sort_id" required>
                    <option value="">Sélectionner l'article</option>
                    @foreach ($articles as $article)
                        <option value="{{ $article->id }}">{{ $article->reference }} - {{ $article->name }} </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
@endsection
