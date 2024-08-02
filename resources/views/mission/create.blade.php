@extends('index')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Ajouter un domaine</h2>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('mission.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="country_id" value="{{ $auth->country_id }}">

                            <div class="mb-3">
                                <label for="code" class="form-label"><i class="fas fa-barcode me-2"></i>Cote</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" required placeholder="Entrez la cote">
                                @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label"><i class="fas fa-heading me-2"></i>Titre</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required placeholder="Entrez le titre du domaine">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label"><i class="fas fa-align-left me-2"></i>Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" maxlength="500" placeholder="Décrivez le domaine (max 500 caractères)"></textarea>
                                <small id="character-count" class="form-text text-muted">500 caractères restants</small>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>Créer le domaine
                                </button>
                                <a href="{{ route('mission.index') }}" class="btn btn-outline-secondary">
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var description = document.getElementById('description');
            var characterCount = document.getElementById('character-count');
            var maxLength = 500;

            description.addEventListener('input', function() {
                var remainingChars = maxLength - this.value.length;
                characterCount.textContent = remainingChars + ' caractères restants';
                if (remainingChars <= 50) {
                    characterCount.classList.add('text-warning');
                } else if (remainingChars <= 0) {
                    characterCount.classList.remove('text-warning');
                    characterCount.classList.add('text-danger');
                } else {
                    characterCount.classList.remove('text-warning', 'text-danger');
                }
            });
        });
    </script>
@endpush
