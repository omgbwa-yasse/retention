@extends('index')

@section('content')
<h1>Références</h1>
    @foreach ($references as $reference)
        <h2>{{ $reference->title }}</h2>
        <p>Description: {{ $reference->description }}</p>
        <p>Category: {{ $reference->category->title }}</p>
        <h2>Ressources</h2>
        <ul>
            @foreach ($reference->ressources as $ressource)
                <li>
                    <a href="{{ $ressource->link }}" target="_blank">{{ $ressource->path }}</a>
                    <p>{{ $ressource->description }}</p>
                </li>
            @endforeach
        </ul>
        <a href="{{ route('reference.show', $reference->id) }}" class="btn btn-primary">Afficher</a>
    @endforeach
@endsection
