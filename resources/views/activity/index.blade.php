@extends('index')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-$items-center mb-4">
            <h1 class="mb-0 text-primary"><i class="bi bi-list-task me-2"></i>Activités {{ $country->name ?? ''}} </h1>
            <div>
                <a href="{{ route('activity.create') }}" class="btn btn-primary me-2">
                    <i class="bi bi-plus-circle me-2"></i>Nouvelle Activité
                </a>
                <a href="{{ route('activity.export') }}" class="btn btn-success">
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

        @foreach ( $items as $activity )
            <div class="list-group mt-4">
                <label class="list-group-item">
                    <h4 class="fw-bold mb-0">
                        <a href="{{ route('activity.show', $activity->id) }}" class="text-decoration-none" title="Voir">
                            <i class="bi bi-eye"></i> {{ $activity->code }} - {{ $activity->name }}
                        </a>
                    </h4>
                    <p>
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

                    <div class="d-flex align-$items-center">
                        <p class="me-1"><strong>Sous-classes :</strong> <span class="badge bg-secondary">{{ $activity->children?->count() ?? '0' }}</span></p>
                        <p class="me-1"><strong>Pays :</strong> <span class="badge bg-secondary"> {{ $activity->countries?->name ?? 'N/A' }}</span></p>
                        <p class="me-1"><strong>Parent :</strong> <span class="badge bg-secondary"> {{ $activity->parent->name ?? 'N/A' }} </span></p>
                    </div>
                </label>
            </div>
        @endforeach

        <nav aria-label="Page navigation mt-3">
            <ul class="pagination justify-content-center">
                {{-- Bouton Previous --}}
                <li class="page-item {{ ($items->currentPage() == 1) ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $items->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                {{-- Numéros de page --}}
                @for ($i = max(1, $items->currentPage() - 2); $i <= min($items->lastPage(), $items->currentPage() + 2); $i++)
                    <li class="page-item {{ ($items->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $items->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Bouton Next --}}
                <li class="page-item {{ ($items->currentPage() == $items->lastPage()) ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $items->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

@endsection
