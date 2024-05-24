@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
                <h1>{{ $subject->name }}</h1>
                    <p class="mb-1">Description: {{ $subject->description }}</p>
                    <p class="mb-1">Created by: {{ $subject->user->name }}</p>
                    <p class="mb-1">Domaine :

                        @foreach($subject->classes as $class)
                            {{ $class->code }} : {{ $class->name }}
                        @endforeach
                    </p>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('subject.edit', $subject) }}" class="btn btn-primary me-2">Update</a>
                        <form action="{{ route('subject.destroy', $subject) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('subject.index') }}" class="btn btn-secondary">Retour</a>
                    </div>
    </div>
</div>
<div class="col-md-12">
    <a href="{{ route('subject.post.create', $subject) }}" class="btn btn-secondary">Ajouter commentaire</a>
</div>
<div class="col-md-12">
    <div class="list-group">
    @if($subject->posts)
        @foreach($subject->posts as $post)

                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start" aria-current="true" >
                    <div class="d-flex w-100 justify-content-between">
                        <small class="mb-2" >{{ $amswer->name  }}</small>
                    </div>
                    <p class="text-muted ">{{ $amswer->user->name  }}</p>
                </a>
        @endforeach
    @endif
    </div>
</div>



@endsection
