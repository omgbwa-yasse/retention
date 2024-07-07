@extends('index')

@section('content')
    <div class="container">
        <h1 class="mb-4">Missions - {{ $country->name }} ({{ $country->abbr }})</h1>

        <div class="row mb-4">
            <div class="col-md-6">
                <a href="{{ route('mission.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Ajouter un domaine
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('mission.export') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-pdf"></i> Exporter en PDF
                </a>
            </div>
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

        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach ($items as $item)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if ($item->children->isNotEmpty())
                                        <a class="toggle-subclass collapsed me-2" data-bs-toggle="collapse" href="#{{ $item->code }}" role="button" aria-expanded="false" aria-controls="{{ $item->code }}">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    @endif
                                    <span class="fw-bold">{{ $item->code }}</span>: {{ $item->name }}
                                </div>
                                <a href="{{ route('mission.show', $item) }}" class="btn btn-sm btn-outline-primary">Voir</a>
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
@endsection
