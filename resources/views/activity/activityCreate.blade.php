@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <h2>Ajouter une activité</h2>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('activity.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="country_id" value="{{ $auth->country_id }}">

                        <div class="form-group">
                            <label for="code">Cote</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>

                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                            <small id="character-count"></small>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var description = document.getElementById('description');
                                var characterCount = document.getElementById('character-count');
                                var maxLength = 500;

                                description.addEventListener('input', function() {
                                    var remainingChars = maxLength - this.value.length;
                                    characterCount.textContent = remainingChars + ' characters remaining';
                                    if (remainingChars <= 0) {
                                        characterCount.style.color = 'red';
                                    } else {
                                        characterCount.style.color = '';
                                    }
                                });
                            });
                        </script>

                        <div class="form-group">
                        <select name="parent_id">
                            @foreach ($activities->groupBy('parent_id') as $parentId => $groupedActivities)
                                <optgroup label="Parent ID: {{ $parentId }}">
                                    @foreach ($groupedActivities as $activity)
                                        <option value="{{ $activity->id }}">{{ $activity->code }} - {{ $activity->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
        </div>
    </div>
</div>
@endsection
