@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0"><i class="fas fa-eye me-2"></i>Détails de la règle de conservation</h2>
                    </div>
                    <div class="card-body">
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations de base</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <strong>Référence:</strong>
                                        <p>{{ $rule->code }}</p>
                                    </div>
                                    <div class="col-md-10">
                                        <strong>Intitulé:</strong>
                                        <p>{{ $rule->name }}</p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <strong>Description:</strong>
                                    <p>{{ $rule->description }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h4 class="mb-0"><i class="fas fa-history me-2"></i>Historique (Archives historiques)</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>Durée:</strong>
                                        <p>{{ $rule->duration }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Conserver:</strong>
                                        <p>{{ $rule->trigger->code }} - {{ $rule->trigger->name }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Sort:</strong>
                                        <p>{{ $rule->sort->code }} - {{ $rule->sort->name }}</p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <strong>Description:</strong>
                                    <p>{{ $rule->dul_description }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('rule.edit', $rule->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>Modifier
                            </a>
                            <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette règle ?')">
                                    <i class="fas fa-trash me-2"></i>Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
