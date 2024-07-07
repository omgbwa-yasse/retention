@extends('index')

@section('content')
    <div class="container">
        @foreach($domaines as $domaine)
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h2 class="mb-0">{{ $domaine->code }} - {{ $domaine->name }}</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $domaine->description }}</p>

                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button class="btn btn-outline-danger btn-sm" title="Imprimer">
                            <i class="bi bi-printer"></i> Imprimer
                        </button>
                        <button class="btn btn-outline-success btn-sm" title="Exporter">
                            <i class="bi bi-download"></i> Exporter
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" title="Partager sur le forum">
                            <i class="bi bi-share"></i> Partager sur le forum
                        </button>
                        <button class="btn btn-outline-info btn-sm" title="Commentaires">
                            <i class="bi bi-chat-dots"></i> Commentaires (12)
                        </button>
                    </div>

                    @include('charter.classes', ['classes' => $domaine->children])
                </div>
            </div>
        @endforeach
    </div>
@endsection
