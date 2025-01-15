@extends('index')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h1 class="h3 mb-0">Ajouter un article</h1>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-3">
                    <label class="fw-bold">Référence</label>
                    <p class="mb-0">{{ $rule->code }}</p>
                </div>
                <div class="col-md-9">
                    <label class="fw-bold">Intitulé</label>
                    <p class="mb-0">{{ $rule->name }}</p>
                </div>
            </div>

            <div class="mb-4">
                <label class="fw-bold">Description</label>
                <p class="mb-0">{{ $rule->description }}</p>
            </div>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('rule.article.store', $rule->id)}}" method="post">
            @csrf
            <input type="text" name="rule_id" value="{{ $rule->id }}" hidden>
            <div class="card-body">
                <div class="mb-3">
                    <label class="fw-bold">Article</label>
                    <select name="article_id" class="form-control">
                        <option value="">Sélectionnez un article</option>
                        @foreach($articles as $article)
                            <option value="{{ $article->id }}">{{ $article->reference->name }} / {{ $article->code }} - {{ $article->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>

</div>

@endsection
