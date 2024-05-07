
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

      <h4>Active (Bureau)</h4>
      <div class="row mb-3">
        <div class="col-4">
          <label for="active_duration" class="form-label">Durée</label>
          <input type="number" class="form-control" id="active_duration" name="active[duration]" value="{{ old('active.duration', $rule->active ? $rule->active->duration : '') }}">
        </div>
        <div class="col-4">
          <label for="active_trigger" class="form-label">Conserver</label>
          <select class="form-select" id="active_trigger" name="active[trigger_id]">
            @foreach($triggers as $trigger)
                <option value="{{ $trigger->id }}" {{ old('active.trigger_id', $rule->active ? $rule->active->trigger_id : '') == $trigger->id ? 'selected' : '' }}>{{ $trigger->code }} - {{ $trigger->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-4">
          <label for="active_sort" class="form-label">Sort</label>
          <select class="form-select" id="active_sort" name="active[sort_id]">
            @foreach($sorts as $sort)
                <option value="{{ $sort->id }}" {{ old('active.sort_id', $rule->active ? $rule->active->sort_id : '') == $sort->id ? 'selected' : '' }}>{{ $sort->code }} - {{ $sort->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12">
          <label for="active_description" class="form-label">Description</label>
          <textarea class="form-control" id="active_description" rows="3" name="active[description]">{{ old('active.description', $rule->active ? $rule->active->description : '') }}</textarea>
        </div>
      </div>

      <h4>Semi-active (Salle de préarchivage)</h4>
      <div class="row mb-3">
        <div class="col-4">
          <label for="dua_duration" class="form-label">Durée</label>
          <input type="number" class="form-control" id="dua_duration" name="dua[duration]" value="{{ old('dua.duration', $rule->dua ? $rule->dua->duration : '') }}">
        </div>
        <div class="col-4">
          <label for="dua_trigger" class="form-label">Conserver</label>
          <select class="form-select" id="dua_trigger" name="dua[trigger_id]">
            @foreach($triggers as $trigger)
                <option value="{{ $trigger->id }}" {{ old('dua.trigger_id', $rule->dua ? $rule->dua->trigger_id : '') == $trigger->id ? 'selected' : '' }}>{{ $trigger->code }} - {{ $trigger->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-4">
          <label for="dua_sort" class="form-label">Sort</label>
          <select class="form-select" id="dua_sort" name="dua[sort_id]">
            @foreach($sorts as $sort)
                <option value="{{ $sort->id }}" {{ old('dua.sort_id', $rule->dua ? $rule->dua->sort_id : '') == $sort->id ? 'selected' : '' }}>{{ $sort->code }} - {{ $sort->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12">
          <label for="dua_description" class="form-label">Description</label>
          <textarea class="form-control" id="dua_description" rows="3" name="dua[description]">{{ old('dua.description', $rule->dua ? $rule->dua->description : '') }}</textarea>
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
          <label for="dul_sort" class="form-label">Sort</label>
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
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-danger">Cancel</button>
      </div>
    </form>
  </div>
@endsection
