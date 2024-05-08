@extends('index')
@section('content')

<h1>Discusion</h1>
<hr>
<p class="lead">    </p>
    <a name="" id="" class="btn btn-primary" href="{{ route('forum.subject.create')}}" role="button" >Ajouter un sujet</a>
    <ul class="list-group">
        @foreach($subjects as $subject)
            <li class="list-group-item">
                <strong> {{ $subject->name }} </strong>  classe
                @foreach($subject->classes as $class)
                {{ $class->code }} - {{ $class->name }}
                @endforeach

                <button  type="button" class="btn btn-primary">
                    <a href="{{ route('forum.subject.show', $subject) }}" class="btn btn-primary">Participer</a>
                </button>
            </li>
        @endforeach
    </ul>
@endsection
