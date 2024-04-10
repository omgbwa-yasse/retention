@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Créer une nouvelle Mission</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('activity.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="cote">Cote</label>
                            <input type="text" class="form-control" id="cote" name="cote" required>
                        </div>

                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                        <select name="parent_id">
                            @foreach ($activities->groupBy('parent_id') as $parentId => $groupedActivities)
                                <optgroup label="Parent ID: {{ $parentId }}">
                                    @foreach ($groupedActivities as $activity)
                                        <option value="{{ $activity->id }}">{{ $activity->name }}</option>
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
    </div>
</div>
@endsection
