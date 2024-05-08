@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $subject->name }}</div>

                <div class="card-body">
                    <p>Description: {{ $subject->description }}</p>
                    <p>Created by: {{ $subject->user->name }}</p>
                    <p>Classes:</p>
                    <ul>
                        @foreach($subject->classes as $class)
                            <li>{{ $class->code }} : {{ $class->name }}</li>
                        @endforeach
                    </ul>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('forum.subject.edit', $subject) }}" class="btn btn-primary me-2">Update</a>
                        <form action="{{ route('forum.subject.destroy', $subject) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('forum.subject.index') }}" class="btn btn-secondary">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <a href="{{ route('forum.amswer.create', $subject->id) }}" class="btn btn-secondary">Ajouter commentaire</a>
</div>
<div class="col-md-12">

</div>



@endsection
