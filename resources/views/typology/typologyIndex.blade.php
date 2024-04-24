@extends('index')

@section('content')
    <h1>Typologies documentaires</h1>
    <a href="{{ route('typology.create') }}" class="btn btn-primary">Create Typology</a>

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
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($typologies as $typology)
                <tr>
                    <td>{{ $typology->name }}</td>
                    <td>{{ $typology->description }}</td>
                    <td>{{ $typology->category ? $typology->category->name : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('typology.show', $typology->id) }}" class="btn btn-sm btn-primary">Show</a>
                        <a href="{{ route('typology.edit', $typology->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('typology.destroy', $typology->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
