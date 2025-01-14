
@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Supprimer l'association</div>
                <div class="card-body">
                    <p>Êtes-vous sûr de vouloir supprimer cette association ?</p>
                    <form action="{{ route('rule.dul.dularticle.destroy', ['dulId' => $dulId, 'articleId' => $articleId]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
