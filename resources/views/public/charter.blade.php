@extends('index')

@section('content')
    <div class="container-fluid py-4">
        <!-- Fil d'Ariane -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('public.search') }}">Accueil</a>
                </li>
                @if($classification->parent)
                    <li class="breadcrumb-item">
                        <a href="{{ route('public.charter', $classification->parent->id) }}">
                            {{ $classification->parent->name }}
                        </a>
                    </li>
                @endif
                <li class="breadcrumb-item active">{{ $classification->name }}</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-0">
            <!-- En-tête de la charte -->
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">{{ $rootClassification->code }} - {{ $rootClassification->name }}</h4>
                        @if($rootClassification->description)
                            <p class="mb-0 opacity-75">{{ $rootClassification->description }}</p>
                        @endif
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('public.charter.pdf', $rootClassification->id) }}"
                           class="btn btn-light"
                           title="Télécharger en PDF">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                        <a href="{{ route('public.charter.excel', $rootClassification->id) }}"
                           class="btn btn-light"
                           title="Télécharger en Excel">
                            <i class="fas fa-file-excel"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <!-- Table hiérarchique -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                        <tr>
                            <th rowspan="2" class="align-middle">Niveau</th>
                            <th rowspan="2" class="align-middle">Code</th>
                            <th rowspan="2" class="align-middle">Intitulé</th>
                            <th rowspan="2" class="align-middle">Typologies</th>
                            <th colspan="2" class="text-center bg-success text-white">Délai actif</th>
                            <th colspan="2" class="text-center bg-info text-white">Délai semi-actif</th>
                            <th colspan="2" class="text-center bg-warning text-white">Durée légale</th>
                            <th rowspan="2" class="align-middle">Références</th>
                        </tr>
                        <tr>
                            <th class="bg-success text-white">Durée</th>
                            <th class="bg-success text-white">Déclencheur</th>
                            <th class="bg-info text-white">Durée</th>
                            <th class="bg-info text-white">Déclencheur</th>
                            <th class="bg-warning text-white">Durée</th>
                            <th class="bg-warning text-white">Déclencheur</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Parent -->
                        @include('public.charter.row', ['classification' => $rootClassification, 'level' => 0])

                        <!-- Enfants récursifs -->
                        @foreach($rootClassification->childrenRecursive as $child)
                            @include('public.charter.row', [
                                'classification' => $child,
                                'level' => $child->getLevel()
                            ])
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
