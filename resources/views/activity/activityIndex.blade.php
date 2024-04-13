@extends('index')

@section('content')
    <div class="container">
        <h1>Activités</h1>
        <a href="{{ route('activity.create') }}" class="btn btn-primary mb-2">Create New Item</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cote</th>
                    <th scope="col">Title</th>
                    <th scope="col">parent_id</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                    <tr>
                        <th scope="row">{{ $activity->id }}</th>
                        <td>{{ $activity->cote }}</td>
                        <td>{{ $activity->name }}</td>
                        <td> @if ($activity->parent) {{ $activity->parent->name }} @endif </td>
                        <td>
                            <a href="{{ route('activity.show', $activity->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('activity.edit', $activity->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('activity.destroy', $activity->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
