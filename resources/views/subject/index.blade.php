@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Forum Card -->
                <div class="card shadow-sm">
                    <!-- Card Header -->
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                        <h2 class="mb-0">{{ __('Forum') }}</h2>
                        @if(auth()->check())
                            <a href="{{ route('subject.create') }}" class="btn btn-light text-primary">
                                <i class="fas fa-plus-circle me-2"></i>Nouveau Sujet
                            </a>
                        @endif
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Subjects List -->
                        @forelse ($subjects as $subject)
                            <div class="card mb-3 border-0">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="{{ route('subject.show', $subject->id) }}" class="text-decoration-none text-primary">{{ $subject->name }}</a>
                                    </h3>
                                    <p class="card-text text-muted mb-2">
                                        <small>
                                            <i class="fas fa-user me-2"></i>Créé par: {{ $subject->user->name }}
                                        </small>
                                    </p>
                                    <p class="card-text">{{ $subject->description }}</p>
                                    <p class="card-text text-muted">
                                        <small>
                                            <i class="fas fa-clock me-2"></i>Dernière Publication:
                                            @if($subject->latestPost)
                                                {{ $subject->latestPost->created_at->diffForHumans() }}
                                            @else
                                                Pas encore de Publication !
                                            @endif
                                        </small>
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">Aucun sujet disponible.</p>
                        @endforelse

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{-- {{ $subjects->links() }} --}}
                            links
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
