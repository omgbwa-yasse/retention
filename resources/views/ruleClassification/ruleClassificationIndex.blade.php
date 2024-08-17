@extends('index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0"><i class="fas fa-list"></i> Liste des Règles</h1>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="text" class="form-control mb-2" id="rule_search" placeholder="Rechercher par nom de la règle...">
                </div>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Nom de la Règle</th>
                        <th>Classifications</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rules as $rule)
                        <tr>
                            <td>{{ $rule->name }}</td>
                            <td>
                                <ul>
                                    @foreach($rule->classifications as $classification)
                                        <li>{{ $classification->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @foreach($rule->classifications as $classification)
                                    {{-- <a href="{{ route('rule.classification.edit', ['rule' => $rule->id, 'classification' => $classification->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editer</a> --}}
                                    <form action="{{ route('rule.classification.destroy', ['rule' => $rule->id, 'classification' => $classification->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Supprimer</button>
                                    </form>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('rule_search').addEventListener('input', function() {
            var input, filter, table, tr, td, i, txtValue;
            input = this;
            filter = input.value.toUpperCase();
            table = document.querySelector('table tbody');
            tr = table.getElementsByTagName('tr');

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName('td')[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        });
    </script>
@endsection
