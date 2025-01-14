@extends('index')

@section('content')
    <div class="container my-5">
        @foreach($domaines as $domaine)
            <div class="card  mb-4 shadow-sm">
                <div class="card-header bg-gray text-primary ">
                    <h2 class="mb-0"> <b>{{ $domaine->code }} </b>- {{ $domaine->name }}</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $domaine->description }}</p>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button class="btn btn-outline-danger btn-sm" title="Imprimer" onclick="window.location.href='{{ route('charter.print', $domaine->id) }}'">
                            <i class="bi bi-printer me-1"></i> Imprimer
                        </button>
                        <button class="btn btn-outline-success btn-sm" title="Exporter" onclick="window.location.href='{{ route('charter.export', $domaine->id) }}'">
                            <i class="bi bi-download me-1"></i> Exporter
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" title="Partager sur le forum" onclick="window.location.href='{{ route('subject.create', ['class_id' => $domaine->id]) }}'">
                            <i class="bi bi-share me-1"></i> Partager sur le forum
                        </button>


                        <button class="btn btn-outline-info btn-sm" title="Commentaires"  onclick="window.location.href='{{ route('subject.index') }}'">
                            <i class="bi bi-chat-dots me-1"></i> Commentaires <span class="badge bg-info text-white">{{ $domaine->subjects->count() }}</span>
                        </button>

                    </div>
                    @include('charter.classes', ['classes' => $domaine->children])
                </div>
            </div>
        @endforeach
    </div>
@endsection


















