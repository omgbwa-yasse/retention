@extends('index')

<style>
    body {
        background-color: #f8f9fa;
    }
    .container {
        max-width: 1200px;
    }
    .card {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-radius: 0.5rem;
    }
    .card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0,0,0,.125);
        padding: 1rem 1.5rem;
    }
    .card-body {
        padding: 1.5rem;
    }
    .table th {
        font-weight: 600;
        color: #495057;
        border-top: none;
    }
    .table td {
        vertical-align: middle;
    }
    .btn-group .btn {
        padding: .375rem .75rem;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
    .alert {
        border: none;
    }
    .badge {
        font-weight: 500;
        padding: 0.5em 0.75em;
    }
    .pagination {
        justify-content: center;
    }
    .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }
    .page-link {
        color: #007bff;
    }
    .page-link:hover {
        color: #0056b3;
    }
</style>

@section('content')
    <div class="container my-5">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4 text-primary"><i class="fas fa-tasks me-3"></i>Regle </h1>
            </div>
            <div class="col-auto">
                <a href="{{ route('rule.create') }}" class="btn btn-primary btn-lg me-2">
                    <i class="fas fa-plus-circle me-2"></i>Nouvelle activité
                </a>
                <a href="{{ route('rule.export') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-file-export me-2"></i>Exporter en PDF
                </a>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('rule.index') }}" method="GET">
                    <div class="input-group input-group-lg">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher une activité..." value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-search me-2"></i>Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title mb-0">Liste des activités</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Cote</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Description</th>
                            <th scope="col">Parent</th>
                            <th scope="col">Sous-classes</th>
                            <th scope="col">Pays</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($rules as $rule)
                            <tr>
                                <td class="fw-bold">{{ $rule->code }}</td>
                                <td>{{ $rule->name }}</td>
                                <td>{{ Str::limit($rule->description, 50) }}</td>
                                <td>{{ $rule->parent ? $rule->parent->name : 'N/A' }}</td>
                                <td><span class="badge bg-info rounded-pill">{{ $rule->children ? $rule->children->count() : '0' }}</span></td>
                                <td>{{ $rule->countries->name ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('rule.show', $rule->id) }}" class="btn btn-outline-info" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('rule.edit', $rule->id) }}" class="btn btn-outline-primary" title="Editer">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette activité ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Aucune activité trouvée</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $rules->links() }}
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
@endpush
