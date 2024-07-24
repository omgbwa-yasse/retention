@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Créer une nouvelle référence</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('reference.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">Titre</label>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="Entrez le titre de la référence">
                            </div>
                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Décrivez la référence en quelques mots"></textarea>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label fw-bold">Catégorie</label>
                                    <select class="form-select" id="category_id" name="category_id">
                                        <option value="" selected disabled>Sélectionnez une catégorie</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="country_id" class="form-label fw-bold">Pays</label>
                                    <select class="form-select" id="country_id" name="country_id">
                                        <option value="" selected disabled>Sélectionnez un pays</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('reference.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Retour
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Créer la référence
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
