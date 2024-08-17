@extends('index')
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre pour les cartes */
        transition: transform 0.3s; /* Transition pour les effets de survol */
        margin-bottom: 20px;
    }
    .card:hover {
        transform: translateY(-5px); /* Effet de survol */
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
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre pour les alertes */
    }
    .btn-primary, .btn-success, .btn-outline-primary, .btn-outline-info, .btn-outline-danger {
        border-radius: 5px;
    }
    .btn-primary:hover, .btn-success:hover, .btn-outline-primary:hover, .btn-outline-info:hover, .btn-outline-danger:hover {
        transform: translateY(-2px); /* Effet de survol pour les boutons */
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

        @forelse ($activities as $activity)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title fw-bold">{{ $activity->code }}</h5>
                            <h5 class="card-title">{{ $activity->name }}</h5>
                            <p class="card-text" id="description-{{ $activity->id }}">
                                @if (strlen($activity->description) > 100)
                                    {{ substr($activity->description, 0, 100) }}
                                    <a href="#" class="text-primary" id="see-more-{{ $activity->id }}" onclick="toggleDescription({{ $activity->id }}); return false;">Voir plus</a>
                                    <span id="full-description-{{ $activity->id }}" style="display: none;">{{ substr($activity->description, 100) }}
                                        <a href="#" class="text-primary" id="see-less-{{ $activity->id }}" onclick="toggleDescription({{ $activity->id }}); return false;">Voir moins</a>
                                    </span>
                                @else
                                    {{ $activity->description }}
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="card-text"><strong>Parent:</strong> {{ $activity->parent ? $activity->parent->name : 'N/A' }}</p>
                            <p class="card-text"><strong>Sous-classes:</strong> <span class="badge bg-info">{{ $activity->children ? $activity->children->count() : '0' }}</span></p>
                            <p class="card-text"><strong>Pays:</strong> {{ $activity->countries->name ?? 'N/A' }}</p>
                            <div class="btn" role="group">
                                <a href="{{ route('activity.show', $activity->id) }}" class="btn btn-outline-secondary btn-sm" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('activity.edit', $activity->id) }}" class="btn btn-outline-primary btn-sm" title="Editer">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('activity.destroy', $activity->id) }}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette activité ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info" role="alert">
                Aucune activité trouvée
            </div>
        @endforelse

        <div class="mt-4 d-flex justify-content-center">
            {{ $activities->links() }}
        </div>
    </div>
@endsection

