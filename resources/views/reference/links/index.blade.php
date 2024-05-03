@extends('index')

@section('content')
<div class="container">
    <h1>Links for Reference {{ $reference->name }}</h1>
    <a href="{{ route('reference.show', $reference) }}" class="btn btn-primary mb-3">Retour </a>
    <a href="{{ route('reference.link.create', $reference->id) }}" class="btn btn-primary mb-3">Create Link</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($links as $link)
            <tr>
                <td>{{ $link->name }}</td>
                <td>{{ $link->link }}</td>
                <td>
                    <a href="{{ route('reference.link.edit', [$reference->id, $link->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="{{ route('reference.link.destroy', [$reference->id, $link->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
