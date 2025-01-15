@extends('index')
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

        const selectWithSearchElements = document.querySelectorAll('.select-with-search');

        selectWithSearchElements.forEach(selectWithSearch => {
            const searchInput = selectWithSearch.querySelector('.search-input');
            const select = selectWithSearch.querySelector('select');
            const options = Array.from(select.options).slice(1); // Exclude the first option

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                options.forEach(option => {
                    const optionText = option.textContent.toLowerCase();
                    if (optionText.includes(searchTerm)) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                });

                // Reset selection and show placeholder option
                select.selectedIndex = 0;
                select.options[0].style.display = '';

                // If no visible options, show a "No results" option
                const visibleOptions = options.filter(option => option.style.display !== 'none');
                if (visibleOptions.length === 0) {
                    const noResultsOption = select.querySelector('option[data-no-results]');
                    if (!noResultsOption) {
                        const newNoResultsOption = document.createElement('option');
                        newNoResultsOption.textContent = 'No results found';
                        newNoResultsOption.disabled = true;
                        newNoResultsOption.setAttribute('data-no-results', 'true');
                        select.appendChild(newNoResultsOption);
                    } else {
                        noResultsOption.style.display = '';
                    }
                } else {
                    const noResultsOption = select.querySelector('option[data-no-results]');
                    if (noResultsOption) {
                        noResultsOption.style.display = 'none';
                    }
                }
            });

            // Clear search input when select changes
            select.addEventListener('change', function() {
                searchInput.value = '';
                options.forEach(option => option.style.display = '');
                const noResultsOption = select.querySelector('option[data-no-results]');
                if (noResultsOption) {
                    noResultsOption.style.display = 'none';
                }
            });
        });
    });
</script>
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="">
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
                                <div class="select-with-search">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control search-input" placeholder="Search parent...">
                                    </div>
                                    <select name="parent_id" id="parent_id" class="form-select" required>
                                        <option value="" disabled selected>Sélectionner un parent</option>
                                        @foreach ($activities->groupBy('parent_id') as $parentId => $groupedActivities)
                                            <optgroup label="Parent ID: {{ $parentId }}">
                                                @foreach ($groupedActivities as $activity)
                                                    <option value="{{ $activity->id }}">{{ $activity->code }} - {{ $activity->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
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

@endpush

<style>
    .select-with-search {
        position: relative;
    }
    .select-with-search .search-input {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }
    .select-with-search .form-select {
        border-color: #ced4da;
    }
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #ced4da;
    }
    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }
</style>
