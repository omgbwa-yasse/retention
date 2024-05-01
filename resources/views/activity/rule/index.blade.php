@extends('index')

@section('content')

<h1>Rules for Classification {{ $classification->name }}</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($classifications->$rules as $rule)
            <tr>
                <td>{{ $rule->name }}</td>
                <td>{{ $rule->description }}</td>
                <td>
                    <form action="{{ route('activity.rule.destroy', [$classification, $rule]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

<a href="{{ route('rule-classifications.create', $classification) }}">Add Rule</a>
