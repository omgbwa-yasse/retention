@extends('index')

@section('content')
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">{{ $typology->name }}</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="card-title">Description</h5>
                        <p class="card-text">{{ $typology->description }}</p>

                        <h5 class="card-title mt-4">Catégorie</h5>
                        <p class="card-text">{{ $typology->category->name }}</p>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title">Informations</h5>
                                <p class="card-text"><strong>Créé le :</strong> {{ $typology->created_at->format('d/m/Y H:i') }}</p>
                                <p class="card-text"><strong>Mis à jour le :</strong> {{ $typology->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('typology.edit', $typology->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>

                    <form action="{{ route('typology.destroy', $typology->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette typologie ?')">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
