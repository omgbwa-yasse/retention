@extends('index')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Ajouter une typologie</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('typology.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label"><i class="fas fa-heading me-2"></i>Titre</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required placeholder="Entrez le titre de la typologie">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label"><i class="fas fa-align-left me-2"></i>Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Décrivez la typologie"></textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label"><i class="fas fa-tags me-2"></i>Catégorie</label>
                                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>Créer la typologie
                                </button>
                                <a href="{{ route('typology.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
@endpush
