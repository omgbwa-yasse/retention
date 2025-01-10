@extends('index')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <!-- En-tête du document -->
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="display-6 mb-2">{{ $reference->name }}</h1>
                        <div class="d-flex gap-3 text-muted small">
                        <span>
                            <i class="bi bi-folder"></i>
                            Catégorie: {{ $reference->category->name }}
                        </span>
                            <span>
                            <i class="bi bi-geo-alt"></i>
                            Pays: {{ $reference->country->name }}
                        </span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">Description</h6>
                    <div class="bg-light p-3 rounded">
                        {{ $reference->description }}
                    </div>
                </div>

                <!-- Articles -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">Articles associés</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>Nom de l'article</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($reference->articles as $article)
                                <tr>
                                    <td>{{ $article->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted">Aucun article associé</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Fichiers -->
                <div>
                    <h6 class="text-uppercase text-muted small mb-2">Documents joints</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>Nom du fichier</th>
                                <th width="120" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($reference->files as $file)
                                <tr>
                                    <td class="align-middle">
                                        <i class="bi bi-file-earmark-text me-2"></i>
                                        {{ $file->name }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ $file->file_path }}"
                                           class="btn btn-sm btn-outline-primary"
                                           target="_blank">
                                            <i class="bi bi-eye me-1"></i>
                                            Consulter
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-muted">Aucun fichier joint</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pied de page -->
            <div class="card-footer bg-light text-muted small p-3">
                <div class="d-flex justify-content-between">
{{--                    <span>Document généré le {{ date('d/m/Y') }}</span>--}}
                    <span>Référence: {{ $reference->id }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles additionnels -->
    <style>
        .table {
            margin-bottom: 0;
        }
        .table > :not(caption) > * > * {
            padding: 0.5rem;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
        }
    </style>

    <!-- Ajout de Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection
