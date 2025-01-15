@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0"><i class="fas fa-edit me-2"></i>Modifier une règle de conservation</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('rule.update', $rule->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations de base</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <label for="code" class="form-label">Référence</label>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $rule->code) }}" required>
                                            @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-10">
                                            <label for="name" class="form-label">Intitulé</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $rule->name) }}" required>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description" required>{{ old('description', $rule->description) }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h4 class="mb-0"><i class="fas fa-history me-2"></i> Délai de conservation </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="duration" class="form-label">Durée</label>
                                            <input type="number" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ old('duration', $rule->duration) }}" required>
                                            @error('duration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="trigger_id" class="form-label">Evènement déclencheur</label>
                                            <select class="form-select @error('trigger_id') is-invalid @enderror" id="trigger_id" name="trigger_id" required>
                                                <option value="">Sélectionnez une option</option>
                                                @foreach($triggers as $trigger)
                                                    <option value="{{ $trigger->id }}" {{ old('trigger_id', $rule->trigger_id) == $trigger->id ? 'selected' : '' }}>
                                                        {{ $trigger->code }} - {{ $trigger->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('trigger_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="sort_id" class="form-label">Sort</label>
                                            <select class="form-select @error('sort_id') is-invalid @enderror" id="sort_id" name="sort_id" required>
                                                <option value="">Sélectionnez une option</option>
                                                @foreach($sorts as $sort)
                                                    <option value="{{ $sort->id }}" {{ old('sort_id', $rule->sort_id) == $sort->id ? 'selected' : '' }}>
                                                        {{ $sort->code }} - {{ $sort->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('sort_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dul_description" class="form-label">Description</label>
                                        <textarea class="form-control @error('dul_description') is-invalid @enderror" id="dul_description" rows="3" name="dul_description" required>{{ old('dul_description', $rule->dul_description) }}</textarea>
                                        @error('dul_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <button type="submit" class="btn btn-primary me-md-2">
                                    <i class="fas fa-save me-2"></i>Enregistrer
                                </button>
                                <button type="reset" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-undo me-2"></i>Réinitialiser
                                </button>
                                <a href="{{ route('rule.show', $rule->id) }}" class="btn btn-light ms-auto">
                                    <i class="fas fa-arrow-left me-2"></i>Retour
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
