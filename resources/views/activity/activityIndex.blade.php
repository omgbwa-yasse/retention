@extends('index')
<style>
    .table th {
        font-weight: 600;
    }
    .table td {
        vertical-align: middle;
    }
    .btn-group .btn {
        padding: .25rem .5rem;
    }
    .card {
        border-radius: 10px;
    }
    .card-body {
        padding: 1.5rem;
    }
    .input-group .form-control {
        border-radius: 5px;
    }
    .input-group .btn {
        border-radius: 5px;
    }
    .alert {
        border-radius: 10px;
    }
</style>
@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0 text-primary"><i class="bi bi-list-task me-2"></i>Activités</h1>
            <div>
                <a href="{{ route('activity.create') }}" class="btn btn-primary me-2">
                    <i class="bi bi-plus-circle me-2"></i>Nouvelle activité
                </a>
                <a href="{{ route('activity.export') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-arrow-down me-2"></i>Exporter en PDF
                </a>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('activity.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-lg" placeholder="Rechercher une activité..." value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-search me-2"></i>Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-primary">Cote</th>
                            <th scope="col" class="text-primary">Titre</th>
                            <th scope="col" class="text-primary">Description</th>
                            <th scope="col" class="text-primary">Parent</th>
                            <th scope="col" class="text-primary">Sous-classes</th>
                            <th scope="col" class="text-primary">Pays</th>
                            <th scope="col" class="text-primary">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($activities as $activity)
                            <tr>
                                <td class="fw-bold">{{ $activity->code }}</td>
                                <td>{{ $activity->name }}</td>
                                <td>{{ Str::limit($activity->description, 50) }}</td>
                                <td>{{ $activity->parent ? $activity->parent->name : 'N/A' }}</td>
                                <td><span class="badge bg-info">{{ $activity->children ? $activity->children->count() : '0' }}</span></td>
                                <td>{{ $activity->countries->name ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('activity.show', $activity->id) }}" class="btn btn-outline-info btn-sm" title="Voir">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('activity.edit', $activity->id) }}" class="btn btn-outline-primary btn-sm" title="Editer">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('activity.destroy', $activity->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette activité ?')">
                                                <i class="bi bi-trash"></i>
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

        <div class="mt-4 d-flex justify-content-center">
            {{ $activities->links() }}
        </div>
    </div>
@endsection

@push('styles')

@endpush
