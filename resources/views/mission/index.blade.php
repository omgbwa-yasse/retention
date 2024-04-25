<!-- index.blade.php -->

@extends('index')

@section('content')
    <div class="container">
        <h1>Domaine d'activité</h1>
        <a href="{{ route('mission.create') }}" class="btn btn-primary mb-2">Ajouter un domaine</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif



        <!-- Horizontal under breakpoint -->

        <ul class="list-group list-group-vertical">

            @foreach ($items as $item)
                <li class="list-group-item">{{ $item->code }} : {{ $item->name }}
                    <a href="{{ route('mission.show', $item) }}" class="btn btn-primary mb-2 left-1">Voir</a>
                </li>
                @include('mission.subclasses', ['subclasses' => $item->children])
            @endforeach
        </ul>


    </div>
@endsection
