@extends('index')

@section('content')
    <h1>List of Typologies</h1>
    <a href="{{ route('typology.create') }}" class="btn btn-primary">Create Typology</a>
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
            @foreach ($typology as $items)
                <tr>
                    <td>{{ $items->title }}</td>
                    <td>{{ $items->description }}</td>
                    <td>{{ $items->category ? $items->category->title : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('typology.show', $items->id) }}" class="btn btn-sm btn-primary">Show</a>
                        <a href="{{ route('typology.edit', $items->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('typology.destroy', $items->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $typology->links() }}
@endsection
