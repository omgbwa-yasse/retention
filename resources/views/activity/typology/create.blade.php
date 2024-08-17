@extends('index')

@section('content')
    <h1>Créer une typologie pour l'activité "{{ $activity->name }}"</h1>

    <form action="{{ route('activity.typology.store', $activity) }}" method="POST" id="typology-form">
        @csrf
        <div class="form-group">
            <label for="typology_id">Typologie associée</label>
            <select name="typology_id" class="form-control" id="typology-select">
                <option value="">Sélectionner une typologie</option>
                @foreach ($typologies as $typology)
                    <option value="{{ $typology->id }}">{{ $typology->name }}</option>
                @endforeach
            </select>
        </div>

        <div id="added-typologies"></div>

        <button type="button" class="btn btn-secondary" id="add-typology">Ajouter une typologie</button>

        <button type="submit" class="btn btn-primary">Associer une typologie</button>
    </form>

    <script>
        document.getElementById('add-typology').addEventListener('click', function() {
            const select = document.getElementById('typology-select');
            const selectedOption = select.options[select.selectedIndex];
            const addedTypologies = document.getElementById('added-typologies');

            if (selectedOption.value!== '') {
                const newOption = document.createElement('option');
                newOption.value = selectedOption.value;
                newOption.textContent = selectedOption.textContent;

                const newSelect = document.createElement('select');
                newSelect.name = 'typology_ids[]';
                newSelect.className = 'form-control';
                newSelect.appendChild(newOption);

                addedTypologies.appendChild(newSelect);

                select.removeChild(selectedOption);
                select.selectedIndex = 0;
            }
        });
    </script>
@endsection
