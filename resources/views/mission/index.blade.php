<!-- index.blade.php -->

@extends('index')

@section('content')
    <div class="container">
        <h1>Domaine d'activité</h1>
        <a href="{{ route('mission.create') }}" class="btn btn-primary mb-2">Create New Item</a>

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

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Cote</th>
                    <th scope="col">Title</th>
                    <th scope="col">Decription</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                    </tr>
                    @include('mission.subclasses', ['subclasses' => $item->children])
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
