@extends('index')

@section('content')
<div class="container">
    <h1>{{ $link->name }}</h1>

    <p>
        <strong>Link:</strong> <a href="{{ $link->link }}" target="_blank">{{ $link->link }}</a>
    </p>

    <a href="{{ route('reference.link.edit', [$reference->id, $link->id]) }}" class="btn btn-primary">Edit</a>

    <form action="{{ route('reference.link.destroy', [$reference->id, $link->id]) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>

    <a href="{{ route('reference.show', $reference->id) }}" class="btn btn-secondary">Back to Reference</a>
</div>
@endsection
