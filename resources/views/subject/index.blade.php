@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="">
                <div class="card shadow-lg border-0 rounded-3">
                    <!-- En-tête amélioré -->
                    <div class="card-header bg-primary p-4 rounded-top">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-comments text-white me-3 fa-2x"></i>
                                <h2 class="mb-0 text-white">{{ __('Forum') }}</h2>
                            </div>
                            @if(auth()->check())
                                <a href="{{ route('subject.create') }}"
                                   class="btn btn-light btn-lg d-flex align-items-center">
                                    <i class="fas fa-plus-circle me-2"></i>
                                    Nouveau Sujet
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Alert de statut -->
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('status') }}
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Liste des sujets -->
                        <div class="subjects-list">
                            @forelse ($subjects as $subject)
                                <div class="card mb-4 border-0 shadow-sm hover-card rounded-3">
                                    <div class="card-body p-4">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h3 class="card-title h4 mb-3">
                                                    <a href="{{ route('subject.show', $subject->id) }}"
                                                       class="text-decoration-none text-primary d-flex align-items-center">
                                                        <i class="fas fa-book me-2"></i>
                                                        {{ $subject->name }}
                                                    </a>
                                                </h3>
                                                <p class="card-text mb-3">{{ $subject->description }}</p>
                                                <div class="d-flex align-items-center text-muted">
                                                    <div class="d-flex align-items-center me-4">
                                                        <div class="avatar-circle bg-primary text-white me-2">
                                                            {{ strtoupper(substr($subject->user->name, 0, 1)) }}
                                                        </div>
                                                        <span>{{ $subject->user->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="d-flex flex-column align-items-end justify-content-between h-100">
                                                    <div class="text-end">
                                                    <span class="badge bg-primary mb-2">
                                                        <i class="fas fa-comments me-1"></i>
                                                        {{ $subject->posts_count ?? 0 }} messages
                                                    </span>
                                                    </div>
                                                    <div class="text-muted small text-end">
                                                        <i class="fas fa-clock me-1"></i>
                                                        @if($subject->latestPost)
                                                            Dernière activité {{ $subject->latestPost->created_at->diffForHumans() }}
                                                        @else
                                                            Pas encore de publication
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="fas fa-comments fa-3x text-muted"></i>
                                    </div>
                                    <h3 class="h5 text-muted">Aucun sujet disponible</h3>
                                    @if(auth()->check())
                                        <p class="mb-3">Soyez le premier à créer un sujet !</p>
                                        <a href="{{ route('subject.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus-circle me-2"></i>Créer un sujet
                                        </a>
                                    @endif
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination améliorée -->
                        <div class="d-flex justify-content-center mt-4">
                            <div class="shadow-sm rounded">
                                {{ $subjects->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }

        .avatar-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .subjects-list {
            max-height: 800px;
            overflow-y: auto;
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.5em 0.8em;
        }

        /* Style personnalisé pour la pagination */
        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            padding: 0.75rem 1rem;
            border: none;
            color: #333;
        }

        .page-item.active .page-link {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }
    </style>
@endsection
