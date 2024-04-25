@extends('index')

@section('content')
    <h1>Typologies documentaires</h1>
    <a href="{{ route('typology.create') }}" class="btn btn-primary">Create Typology</a>

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
    <ul class="list-group list-group-vertical-xxl">
            @foreach ($typologies as $typology)
            <!-- Horizontal under breakpoint -->
                <li class="list-group-item" style="margin-top:30px;">
                   <h2>{{ $typology->name }}</h2>
                    {{ $typology->description }}
                    <br>
                    Domaine : <b> {{ $typology->category ? $typology->category->name : 'N/A' }}</b>
                    <br>
                    <a href="{{ route('typology.show', $typology->id) }}" class="btn btn-sm btn-primary">Show</a>
                </li>
            @endforeach
        </ul>
@endsection
