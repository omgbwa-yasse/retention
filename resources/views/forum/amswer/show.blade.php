@extends('index')

@section('content')
<div class="container">
    <h1>{{ $answer->name }}</h1>
    <p>{{ $answer->body }}</p>
    <p>Posted by: {{ $answer->user->name }}</p>
    <p>In subject: {{ $answer->subject->name }}</p>
    <a href="{{ route('answers.edit', $answer->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('answers.destroy', $answer->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
@endsection
