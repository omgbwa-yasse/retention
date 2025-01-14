@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modifier l'association</div>
                <div class="card-body">
                    <form action="{{ route('rule.dul.dularticle.update', ['dulId' => $dulId, 'articleId' => $articleId]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="dul_id" class="form-label">ID du DUL :</label>
                            <input type="number" class="form-control" id="dul_id" name="dul_id" value="{{ $dulId }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="article_id" class="form-label">ID de la référence :</label>
                            <input type="number" class="form-control" id="article_id" name="article_id" value="{{ $articleId }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Mettre à jour l'association</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
