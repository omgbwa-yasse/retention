@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Ajouter une activité</h2>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('activity.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="country_id" value="{{ $auth->country_id }}">

                            <div class="mb-3">
                                <label for="code" class="form-label">Cote</label>
                                <input type="text" class="form-control" id="code" name="code" required>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Titre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                <small id="character-count" class="form-text text-muted"></small>
                            </div>

                            <div class="mb-3">
                                <label for="parent_id" class="form-label">Parent</label>
                                <select name="parent_id" id="parent_id" class="form-select" required>
                                    <option value="">Sélectionner un parent</option>
                                    @foreach ($activities->groupBy('parent_id') as $parentId => $groupedActivities)
                                        <optgroup label="Parent ID: {{ $parentId }}">
                                            @foreach ($groupedActivities as $activity)
                                                <option value="{{ $activity->id }}">{{ $activity->code }} - {{ $activity->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Créer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var description = document.getElementById('description');
            var characterCount = document.getElementById('character-count');
            var maxLength = 500;

            function updateCharacterCount() {
                var remainingChars = maxLength - description.value.length;
                characterCount.textContent = remainingChars + ' caractères restants';
                characterCount.classList.toggle('text-danger', remainingChars <= 0);
            }

            description.addEventListener('input', updateCharacterCount);
            updateCharacterCount(); // Initial call
        });
    </script>
@endpush
