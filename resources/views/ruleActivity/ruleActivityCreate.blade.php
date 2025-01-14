@extends('index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0"><i class="fas fa-plus-circle"></i> Créer une nouvelle relation pour {{$rule->name}}</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('rule.activity.store', $rule->id) }}" method="POST">
                    @csrf

                    <input type="hidden" name="rule_id" id="rule_id" value="{{ $rule->id }}">

                    <div class="form-group">
                        <label for="activity_id"><i class="fas fa-list-alt"></i> Classifications:</label>
                        <input type="text" class="form-control mb-2" id="activity_search" placeholder="Rechercher par nom ou code...">
                        <select class="form-control" name="activity_id" id="activity_id" required>
                            <option value="">Choisir la classe à lier à la règle</option>
                            @foreach($activities as $activity)
                                <option value="{{ $activity->id }}">{{ $activity->code }} : {{ $activity->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Créer</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('activity_search').addEventListener('input', function() {
            var input, filter, select, options, i, txtValue;
            input = this;
            filter = input.value.toUpperCase();
            select = document.getElementById('activity_id');
            options = select.getElementsByTagName('option');

            for (i = 0; i < options.length; i++) {
                txtValue = options[i].textContent || options[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    options[i].style.display = '';
                } else {
                    options[i].style.display = 'none';
                }
            }
        });
    </script>
@endsection
