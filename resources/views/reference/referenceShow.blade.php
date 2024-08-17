@extends('index')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">{{ $reference->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Description:</strong> {{ $reference->description }}</p>
                        <p><strong>Catégorie:</strong>
                            <a href="{{ route('reference-category.show', $reference->category->id) }}" class="text-decoration-none">
                                {{ $reference->category->name }}
                            </a>
                        </p>

                        <h5 class="mt-4 mb-3">Articles associés :</h5>
                        @if($reference->articles->isEmpty())
                            <p class="text-muted">Aucun article associé à cette référence.</p>
                        @else
                            <div class="list-group">
                                @foreach($reference->articles as $article)
                                    <a href="{{ route('reference.article.show', [$reference, $article]) }}" class="list-group-item list-group-item-action">
                                        {{ $article->reference }} - {{ $article->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        <a href="{{ route('reference.article.create', $reference->id) }}" class="btn btn-success mt-3">
                            <i class="fas fa-plus-circle me-2"></i>Ajouter un article
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0">Fichiers associés</h5>
                    </div>
                    <div class="card-body">
                        @if($reference->files->isEmpty())
                            <p class="text-muted">Aucun fichier associé à cette référence.</p>
                        @else
                            <div class="list-group">
                                @foreach($reference->files as $file)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $file->name }}</span>
                                        <a href="{{ route('reference.file.show', [$reference, $file]) }}" class="btn btn-sm btn-outline-primary">
                                            Consulter
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <a href="{{ route('reference.file.create', $reference) }}" class="btn btn-success mt-3">
                            <i class="fas fa-file-upload me-2"></i>Ajouter un fichier
                        </a>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">Liens associés</h5>
                    </div>
                    <div class="card-body">
                        @if($reference->links->isEmpty())
                            <p class="text-muted">Aucun lien associé à cette référence.</p>
                        @else
                            <div class="list-group">
                                @foreach($reference->links as $link)
                                    <div class="list-group-item">
                                        <a href="http://{{ $link->link }}" class="text-decoration-none">{{ $link->name }}<p class="text-success mb-1">({{ $link->link }})</p></a>

                                        <a href="{{ route('reference.link.show', [$reference, $link]) }}" class="btn btn-sm btn-outline-secondary">Voir</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <a href="{{ route('reference.link.create', $reference)}}" class="btn btn-success mt-3">
                            <i class="fas fa-link me-2"></i>Ajouter un lien
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <form action="{{ route('reference.destroy', $reference) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette référence ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash-alt me-2"></i>Supprimer
                </button>
            </form>
            <div>
                <a href="#" class="btn btn-primary me-2">
                    <i class="fas fa-edit me-2"></i>Modifier
                </a>
                <a href="#" class="btn btn-secondary me-2">
                    <i class="fas fa-print me-2"></i>Imprimer
                </a>
                <a href="#" class="btn btn-info">
                    <i class="fas fa-shopping-cart me-2"></i>Panier
                </a>
            </div>
        </div>
    </div>
@endsection
