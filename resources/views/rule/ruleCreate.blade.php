@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Créer une nouvelle règle</h2>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('rule.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="code">code</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('name') }}" required>
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Titre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="country_id">Etat</label>
                            <select class="form-control @error('country_id') is-invalid @enderror" id="country_id" name="country_id" required>
                                <option value="">Sélectionnez un état</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}> {{ $country->name }} </option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Rule</div>

                <div class="card-body">
                    <form action="{{ route('rule.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" id="code" value="{{ old('code') }}" required maxlength="10">
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" required maxlength="100">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="state_id">State</label>
                            <select class="form-control @error('state_id') is-invalid @enderror" name="state_id" id="state_id" required>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                @endforeach
                            </select>
                            @error('state_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select class="form-control @error('country_id') is-invalid @enderror" name="country_id" id="country_id" required>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <h3>Actives</h3>
                        <div class="form-group">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Duration</th>
                                        <th>Description</th>
                                        <th>Trigger</th>
                                        <th>Sort</th>
                                        <th>Country</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="actives-table">
                                    @foreach (old('actives', []) as $index => $active)
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="actives[{{ $index }}][duration]" value="{{ $active['duration'] ?? '' }}">
                                            </td>
                                            <td>
                                                <textarea class="form-control" name="actives[{{ $index }}][description]">{{ $active['description'] ?? '' }}</textarea>
                                            </td>
                                            <td>
                                                <select class="form-control" name="actives[{{ $index }}][trigger_id]">
                                                    @foreach ($triggers as $trigger)
                                                        <option value="{{ $trigger->id }}" {{ $active['trigger_id'] == $trigger->id ? 'selected' : '' }}>{{ $trigger->code }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="actives[{{ $index }}][sort_id]">
                                                    @foreach ($sorts as $sort)
                                                        <option value="{{ $sort->id }}" {{ $active['sort_id'] == $sort->id ? 'selected' : '' }}>{{ $sort->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="actives[{{ $index }}][country_id]">
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}" {{ $active['country_id'] == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary" id="add-active-row">Add Active</button>

                        <h3>Duas</h3>
                        <!-- Repeat the same structure as above for Duas -->

                        <h3>Duls</h3>
                        <!-- Repeat the same structure as above for Duls -->

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Create</button>
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
    $(function() {
        // Add event listener for adding new active row
        $('#add-active-row').click(function() {
            addRow('actives-table', 'active');
        });

        // Add event listener for removing active row
        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
        });
    });

    function addRow(tableId, rowType) {
        let table = $('#' + tableId);
        let rowCount = table.find('tbody tr').length;
        let row = `
            <tr>
                <td>
                    <input type="text" class="form-control" name="${rowType}s[${rowCount}][duration]">
                </td>
                <td>
                    <textarea class="form-control" name="${rowType}s[${rowCount}][description]"></textarea>
                </td>
                <td>
                    <select class="form-control" name="${rowType}s[${rowCount}][trigger_id]">
                        @foreach ($triggers as $trigger)
                            <option value="{{ $trigger->id }}">{{ $trigger->code }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-control" name="${rowType}s[${rowCount}][sort_id]">
                        @foreach ($sorts as $sort)
                            <option value="{{ $sort->id }}">{{ $sort->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-control" name="${rowType}s[${rowCount}][country_id]">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                </td>
            </tr>
        `;
        table.find('tbody').append(row);
    }
</script>
@endpush

@endsection
