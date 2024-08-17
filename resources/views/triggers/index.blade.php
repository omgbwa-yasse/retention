<!-- resources/views/triggers/index.blade.php -->

@extends('index')

@section('content')
    <div class="container">
        <h1>Triggers</h1>
        <a href="{{ route('triggers.create') }}" class="btn btn-primary mb-3">Create Trigger</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($triggers as $trigger)
                <tr>
                    <td>{{ $trigger->code }}</td>
                    <td>{{ $trigger->name }}</td>
                    <td>{{ $trigger->description }}</td>
                    <td>
                        <a href="{{ route('triggers.show', $trigger->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('triggers.edit', $trigger->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('triggers.destroy', $trigger->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
