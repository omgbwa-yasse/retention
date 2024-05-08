@extends('index')

@section('content')
<div class="container">
    <h1>Answers</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>User</th>
                <th>Subject</th>
                <th>Created At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($amswer as $answer)
                <tr>
                    <td>{{ $answer->name }}</td>
                    <td>{{ $answer->user->name }}</td>
                    <td>{{ $answer->subject->name }}</td>
                    <td>{{ $answer->created_at }}</td>
                    <td>
                        <a href="{{ route('answers.show', $answer->id) }}" class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('answers.edit', $answer->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('answers.destroy', $answer->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
