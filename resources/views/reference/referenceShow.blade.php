@extends('index')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-8">
        <div class="card mb-7">
            <div class="card-body">
                <h5 class="card-title">{{ $reference->name }}</h5>
                <p class="card-text">
                <p><strong>Description:</strong> {{ $reference->description }}</p>
                <p><strong>Catégorie:</strong>
                <a href="{{ route('reference-category.show', $reference->category->id) }}"> {{ $reference->category->name }} </a>
                <h4>Articles associés :</h4>
                @if($reference->articles->isEmpty())
                <p>Aucun lien associé à cette référence.</p>

                @else
                @foreach($reference->articles as $article)
                    <div class="list-group">
                        <label class="list-group-item">
                            <a href="{{ route('reference.article.show', [$reference, $article]) }}">{{ $article->reference }} - {{ $article->name }}</a>
                        </label>
                        </div>
                @endforeach
                @endif
                <a href="{{ route('reference.article.create', $reference->id) }}" class="btn btn-primary btn-success">Ajouter un article</a>
                </div>

                </div>
                </div>

                <div class="col-3">
                <div class="card mb-4">
                    <div class="card-body">
                    <h5 class="card-title">Fichiers associés :</h5>
                    <p class="card-text">
                    @if($reference->files->isEmpty())
                    <p>Aucun fichier associé à cette référence.</p>
                    @else

                    @foreach($reference->files as $file)
                        <div class="list-group">
                            <label class="list-group-item">
                            Source : {{ $file->name }}
                                <a class="btn btn-sm bg-light" href="{{ route('reference.file.show', [$reference, $file]) }}">
                                    Consulter
                                </a>
                            </label>
                        </div>
                    @endforeach

                    @endif
                    <a href="{{ route('reference.file.create', $reference) }}" class="btn btn-primary btn-success">Ajouter un fichier</a>


                    </p>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Liens associés </h5>
                        <p class="card-text">


                    @if($reference->links->isEmpty())
                        <p>Aucun lien associé à cette référence.</p>
                    @else

                    @foreach($reference->links as $link)
                        <div class="list-group">
                            <label class="list-group-item">
                                <a href="{{ $link->link }}">{{ $link->name }} </a> : Télécharger le fichier
                                <p class="text-success">{{ $link->link }} <a name="" id="" class="btn btn-sm btn-secondary" href="{{ route('reference.link.show', [$reference, $link]) }}" role="button" >Voir</a></p>
                            </label>
                        </div>
                @endforeach
                @endif
                <a href="{{ route('reference.link.create', $reference)}}" class="btn btn-primary btn-success">Ajouter un lien</a>

            </p>
          </div>
        </div>

      </div>
    </div>
  </div>
        <form action="{{ route('reference.destroy', $reference) }}" method="POST">
            @csrf
            @method('DELETE')
        <button type="submit" class="btn btn-primary btn-danger">Delete</button>
        <a name="" id="" class="btn btn-primary" href="#" role="button" >Modifier</a>
        <a name="" id="" class="btn btn-primary" href="#" role="button" >Imprimer</a>
        <a name="" id="" class="btn btn-primary" href="#" role="button" >Panier</a>
    </div>
@endsection
