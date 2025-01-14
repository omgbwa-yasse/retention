@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0"><i class="fas fa-list me-2"></i>Liste des règles de conservation</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('rule.create') }}" class="btn btn-success">
                                <i class="fas fa-plus me-2"></i>Ajouter une règle
                            </a>
                        </div>
                        <div class="mb-3">
                            <form action="{{ route('rule.index') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control me-2" placeholder="Rechercher..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>Rechercher
                                </button>
                            </form>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>Référence</th>
                                    <th>Intitulé</th>
                                    <th>Description</th>
                                    <th>Durée</th>
                                    <th>Conserver</th>
                                    <th>Sort</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rules as $rule)
                                    <tr>
                                        <td>{{ $rule->code }}</td>
                                        <td>{{ $rule->name }}</td>
                                        <td>{{ $rule->description }}</td>
                                        <td>{{ $rule->duration }}</td>
                                        <td>{{ $rule->trigger->code }} - {{ $rule->trigger->name }}</td>
                                        <td>{{ $rule->sort->code }} - {{ $rule->sort->name }}</td>
                                        <td>
                                            <a href="{{ route('rule.show', $rule->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('rule.edit', $rule->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette règle ?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $rules->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
