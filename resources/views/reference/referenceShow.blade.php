@extends('index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header"><h1>{{ $reference->name }}</h1></div>

                    <div class="card-body">
                        <p><strong>Description:</strong> {{ $reference->description }}</p>
                        <p><strong>Catégorie:</strong>
                            <a href="{{ route('reference-category.show', $reference->category->id) }}"> {{ $reference->category->name }} </a>
                        </p>

                        <hr>

                        <h4>Fichiers associés :</h4>
                        @if($reference->files->isEmpty())
                            <p>Aucun fichier associé à cette référence.</p>
                        @else
                            <ul>
                                @foreach($reference->files as $file)
                                    <li><a href="{{ asset($file->file_path) }}">{{ $file->title }}</a></li>
                                @endforeach
                            </ul>
                        @endif

                        <hr>

                        <h4>Liens associés :</h4>
                        @if($reference->links->isEmpty())
                            <p>Aucun lien associé à cette référence.</p>
                        @else
                            <ul>
                                @foreach($reference->links as $link)
                                    <li><a href="{{ $link->link }}">{{ $link->name }}</a></li>
                                @endforeach
                            </ul>
                        @endif

                        <hr>
                        <h4>Articles associés :</h4>
                        @if($reference->articles->isEmpty())
                            <p>Aucun lien associé à cette référence.</p>
                        @else
                            <ul>
                                @foreach($reference->articles as $article)
                                    <li><a href="{{ route('article.show', [$reference, $article]) }}">{{ $article->reference }} - {{ $article->name }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Correctif: Utilisation de route() avec le nom de la route -->
        <a href="{{ route('article.create', $reference->id) }}" class="btn btn-sm btn-success">Ajouter un article</a>
        <a href="#" class="btn btn-sm btn-success">Ajouter une ressource</a>
        <a href="#" class="btn btn-sm btn-success">Ajouter un lien</a>
        <form action="{{ route('reference.destroy', $reference) }}" method="POST">
            @csrf
            @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </div>
@endsection
