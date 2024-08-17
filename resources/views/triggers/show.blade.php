<!-- resources/views/triggers/show.blade.php -->

@extends('index')

@section('content')
    <div class="container">
        <h1>Trigger Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $trigger->name }}</h5>
                <p class="card-text"><strong>Code:</strong> {{ $trigger->code }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $trigger->description }}</p>
            </div>
        </div>

        <a href="{{ route('triggers.index') }}" class="btn btn-primary mt-3">Back to List</a>
    </div>
@endsection
