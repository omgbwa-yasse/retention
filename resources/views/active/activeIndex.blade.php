@extends('index')

@section('content')
<h1>Actives</h1>

<a href="{{ route('active.create') }}" class="btn btn-primary mb-3">Create Active</a>

<table class="table">
    <thead>
        <tr>
            <th>Duration</th>
            <th>Description</th>
            <th>Rule</th>
            <th>Trigger</th>
            <th>Sort</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($actives as $active)
            <tr>
                <td>{{ $active->duration }}</td>
                <td>{{ $active->description }}</td>
                <td>{{ $active->rule->name }}</td>
                <td>{{ $active->trigger->code }}</td>
                <td>{{ $active->sort->name }}</td>
                <td>
                    <a href="{{ route('active.edit', $active->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('active.destroy', $active->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
