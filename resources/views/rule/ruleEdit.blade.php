@extends('index')

@section('content')

    <div class="container">
        <h2>Modifier une règle de conservation</h2>
        <form action="{{ route('rule.update', $rule->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-2">
                    <label for="code" class="form-label">Référence</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $rule->code) }}">
                </div>
                <div class="col-10">
                    <label for="name" class="form-label">Intitulé</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $rule->name) }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description">{{ old('description', $rule->description) }}</textarea>
                </div>
            </div>

           <h4>Historique (Archives historiques)</h4>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="dul_duration" class="form-label">Durée</label>
                    <input type="number" class="form-control" id="dul_duration" name="dul[duration]" value="{{ old('dul.duration', $rule->dul ? $rule->dul->duration : '') }}">
                </div>
                <div class="col-4">
                    <label for="dul_trigger" class="form-label">Conserver</label>
                    <select class="form-select" id="dul_trigger" name="dul[trigger_id]">
                        @foreach($triggers as $trigger)
                            <option value="{{ $trigger->id }}" {{ old('dul.trigger_id', $rule->dul ? $rule->dul->trigger_id : '') == $trigger->id ? 'selected' : '' }}>{{ $trigger->code }} - {{ $trigger->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="dul_sort" class="form-label">Trier</label>
                    <select class="form-select" id="dul_sort" name="dul[sort_id]">
                        @foreach($sorts as $sort)
                            <option value="{{ $sort->id }}" {{ old('dul.sort_id', $rule->dul ? $rule->dul->sort_id : '') == $sort->id ? 'selected' : '' }}>{{ $sort->code }} - {{ $sort->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="dul_description" class="form-label">Description</label>
                    <textarea class="form-control" id="dul_description" rows="3" name="dul[description]">{{ old('dul.description', $rule->dul ? $rule->dul->description : '') }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Soumettre</button>
                <button type="reset" class="btn btn-danger">Annuler</button>
            </div>
        </form>
    </div>
@endsection
