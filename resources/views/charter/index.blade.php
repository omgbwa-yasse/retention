@extends('index')
@section('content')

    @foreach( $domaines as $domaine )


        <h1 class="display-7">{{ $domaine->code }} -  {{ $domaine->name }}</h1>
        <p class="">{{ $domaine->description }} </p>

        <ul class="list-group list-group-horizontal">
            <li class="list-group-item bg-danger-subtle">Imprimer</li>
            <li class="list-group-item bg-success-subtle">Exporter</li>
            <li class="list-group-item bg-dark-subtle">Partager sur le forum</li>
            <li class="list-group-item bg-dark-subtle">Commentaires (12)</li>
        </ul>
        @include('charter.classes', ['subclasses' => $domaine->children])

    @endforeach



@endsection
