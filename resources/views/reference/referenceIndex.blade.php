@extends('index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1>Référentiels juridiques </h1>
                <a href="{{ route('reference.create') }}" class="btn btn-primary mb-3">Ajouter une référence</a>
                <a href="#" class="btn btn-danger mb-3">Panier</a>
                <a href="#" class="btn btn-danger mb-3">Imprimer</a>

                <!-- Ajouter le formulaire de recherche -->
                <form action="{{ route('reference.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher une référence...">
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

                @foreach ($references as $reference)
                    <div class="list-group">
                        <label class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="" />
                            <h2>{{ $reference->name }}</h2>
                            {{ $reference->description }} <br>
                            @unless(optional($reference->articles)->isEmpty())
                                ({{ optional($reference->articles)->count() }} article.s)
                            @endunless
                            <br>
                            <a href="{{ route('reference-category.show', $reference->category->id) }}"> {{ $reference->category->name }} </a>
                            <br>
                            <a href="#"> {{ $reference->country_name }} </a>
                            <br>
                            <a href="{{ route('reference.show', $reference->id) }}" class="btn btn-sm btn-success">Voir plus</a>
                        </label>
                    </div>
                @endforeach

                <!-- Ajouter la pagination -->
{{--                {{ $references->links() }}--}}

            </div>
        </div>
    </div>
@endsection
