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
        transition: transform 1s;
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
    .card:hover {
        transform: translateY(-5px); /* Effet de survol */
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
<script>
    function toggleDescription(activityId) {
        var descriptionElement = document.getElementById('description-' + activityId);
        var fullDescriptionElement = document.getElementById('full-description-' + activityId);
        var seeMoreElement = document.getElementById('see-more-' + activityId);
        var seeLessElement = document.getElementById('see-less-' + activityId);

        if (fullDescriptionElement.style.display === 'none') {
            fullDescriptionElement.style.display = 'inline';
            seeMoreElement.style.display = 'none';
            seeLessElement.style.display = 'inline';
        } else {
            fullDescriptionElement.style.display = 'none';
            seeMoreElement.style.display = 'inline';
            seeLessElement.style.display = 'none';
        }
    }
</script>

@section('content')
    <div class="container my-5">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4 text-primary"><i class="fas fa-tasks me-3"></i>Règles</h1>
            </div>
            <div class="col-auto">
                <a href="{{ route('rule.create') }}" class="btn btn-primary btn-lg me-2">
                    <i class="fas fa-plus-circle me-2"></i>Nouvelle règle
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
                        <input type="text" name="search" class="form-control" placeholder="Rechercher une règle..." value="{{ request('search') }}">
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

        <div class="row">
            @forelse ($rules as $rule)
                <div class=" mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title "><b>{{ $rule->code }}</b>- {{ $rule->name }}</h5>
                            <p class="card-text" id="description-{{ $rule->id }}">
                                @if (strlen($rule->description) > 200)
                                    {{ substr($rule->description, 0, 200) }}
                                    <a href="#" class="text-primary" id="see-more-{{ $rule->id }}" onclick="toggleDescription({{ $rule->id }}); return false;">Voir plus</a>
                                    <span id="full-description-{{ $rule->id }}" style="display: none;">{{ substr($rule->description, 200) }}
                                        <a href="#" class="text-primary" id="see-less-{{ $rule->id }}" onclick="toggleDescription({{ $rule->id }}); return false;">Voir moins</a>
                                    </span>
                                @else
                                    {{ $rule->description }}
                                @endif
                            </p>
                            <p class="card-text"><strong>Pays:</strong> {{ $rule->country->name ?? 'N/A' }}
                      <strong>DULs:</strong> <span class="badge bg-primary rounded-pill">{{ $rule->duls->count() }}</span>
                                <strong>DUAs:</strong> <span class="badge bg-primary rounded-pill">{{ $rule->duas->count() }}</span>
                                <strong>Actives:</strong> <span class="badge bg-primary rounded-pill">{{ $rule->actives->count() }}</span></p>
                            <div class="btn" role="group">
                                <a href="{{ route('rule.show', $rule->id) }}" class="btn btn-outline-info" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('rule.edit', $rule->id) }}" class="btn btn-outline-primary" title="Editer">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette règle ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        Aucune règle trouvée.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $rules->links() }}
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
@endpush
