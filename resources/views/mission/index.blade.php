@extends('index')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0 text-primary"><i class="bi bi-list-task me-2"></i>Missions</h1>
            <div>
                <a href="{{ route('mission.create') }}" class="btn btn-primary me-2">
                    <i class="bi bi-plus-circle me-2"></i>Nouvelle Mission
                </a>
                <a href="{{ route('mission.export') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-arrow-down me-2"></i>Exporter en PDF
                </a>
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

        @foreach ( $activities as $mission )
            <div class="list-group mt-4">
                <label class="list-group-item">
                    <h4 class="fw-bold mb-0">
                        <a href="{{ route('mission.show', $mission->id) }}" class="text-decoration-none" title="Voir">
                            <i class="bi bi-eye"></i> {{ $mission->code }} - {{ $mission->name }}
                        </a>
                    </h4>
                    <p>
                        @if (strlen($mission->description) > 100)
                            {{ substr($mission->description, 0, 100) }}
                            <a href="#" class="text-primary" id="see-more-{{ $mission->id }}" onclick="toggleDescription({{ $mission->id }}); return false;">Voir plus</a>
                            <span id="full-description-{{ $mission->id }}" style="display: none;">{{ substr($mission->description, 100) }}
                                <a href="#" class="text-primary" id="see-less-{{ $mission->id }}" onclick="toggleDescription({{ $mission->id }}); return false;">Voir moins</a>
                            </span>
                        @else
                            {{ $mission->description }}
                        @endif
                    </p>

                    <div class="d-flex align-items-center">
                        <p class="me-1"><strong>Sous-classes:</strong> <span class="badge bg-secondary">{{ $mission->children?->count() ?? '0' }}</span></p>
                        <p class="me-1"><strong>Pays:</strong> <span class="badge bg-secondary"> {{ $mission->countries?->name ?? 'N/A' }}</span></p>
                    </div>
                </label>
            </div>
        @endforeach

        <div class="mt-4 d-flex justify-content-center">
            {{ $activities->links() }}
        </div>
    </div>
@endsection
