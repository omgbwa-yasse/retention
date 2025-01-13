@extends('index')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <!-- En-tête principal -->
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="display-6 mb-2">{{ $rule->name }}</h1>
                        <p class="text-muted mb-0">Code: {{ $rule->code }}</p>
                    </div>
                    <div class="text-end">
                    <span class="badge bg-{{ $rule->status->name === 'Active' ? 'success' : 'secondary' }} mb-2">
                        {{ $rule->status->name }}
                    </span>
                        <div class="text-muted small">
                            Pays: {{ $rule->country->name }}
                        </div>
                    </div>
                </div>

                <!-- Informations de validation -->
                <div class="bg-light p-3 rounded mb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-muted small mb-2">Validation</h6>
                            @if($rule->validated_at && $rule->validator)
                            <table class="table table-sm">
                                <tr>
                                    <th class="ps-0 border-0">Validé par:</th>
                                    <td class="border-0">{{ $rule->validator->name }}</td>
                                </tr>
                                <tr>
                                    <th class="ps-0 border-0">Date de validation:</th>
                                    <td class="border-0">{{ $rule->validated_at }}</td>
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">Description</h6>
                    <div class="border rounded p-3">
                        {{ $rule->description }}
                    </div>
                </div>

                <!-- Classifications -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">Classifications</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>Nom de la classification</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($rule->classifications as $classification)
                                <tr>
                                    <td>{{ $classification->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted">Aucune classification</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Duls -->
                <div>
                    <h6 class="text-uppercase text-muted small mb-2">Duls associés</h6>
                    @forelse($rule->duls as $dul)
                        <div class="border rounded mb-3">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th colspan="2" class="border-bottom">
                                            {{ $dul->name }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th class="w-25 bg-light">Trigger</th>
                                        <td>{{ $dul->trigger->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25 bg-light">Sort</th>
                                        <td>{{ $dul->sort->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25 bg-light">Articles</th>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach($dul->articles as $article)
                                                    <span class="badge bg-light text-dark">
                                                        {{ $article->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @empty
                        <div class="text-muted">Aucun Dul associé</div>
                    @endforelse
                </div>
            </div>

            <!-- Pied de page -->
            <div class="card-footer bg-light text-muted small p-3">
                <div class="d-flex justify-content-between">
                    <span>Code: {{ $rule->code }}</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table {
            margin-bottom: 0;
        }
        .table > :not(caption) > * > * {
            padding: 0.5rem;
        }
        .badge {
            font-weight: normal;
        }
        .table-sm > :not(caption) > * > * {
            padding: 0.5rem;
        }
    </style>
@endsection
