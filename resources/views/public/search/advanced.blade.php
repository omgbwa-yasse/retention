@extends('index')

@section('content')
<div class="container-fluid py-4">
    <!-- Formulaire de recherche -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('public.search.advanced') }}" method="GET" class="row g-3">
                <!-- Terme de recherche -->
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="term" name="term"
                               value="{{ request('term') }}" placeholder="Rechercher...">
                        <label for="term">Terme de recherche</label>
                    </div>
                </div>

                <!-- Type de recherche -->
                <div class="col-md-2">
                    <div class="form-floating">
                        <select class="form-select" id="type" name="type">
                            <option value="">Tous les types</option>
                            <option value="rule" {{ request('type') == 'rule' ? 'selected' : '' }}>Règles</option>
                            <option value="class" {{ request('type') == 'class' ? 'selected' : '' }}>Classifications</option>
                            <option value="reference" {{ request('type') == 'reference' ? 'selected' : '' }}>Références</option>
                        </select>
                        <label for="type">Type</label>
                    </div>
                </div>

                <!-- Pays -->
                <div class="col-md-2">
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

                <!-- Mode de date -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">

                            <!-- Mode date exacte -->
                            <div class="mb-3">
                                <label for="date" class="form-label">Date exacte</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" id="date" name="date" value="{{ request('date') }}">
                                    <select class="form-select" name="date_operator" style="max-width: 80px;">
                                        <option value="=" {{ request('date_operator') == '=' ? 'selected' : '' }}>=</option>
                                        <option value=">" {{ request('date_operator') == '>' ? 'selected' : '' }}>&gt;</option>
                                        <option value=">=" {{ request('date_operator') == '>=' ? 'selected' : '' }}>&gt;=</option>
                                        <option value="<" {{ request('date_operator') == '<' ? 'selected' : '' }}>&lt;</option>
                                        <option value="<=" {{ request('date_operator') == '<=' ? 'selected' : '' }}>&lt;=</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Mode période -->
                            <div>
                                <label class="form-label">Période</label>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" id="date_from" name="date_from"
                                               value="{{ request('date_from') }}" placeholder="Date début">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" id="date_to" name="date_to"
                                               value="{{ request('date_to') }}" placeholder="Date fin">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bouton de recherche -->
                <div class="col-md-1 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
