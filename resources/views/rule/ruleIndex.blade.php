@extends('index')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0 text-primary"><i class="fas fa-tasks me-2"></i>Activités</h1>
            <div>
                <a href="{{ route('rule.create') }}" class="btn btn-primary me-2">
                    <i class="fas fa-plus-circle me-2"></i>Nouvelle activité
                </a>
                <a href="{{ route('rule.export') }}" class="btn btn-success">
                    <i class="fas fa-file-export me-2"></i>Exporter en PDF
                </a>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('rule.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-lg" placeholder="Rechercher une activité..." value="{{ request('search') }}">
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
                        @forelse ($rules as $rule)
                            <tr>
                                <td class="fw-bold">{{ $rule->code }}</td>
                                <td>{{ $rule->name }}</td>
                                <td>{{ Str::limit($rule->description, 50) }}</td>
                                <td>{{ $rule->parent ? $rule->parent->name : 'N/A' }}</td>
                                <td><span class="badge bg-info">{{ $rule->children ? $rule->children->count() : '0' }}</span></td>
                                <td>{{ $rule->countries->name ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('rule.show', $rule->id) }}" class="btn btn-outline-info btn-sm" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('rule.edit', $rule->id) }}" class="btn btn-outline-primary btn-sm" title="Editer">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette activité ?')">
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

        <div class="mt-4 d-flex justify-content-center">
{{--            {{ $rules->links() }}--}}
            links
        </div>
    </div>
@endsection

@push('styles')
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
    </style>
@endpush
