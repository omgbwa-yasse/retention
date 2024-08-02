@extends('index')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h1 class="mb-0"><i class="fas fa-shopping-basket me-2"></i>Ajouter un panier</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('basket.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label"><i class="fas fa-tag me-2"></i>Nom</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Entrez le nom du panier">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label"><i class="fas fa-align-left me-2"></i>Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Décrivez le panier">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="type_id" class="form-label"><i class="fas fa-list-ul me-2"></i>Type de panier</label>
                                <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                                    <option value="">Sélectionnez un type de panier</option>
                                    @foreach ($basketTypes as $basketType)
                                        <option value="{{ $basketType->id }}" {{ old('type_id') == $basketType->id ? 'selected' : '' }}>
                                            {{ $basketType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-plus-circle me-2"></i>Créer le panier
                                </button>
                                <a href="{{ route('basket.index') }}" class="btn btn-outline-secondary">
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
