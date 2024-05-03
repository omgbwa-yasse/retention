@extends('index')

@section('content')

<div class="container">
    <h2>Ajouter une règle de conservation</h2>
    <form action="{{ route('rule.store') }}" method="POST">
        @csrf
      <div class="row mb-3">
        <div class="col-2">
          <label for="code" class="form-label">Référence</label>
          <input type="text" class="form-control" id="code" name="code">
        </div>
        <div class="col-10">
          <label for="name" class="form-label">Intitulé</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-12">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" rows="3" name="description"></textarea>
        </div>
      </div>

      <h4>Active (Bureau)</h4>
      <div class="row mb-3">
        <div class="col-4">
          <label for="active_duration" class="form-label">Durée</label>
          <input type="number" class="form-control" id="active_duration" name="active_duration">
        </div>
        <div class="col-4">
          <label for="active_trigger" class="form-label">Conserver</label>
          <select class="form-select" id="active_trigger" name="active_trigger">
            @foreach($triggers as $trigger)
                <option value="{{ $trigger->id }}">{{ $trigger->code }} - {{ $trigger->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-4">
          <label for="active_sort" class="form-label">Sort</label>
          <select class="form-select" id="active_sort" name="active_sort">
            @foreach($sorts as $sort)
                <option value="{{ $sort->id }}">{{ $sort->code }} - {{ $sort->name }}</option>
            @endforeach
          </select>
        </div>
            <div class="col-12">
              <label for="active_description" class="form-label">Description</label>
              <textarea class="form-control" id="active_description" rows="3" name="active_description"></textarea>
          </div>
      </div>

      <h4>Semi-active (Salle de préarchivage)</h4>
      <div class="row mb-3">
        <div class="col-4">
          <label for="dua_duration" class="form-label">Durée</label>
          <input type="number" class="form-control" id="dua_duration" name="dua_duration">
        </div>
        <div class="col-4">
          <label for="dua_trigger" class="form-label">Conserver</label>
          <select class="form-select" id="dua_trigger" name="dua_trigger">
            @foreach($triggers as $trigger)
                <option value="{{ $trigger->id }}">{{ $trigger->code }} - {{ $trigger->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-4">
          <label for="dua_sort" class="form-label">Sort</label>
          <select class="form-select" id="dua_sort" name="dua_sort">
            @foreach($sorts as $sort)
                <option value="{{ $sort->id }}">{{ $sort->code }} - {{ $sort->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12">
            <label for="dua_description" class="form-label">Description</label>
            <textarea class="form-control" id="dua_description" rows="3" name="dua_description"></textarea>
        </div>
      </div>

      <h4>Historique (Archives historiques)</h4>
      <div class="row mb-3">
        <div class="col-4">
          <label for="dul_duration" class="form-label">Durée</label>
          <input type="number" class="form-control" id="dul_duration" name="dul_duration">
        </div>
        <div class="col-4">
          <label for="dul_trigger" class="form-label">Conserver</label>
          <select class="form-select" id="dul_trigger" name="dul_trigger">
            @foreach($triggers as $trigger)
                <option value="{{ $trigger->id }}">{{ $trigger->code }} - {{ $trigger->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-4">
          <label for="dul_sort" class="form-label">Sort</label>
          <select class="form-select" id="dul_sort" name="dul_sort">
            @foreach($sorts as $sort)
                <option value="{{ $sort->id }}">{{ $sort->code }} - {{ $sort->name }}</option>
            @endforeach
          </select>
        </div>

            <div class="col-12">
              <label for="dul_description" class="form-label">Description</label>
              <textarea class="form-control" id="dul_description" rows="3" name="dul_description"></textarea>
            </div>
          </div>


      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-danger">Cancel</button>
      </div>
    </form>
  </div>
@endsection
