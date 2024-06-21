@extends('index')

@section('content')
    <div class="container">
        <h1>Toutes les missions du {{ $country->name }} ({{ $country->abbr}})</h1>
        <a href="{{ route('mission.create') }}" class="btn btn-primary mb-2">Ajouter un domaine</a>

        <!-- Ajouter ce formulaire pour la barre de recherche -->
        <form action="" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher...">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Rechercher</button>
                </div>
            </div>
        </form>

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
                <li class="list-group-item" >{{ $item->code }} : {{ $item->name }}
                    <a href="{{ route('mission.show', $item) }}" class="btn btn-primary mb-2 float-end">Voir</a>
                </li>
                @include('mission.subclasses', ['subclasses' => $item->children])
            @endforeach
        </ul>

    </div>
@endsection

