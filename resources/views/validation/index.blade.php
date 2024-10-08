@extends('index')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Règles de committee</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Statut</th>
                                <th>Validé par</th>
                                <th>Validé le</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($rules as $rule)
                                <tr>
                                    <td>{{ $rule->id }}</td>
                                    <td>{{ $rule->name }}</td>
                                    <td>
                                        @if ($rule->status_id == 1)
                                            <span class="badge badge-secondary">En attente</span>
                                        @elseif ($rule->status_id == 2)
                                            <span class="badge badge-primary">Acceptée</span>
                                        @elseif ($rule->status_id == 3)
                                            <span class="badge badge-success">Valide</span>
                                        @elseif ($rule->status_id == 3)
                                                <span class="badge badge-danger">rejeté</span>

                                        @endif

                                    </td>
                                    <td>
                                        {{ $rule->validator ? $rule->validator->name . ', ' . $rule->validator->surname : 'Non validé' }}
                                    </td>
                                    <td>{{ $rule->validated_at ? $rule->validated_at : 'Non validé' }}</td>
                                    <td>
                                        @if ($rule->status_id == 1)
                                            <form action="{{ route('committee.update', $rule->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status_id" value="2">
                                                <button type="submit" class="btn btn-success">Accepter</button>
                                            </form>
                                            <form action="{{ route('committee.update', $rule->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status_id" value="3">
                                                <button type="submit" class="btn btn-danger">Rejeter</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
