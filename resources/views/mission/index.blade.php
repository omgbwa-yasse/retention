@extends('index')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4 align-items-center">
            <div class="col-lg-6">
                <h1 class="h2 mb-0">Missions - {{ $country->name }} ({{ $country->abbr }})</h1>
            </div>
            <div class="col-lg-6">
                <div class="d-flex justify-content-lg-end">
                    <a href="{{ route('mission.create') }}" class="btn btn-primary me-2">
                        <i class="bi bi-plus-circle"></i> Ajouter un domaine
                    </a>
                    <a href="{{ route('mission.export') }}" class="btn btn-success">
                        <i class="bi bi-file-earmark-pdf"></i> Exporter en PDF
                    </a>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher...">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach ($items as $item)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    @if ($item->children->isNotEmpty())
                                        <a class="toggle-subclass collapsed me-2" data-bs-toggle="collapse" href="#{{ $item->code }}" role="button" aria-expanded="false" aria-controls="{{ $item->code }}">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    @endif
                                    <span class="fw-bold">{{ $item->code }}</span>: {{ $item->name }}
                                </div>
                                <a href="{{ route('mission.show', $item) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                            </div>
                            @if ($item->children->isNotEmpty())
                                <div class="collapse mt-2" id="{{ $item->code }}">
                                    @include('mission.subclasses', ['subclasses' => $item->children])
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.toggle-subclass');
            toggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    this.querySelector('i').classList.toggle('bi-chevron-right');
                    this.querySelector('i').classList.toggle('bi-chevron-down');
                });
            });
        });
    </script>
@endpush
