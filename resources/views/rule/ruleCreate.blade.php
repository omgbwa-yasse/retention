@extends('index')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Ajouter une règle de conservation</h2>
        <form action="{{ route('rule.store') }}" method="POST">
            @csrf
            <div class="card mb-4">
                <div class="card-header">
                    Informations de base
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="code" class="form-label">Référence</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                        <div class="col-md-10">
                            <label for="name" class="form-label">Intitulé</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Active (Bureau)
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="active_duration" class="form-label">Durée</label>
                            <input type="number" class="form-control" id="active_duration" name="active_duration" required>
                        </div>
                        <div class="col-md-4">
                            <label for="active_trigger" class="form-label">Conserver</label>
                            <select class="form-select" id="active_trigger" name="active_trigger" required>
                                @foreach($triggers as $trigger)
                                    <option value="{{ $trigger->id }}">{{ $trigger->code }} - {{ $trigger->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="active_sort" class="form-label">Sort</label>
                            <select class="form-select" id="active_sort" name="active_sort" required>
                                @foreach($sorts as $sort)
                                    <option value="{{ $sort->id }}">{{ $sort->code }} - {{ $sort->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="active_description" class="form-label">Description</label>
                            <textarea class="form-control" id="active_description" rows="3" name="active_description" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Semi-active (Salle de préarchivage)
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="dua_duration" class="form-label">Durée</label>
                            <input type="number" class="form-control" id="dua_duration" name="dua_duration" required>
                        </div>
                        <div class="col-md-4">
                            <label for="dua_trigger" class="form-label">Conserver</label>
                            <select class="form-select" id="dua_trigger" name="dua_trigger" required>
                                @foreach($triggers as $trigger)
                                    <option value="{{ $trigger->id }}">{{ $trigger->code }} - {{ $trigger->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="dua_sort" class="form-label">Sort</label>
                            <select class="form-select" id="dua_sort" name="dua_sort" required>
                                @foreach($sorts as $sort)
                                    <option value="{{ $sort->id }}">{{ $sort->code }} - {{ $sort->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="dua_description" class="form-label">Description</label>
                            <textarea class="form-control" id="dua_description" rows="3" name="dua_description" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Historique (Archives historiques)
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="dul_duration" class="form-label">Durée</label>
                            <input type="number" class="form-control" id="dul_duration" name="dul_duration" required>
                        </div>
                        <div class="col-md-4">
                            <label for="dul_trigger" class="form-label">Conserver</label>
                            <select class="form-select" id="dul_trigger" name="dul_trigger" required>
                                @foreach($triggers as $trigger)
                                    <option value="{{ $trigger->id }}">{{ $trigger->code }} - {{ $trigger->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="dul_sort" class="form-label">Sort</label>
                            <select class="form-select" id="dul_sort" name="dul_sort" required>
                                @foreach($sorts as $sort)
                                    <option value="{{ $sort->id }}">{{ $sort->code }} - {{ $sort->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="dul_description" class="form-label">Description</label>
                            <textarea class="form-control" id="dul_description" rows="3" name="dul_description" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Enregistrer</button>
                <button type="reset" class="btn btn-danger">Annuler</button>
            </div>
        </form>
    </div>
@endsection
