<!-- resources/views/references/index.blade.php -->

@extends('index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Référentiels juridiques </h1>
                <a href="{{ route('reference.create') }}" class="btn btn-primary mb-3">Ajouter une référence</a>
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
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Catégorie</th>
                            <th>Pays</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($references as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}
                                    @unless(optional($item->articles)->isEmpty())
                                        ({{ optional($item->articles)->count() }} article.s)
                                    @endunless
                                </td>
                                <td> <a href="{{ route('reference-category.show', $item->category->id) }}"> {{ $item->category->name }} </a></td>
                                <td><a href=""> {{ $item->country_name }} </a></td>
                                <td>
                                    <form action="{{ route('reference.destroy', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="{{ route('reference.show', $item->id) }}" class="btn btn-sm btn-success">Voir plus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
