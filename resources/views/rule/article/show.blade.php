@extends('index')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Détails de l'association</div>
                <div class="card-body">
                    <div>
                        <h5>Détails du DUL :</h5>
                        <p>ID du DUL : {{ $ruleArticle->dul->id }}</p>
                        <p>Nom du DUL : {{ $ruleArticle->dul->name }}</p>
                        <!-- Ajoute d'autres détails du DUL ici si nécessaire -->
                    </div>
                    <hr>
                    <div>
                        <h5>Détails de l'article associé :</h5>
                        <p>ID de l'article : {{ $ruleArticle->article->id }}</p>
                        <p>Titre de l'article : {{ $ruleArticle->article->name }}</p>
                        <!-- Ajoute d'autres détails de l'article ici si nécessaire -->
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('rule.article.index') }}" class="btn btn-secondary">Retour</a>
                        <a href="{{ route('rule.article.edit', ['dulId' => $ruleArticle->dul->id, 'articleId' => $ruleArticle->article->id]) }}" class="btn btn-primary">Éditer</a>
                        <form action="{{ route('rule.article.destroy', ['dulId' => $ruleArticle->dul->id, 'articleId' => $ruleArticle->article->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette association ?')">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
