<!-- resources/views/public/classes/show.blade.php -->

@extends('index')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{ $class->name }}</h1>
        </div>
        <div class="card-body">
            <p><strong>Code:</strong> {{ $class->code }}</p>
            <p><strong>Description:</strong> {{ $class->description }}</p>
            <p><strong>Country:</strong> {{ $class->country->name }}</p>
            <p><strong>Parent:</strong> {{ $class->parent ? $class->parent->name : 'None' }}</p>
            <p><strong>User:</strong> {{ $class->user->name }}</p>

            <h2 class="mt-4">Children</h2>
            <ul class="list-group">
                @foreach($class->childrenRecursive as $child)
                    <li class="list-group-item">{{ $child->name }}</li>
                @endforeach
            </ul>

            <h2 class="mt-4">Rules</h2>
            <ul class="list-group">
                @foreach($class->rules as $rule)
                    <li class="list-group-item">
                        <strong>Rule:</strong> {{ $rule->name }}
                        <ul class="list-group mt-2">
                            <li class="list-group-item"><strong>Duls:</strong> {{ $rule->duls->name }}</li>
                            <li class="list-group-item"><strong>Trigger:</strong> {{ $rule->duls->trigger->name }}</li>
                            <li class="list-group-item">
                                <strong>Articles:</strong>
                                <ul class="list-group mt-2">
                                    @foreach($rule->articles as $article)
                                        <li class="list-group-item">{{ $article->name }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endforeach
            </ul>

            <h2 class="mt-4">Typologies</h2>
            <ul class="list-group">
                @foreach($class->typologies as $typology)
                    <li class="list-group-item">{{ $typology->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
