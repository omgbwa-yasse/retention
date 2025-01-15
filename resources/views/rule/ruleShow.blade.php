@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
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


                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h4 class="mb-0"><i class="fas fa-history me-2"></i>Références (articles)</h4>
                            </div>
                            <div class="card-body">
                                @if ($rule->articles->count()>0)
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Référence</th>
                                                <th>Intitulé</th>
                                                <th>Sources</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rule->articles as $article)
                                                <tr>
                                                    <td>{{ $article->code }}</td>
                                                    <td>{{ $article->name }}</td>
                                                    <td>
                                                        <span class="badge bg-danger">{{ $article->reference->name }}</span>
                                                        <span class="badge bg-primary">{{ $article->reference->category->name }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('rule.article.show', [$rule->id, $article->id]) }}" class="btn btn-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-warning">
                                        Aucun article trouvé.
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="d-flex gap-2">
                            <a href="{{ route('rule.edit', $rule->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>Modifier
                            </a>
                            <a href="{{ route('rule.article.create', $rule->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>Ajouter une article
                            </a>
                            <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" style="display:inline; margin-left:auto;">
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
