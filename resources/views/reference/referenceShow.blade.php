@extends('index')

@section('content')
    <div class="container">
        <div>
        <h1>{{ $reference->name }}</h1>
            <p><strong>Description:</strong> {{ $reference->description }}</p>
            <p><strong>Catégorie:</strong>
                <a href="{{ route('reference-category.show', $reference->category->id) }}"> {{ $reference->category->name }} </a>
            </p>
            <hr>


            <!-- Ajouter les fichiers -->


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
            <a href="{{ route('reference.file.create', $reference) }}" class="btn btn-primary btn-success">Ajouter un fichier</a>
            <hr>


            <!-- Ajouter les fichiers -->

            <h4>Liens associés :</h4>
            @if($reference->links->isEmpty())
                <p>Aucun lien associé à cette référence.</p>
            @else

                <ul>
                    @foreach($reference->links as $link)

                    <div class="list-group">
                        <label class="list-group-item">
                            <a href="{{ $link->link }}">{{ $link->name }} </a> : Télécharger le fichier
                            <p class="text-success">{{ $link->link }} <a name="" id="" class="btn btn-sm btn-secondary" href="{{ route('reference.link.show', [$reference, $link]) }}" role="button" >Voir</a></p>
                        </label>
                    </div>
                    @endforeach
                </ul>
            @endif
            <a href="{{ route('reference.link.create', $reference)}}" class="btn btn-primary btn-success">Ajouter un lien</a>
            <hr>


            <!-- Ajouter les fichiers -->


            <h4>Articles associés :</h4>
            @if($reference->articles->isEmpty())
                <p>Aucun lien associé à cette référence.</p>

            @else

                <ul>
                    @foreach($reference->articles as $article)
                    <div class="list-group">
                        <label class="list-group-item">
                            <a href="{{ route('reference.article.show', [$reference, $article]) }}">{{ $article->reference }} - {{ $article->name }}</a>
                        </label>
                    </div>
                    @endforeach
                </ul>
            @endif

        </div>


        <!-- Correctif: Utilisation de route() avec le nom de la route -->

        <a href="{{ route('reference.article.create', $reference->id) }}" class="btn btn-primary btn-success">Ajouter un article</a>



        <hr>
        <form action="{{ route('reference.destroy', $reference) }}" method="POST">
            @csrf
            @method('DELETE')
        <button type="submit" class="btn btn-primary btn-danger">Delete</button>
        <a name="" id="" class="btn btn-primary" href="#" role="button" >Modifier</a>
        <a name="" id="" class="btn btn-primary" href="#" role="button" >Imprimer</a>
        <a name="" id="" class="btn btn-primary" href="#" role="button" >Panier</a>
    </div>
@endsection
