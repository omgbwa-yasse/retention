<!-- show.blade.php -->

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
                        <p>ID du DUL : {{ $dulArticle->dul->id }}</p>
                        <p>Nom du DUL : {{ $dulArticle->dul->name }}</p>
                        <!-- Ajoute d'autres détails du DUL ici si nécessaire -->
                    </div>
                    <hr>
                    <div>
                        <h5>Détails de l'article associé :</h5>
                        <p>ID de l'article : {{ $dulArticle->article->id }}</p>
                        <p>Titre de l'article : {{ $dulArticle->article->name }}</p>
                        <!-- Ajoute d'autres détails de l'article ici si nécessaire -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
