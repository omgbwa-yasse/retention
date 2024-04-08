@extends('index')

@section('content')

    <h1>{{ $reference->title }}</h1>
    <p>{{ $reference->description }}</p>
    <p>Category: {{ $reference->category->title }}</p>
    <h2>Ressources</h2>
    <ul>
        @foreach ($reference->ressources as $ressource)
            <li>
                <a href="{{ $ressource->link }}" target="_blank">{{ $ressource->file_path }}</a>
                <p>{{ $ressource->description }}</p>
                <p>Category: {{ $ressource->category->title }}</p>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('ressource.edit', $reference->id) }}" class="btn btn-primary">Ajouter des ressources</a>
@endsection
