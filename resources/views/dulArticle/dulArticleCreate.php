@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Créer une association</div>
                <div class="card-body">
                    <form action="{{ route('rule.dul.dularticle') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="dul_id" class="form-label">ID du DUL :</label>
                            <input type="number" class="form-control" id="dul_id" name="dul_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="article_id" class="form-label">ID de la référence :</label>
                            <input type="number" class="form-control" id="article_id" name="article_id" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Créer l'association</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
