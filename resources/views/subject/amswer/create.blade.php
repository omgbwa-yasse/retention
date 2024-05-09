@extends('index')

@section('content')
<div class="container">
    <h1>Avis</h1>
    <h2>Question : {{ $subject->name }}</h2>
    <p class="lead"> Par : {{ $subject->user->name }} </p>

    <form action="{{ route('subject.amswer.store', $subject) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Commentaire</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
