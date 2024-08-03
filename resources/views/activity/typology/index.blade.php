@extends('index')

@section('content')
<h1>Typologies for {{ $activity->name }}</h1>

<p>
    <a href="{{ route('activity.typology.create', $activity) }}" class="btn btn-primary">Create Typology</a>
</p>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($activity->typologies as $typology)
            <tr>
                <td>{{ $typology->name }}</td>
                <td>{{ $typology->description }}</td>
                <td>{{ $typology->category->name }}</td>
                <td>

                    <a href="{{ route('activity.show', $activity->id) }}" class="btn btn-outline-info btn-sm" title="Voir">
                        Retour
                    </a>
                    <a href="{{ route('activity.typology.edit', [$activity, $typology]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('activity.typology.destroy', [$activity, $typology]) }}" method="POST" style="display: inline;">
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
