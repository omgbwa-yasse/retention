<!-- index.blade.php -->

@extends('index')

@section('content')
    <div class="container">
        <h1>Domaine d'activité</h1>
        <a href="{{ route('mission.create') }}" class="btn btn-primary mb-2">Create New Item</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Cote</th>
                    <th scope="col">Title</th>
                    <th scope="col">Decription</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->name }} ({{ $item->children->count() }} enfants)</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <a href="{{ route('mission.show', $item->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('mission.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('mission.destroy', $item->id) }}" method="POST"
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
