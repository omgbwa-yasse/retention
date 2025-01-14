@extends('index')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-lg-8">
                <h1 class="h2 mb-0">Mission : {{ $item->name }}</h1>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-lg-end">
                    <a href="{{ route('mission.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                    <a href="{{ route('mission.edit', $item->id) }}" class="btn btn-primary me-2">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <form action="{{ route('mission.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette mission ?')">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID :</strong> {{ $item->id }}</p>
                        <p><strong>Code :</strong> {{ $item->code }}</p>
                        <p><strong>Pays :</strong> {{ $item->country->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Description :</strong></p>
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Ajoutez ici tout JavaScript spécifique à cette page si nécessaire
    </script>
@endpush
