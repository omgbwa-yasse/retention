@extends('index')

@section('content')
    <div class="container-fluid py-4">
        <!-- Formulaire de recherche -->
        <div class="container-fluid py-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form action="{{ route('public.search.advanced.results') }}" method="GET">
                        <!-- Première ligne : Terme de recherche -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="term" name="term"
                                           value="{{ request('term') }}" placeholder="Rechercher...">
                                    <label for="term">Terme de recherche</label>
                                </div>
                            </div>
                        </div>

                        <!-- Deuxième ligne : Typologie, Pays, Dates -->
                        <div class="row mb-3">
                            <!-- Type de recherche -->
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <select class="form-select" id="type" name="type">
                                        <option value="">Tous les types</option>
                                        <option value="rule" {{ request('type') == 'rule' ? 'selected' : '' }}>Règles</option>
                                        <option value="class" {{ request('type') == 'class' ? 'selected' : '' }}>Classifications</option>
                                        <option value="reference" {{ request('type') == 'reference' ? 'selected' : '' }}>Références</option>
                                    </select>
                                    <label for="type">Typologie</label>
                                </div>
                            </div>

                            <!-- Pays -->
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <select class="form-select" id="countries" name="countries[]" multiple>
                                        @foreach($countries as $code => $name)
                                            <option value="{{ $code }}" {{ in_array($code, (array)request('countries')) ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="countries">Pays</label>
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="col-md-6">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="date_from" name="date_from"
                                                   value="{{ request('date_from') }}">
                                            <label for="date_from">Date début</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="date_to" name="date_to"
                                                   value="{{ request('date_to') }}">
                                            <label for="date_to">Date fin</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Troisième ligne : Bouton de recherche -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-search"></i> Rechercher
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        <!-- Résultats de recherche -->
        @if(isset($records) && $records->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Résultats de recherche ({{ $records->count() }} trouvés)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Pays</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td>
                                        @switch($record['type'])
                                            @case('rule')
                                                <span class="badge bg-primary">Règle</span>
                                                @break
                                            @case('class')
                                                <span class="badge bg-success">Classification</span>
                                                @break
                                            @case('reference')
                                                <span class="badge bg-info">Référence</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>{{ $record['name'] }}</td>
                                    <td>{{ Str::limit($record['description'], 100) }}</td>
                                    <td>{{ $record['country'] ?? 'N/A' }}</td>
                                    <td>{{ $record['created_at'] ? date('d/m/Y', strtotime($record['created_at'])) : 'N/A' }}</td>
                                    <td>
                                        @switch($record['type'])
                                            @case('rule')
                                                <a href="{{ route('public.rules.show', $record['id']) }}" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-eye"></i> Voir
                                                </a>
                                                @break
                                            @case('class')
                                                <a href="{{ route('public.classes.show', $record['id']) }}" class="btn btn-sm btn-success">
                                                    <i class="bi bi-eye"></i> Voir
                                                </a>
                                                @break
                                            @case('reference')
                                                <a href="{{ route('public.references.show', $record['id']) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i> Voir
                                                </a>
                                                @break
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @elseif(request()->has('term'))
            <div class="alert alert-info">
                Aucun résultat trouvé pour votre recherche.
            </div>
        @endif
    </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Gestion de l'interaction entre les champs de date
                const dateExact = document.getElementById('date');
                const dateFrom = document.getElementById('date_from');
                const dateTo = document.getElementById('date_to');

                function toggleDateFields() {
                    const isDateExactFilled = dateExact.value !== '';
                    dateFrom.disabled = isDateExactFilled;
                    dateTo.disabled = isDateExactFilled;

                    if (isDateExactFilled) {
                        dateFrom.value = '';
                        dateTo.value = '';
                    }
                }

                dateExact.addEventListener('change', toggleDateFields);
                toggleDateFields();
            });
        </script>

@endsection
